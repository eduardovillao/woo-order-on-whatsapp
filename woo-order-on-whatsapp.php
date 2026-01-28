<?php
/**
 * Plugin Name: Order on Mobile for WooCommerce
 * Plugin URI: https://eduardovillao.me/wordpress-plugin/order-on-mobile-for-woocommerce/
 * Description: Order on Mobile for WooCommerce allows your customers to submit their orders through WhatsApp, directly from the Woocommerce product page.
 * Author: EduardoVillao.me
 * Author URI: https://eduardovillao.me/
 * Version: 2.8.1
 * Requires at least: 5.5
 * Requires PHP: 7.4
 * Text Domain: woo-order-on-whatsapp
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Requires Plugins: woocommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OMW_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'OMW_PLUGN_URL', plugin_dir_url( __FILE__ ) );
define( 'OMW_VERSION', '2.8.1' );
define( 'OMW_PHP_MINIMUM_VERSION', '7.4' );
define( 'OMW_WP_MINIMUM_VERSION', '5.5' );

/**
 * Check PHP and WP version before include plugin class
 *
 * @since 1.6
 */
if( ! version_compare( PHP_VERSION, OMW_PHP_MINIMUM_VERSION, '>=' ) ) {
	add_action( 'admin_notices', 'omw_admin_notice_php_version_fail' );
} elseif( ! version_compare( get_bloginfo( 'version' ), OMW_WP_MINIMUM_VERSION, '>=' ) ) {
	add_action( 'admin_notices', 'omw_admin_notice_wp_version_fail' );
} else {
	include_once OMW_PLUGIN_PATH . 'includes/class-omw-plugin.php';
	OMW_Plugin::instance();
}

/**
 * Admin notice PHP version fail
 *
 * @since 1.6
 * @return void
 */
function omw_admin_notice_php_version_fail() {
	$message = sprintf(
		esc_html__( '%1$s requires PHP version %2$s or greater.', 'woo-order-on-whatsapp' ),
		'<strong>Order on Mobile for WooCommerce</strong>',
		OMW_PHP_MINIMUM_VERSION
	);

	$html_message = sprintf( '<div class="notice notice-error"><p>%1$s</p></div>', $message );
	echo wp_kses_post( $html_message );
}

/**
 * Admin notice WP version fail
 *
 * @since 1.6
 * @return void
 */
function omw_admin_notice_wp_version_fail() {
	$message = sprintf(
		esc_html__( '%1$s requires WordPress version %2$s or greater.', 'woo-order-on-whatsapp' ),
		'<strong>Order on Mobile for WooCommerce</strong>',
		OMW_WP_MINIMUM_VERSION
	);

	$html_message = sprintf( '<div class="notice notice-error"><p>%1$s</p></div>', $message );
	echo wp_kses_post( $html_message );
}
