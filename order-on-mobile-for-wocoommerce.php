<?php

/**
 * Plugin Name: Order on Mobile for Wocoommerce
 * Plugin URI: https://eduardovillao.me/wordpress-plugin-order-on-mobile-for-woocommerce/
 * Description: Order on Mobile for Wocoommerce allows your customers to submit their orders through WhatsApp, directly from the Woocommerce product page.
 * Author: EduardoVillao.me
 * Author URI: https://eduardovillao.me/
 * Version: 1.1.9
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**Include CSS and JS file**/
function evowap_include_plugin_css () {
    wp_enqueue_style( 'evwapp_style',  plugin_dir_url( __FILE__ ) . 'assets/style.css' );
	wp_enqueue_script( 'evwapp_js',  plugin_dir_url( __FILE__ ) . 'assets/my-script.js', array('jquery'), true);
}

add_action( 'wp_enqueue_scripts', 'evowap_include_plugin_css' );

/**Include CSS and JS admin file**/
function evowap_include_admin_css () {
    wp_enqueue_style( 'evwapp_style_admin',  plugin_dir_url( __FILE__ ) . 'assets/style_admin.css' );
    wp_enqueue_script( 'evwapp_admin_script',  plugin_dir_url( __FILE__ ) . 'assets/my-admin-script.js', array('jquery'), true);
}

add_action( 'admin_enqueue_scripts', 'evowap_include_admin_css' );

/**Include Required Files**/
require dirname(__FILE__).'/functions/btn-order-on-whatsapp.php';
require dirname(__FILE__).'/admin/admin-template.php';

/**Check Woocommerce Plugin Installed**/
function evowap_check_woocommece_active(){
if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
  	echo "<div class='error'><p><strong>Order on Mobile for Wocoommerce</strong> requires <strong> Wooommerce plugin</strong> </p></div>";
	}
}

add_action('admin_notices', 'evowap_check_woocommece_active');
