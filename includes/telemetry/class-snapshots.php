<?php

namespace Omw\Includes\Telemetry;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to capture telemetry snapshots
 */
class Snapshots {
	const MAX_SNAPSHOTS = 7;
	const OPTION_KEY = 'omw_telemetry_snapshots';
	const ENDPOINT = 'https://api.myddelivery.com/api/oww/telemetry';
	const SECRET = '23d3404aehedf4c0a465790ce432b7c7a6e9c9c4f7eb02ec35246eac96b9c3474';

	/**
	 * Capture a snapshot of the current plugin state
	 */
	public static function capture_snapshot() {
		$install_id = get_option( 'omw_install_id', null );
		if ( $install_id === null ) {
			return null;
		}

		$phone_number_set = ! empty( get_option( 'evwapp_opiton_phone_number' ) );

		$show_btn_single = get_option( 'evwapp_opiton_show_btn_single', 'no' );
		$show_btn_cart = get_option( 'evwapp_opiton_show_cart', 'no' );

		$remove_add_to_cart = get_option( 'evwapp_opiton_remove_btn', 'no' );
		$remove_price = get_option( 'evwapp_opiton_remove_price', 'no' );

		$pro_version = defined( 'OWW_VERSION' ) ? OWW_VERSION : null;

		$products_count = 0;
		$counts = \wp_count_posts( 'product' );
		if ( $counts && isset( $counts->publish ) ) {
			$products_count = (int) $counts->publish;
		}

		$install_started_at = get_option( 'omw_install_started_at' );
		$first_plugin_version = get_option( 'omw_first_plugin_version' );

		return [
			'schema_version' => 1,
			'captured_at' => gmdate( 'Y-m-d\TH:i:s\Z' ),
			'install_id' => $install_id,
			'install_started_at' => $install_started_at,
			'first_plugin_version' => $first_plugin_version,
			'plugin_version' => defined( 'OMW_VERSION' ) ? OMW_VERSION : 'unknown',
			'wp_version' => \get_bloginfo( 'version' ),
			'php_version' => PHP_VERSION,
			'locale' => \get_locale(),
			'is_multisite' => \is_multisite(),
			'pro_version' => $pro_version,
			'settings' => [
				'phone_number_configured' => $phone_number_set,
				'show_button_single' => $show_btn_single === 'yes',
				'show_button_cart' => $show_btn_cart === 'yes',
				'remove_add_to_cart_btn' => $remove_add_to_cart === 'yes',
				'remove_price' => $remove_price === 'yes',
			],
			'products_count' => $products_count,
		];
	}

	/**
	 * Store a new snapshot
	 */
	public static function store_snapshot() {
		$snapshots = \get_option( self::OPTION_KEY, [] );

		if ( ! is_array( $snapshots ) ) {
			$snapshots = [];
		}

		$snapshot_to_add = self::capture_snapshot();
		if ( $snapshot_to_add === null ) {
			return;
		}

		$snapshots[] = $snapshot_to_add;

		if ( count( $snapshots ) > self::MAX_SNAPSHOTS ) {
			$snapshots = array_slice( $snapshots, -self::MAX_SNAPSHOTS );
		}

		\update_option( self::OPTION_KEY, $snapshots, false );

		if ( ! \wp_next_scheduled('omw_send_snapshot_once') ) {
			\wp_schedule_single_event( time() + MINUTE_IN_SECONDS, 'omw_send_snapshot_once' );
		}
	}

	/**
	 * Get stored snapshots
	 */
	public static function get_snapshots() {
		return \get_option( self::OPTION_KEY, [] );
	}

	/**
	 * Schedule daily snapshot collection
	 */
	public static function set_collect_snapshots() {
		\add_action( 'omw_collect_snapshot', [ self::class, 'store_snapshot' ] );
		\add_action( 'omw_send_snapshot_once', [ self::class, 'send' ] );

		if ( ! \wp_next_scheduled( 'omw_collect_snapshot' ) ) {
			\wp_schedule_event( time() + HOUR_IN_SECONDS, 'daily', 'omw_collect_snapshot' );
		}
	}

	/**
	 * Send stored snapshots to telemetry endpoint
	 */
	public static function send() {
		$snapshots = self::get_snapshots();
		if ( empty( $snapshots ) ) {
			return new \WP_Error( 'omw_telemetry', 'No provided snapshots.' );
		}

		$body = \wp_json_encode(
			$snapshots,
			JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
		);
		if ( false === $body ) {
			return new \WP_Error( 'omw_telemetry', 'Failed to JSON-encode the payload.' );
		}

		$signature = 'sha256=' . hash_hmac( 'sha256', $body, self::SECRET );

		$args = [
			'headers'     => [
				'Content-Type'    => 'application/json; charset=utf-8',
				'X-OMW-Signature' => $signature,
				'User-Agent'      => 'OMW-Telemetry/1.0; ' . \home_url(),
			],
			'body'        => $body,
			'timeout'     => 12,
			'blocking'    => \wp_doing_cron(),
			'sslverify'   => true,
		];

		$response = \wp_remote_post( self::ENDPOINT, $args );

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$code = \wp_remote_retrieve_response_code( $response );

		if ( in_array( (int) $code, [ 200, 409 ], true ) ) {
			\update_option( self::OPTION_KEY, [], false );
			return true;
		}

		$body_resp = \wp_remote_retrieve_body( $response );
		return new \WP_Error(
			'omw_telemetry',
			sprintf( 'HTTP %d: %s', (int) $code, $body_resp ?? 'no body' )
		);
	}
}
