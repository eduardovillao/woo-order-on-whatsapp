<?php

namespace Omw\Includes\Telemetry;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Telemetry_Fallback
 */
class Telemetry_Fallback {
	/**
	 * Ensures telemetry defaults exist for installs
	 * that predate the activation hook.
	 */
	public static function ensure_defaults() {
		$install_id = \get_option( 'omw_install_id', null );
		if ( empty( $install_id ) || ! \wp_is_uuid( $install_id ) ) {
			\update_option( 'omw_install_id', \wp_generate_uuid4() );
		}

		$install_started_at = \get_option( 'omw_install_started_at', null );
		if ( empty( $install_started_at ) || ! is_string( $install_started_at ) ) {
			\update_option( 'omw_install_started_at', \gmdate( 'Y-m-d\TH:i:s\Z' ) );
		}

		$first_plugin_version = \get_option( 'omw_first_plugin_version', null );
		if ( empty( $first_plugin_version ) || ! is_string( $first_plugin_version ) ) {
			\update_option( 'omw_first_plugin_version', defined( 'OMW_VERSION' ) ? OMW_VERSION : 'unknown' );
		}
	}
}
