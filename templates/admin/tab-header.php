<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wrap">

	<h1><?php esc_html_e( 'Order on WhatsApp for WooCommerce', 'woo-order-on-whatsapp' );?></h1>
	<?php settings_errors(); ?>

	<nav class="nav-tab-wrapper">
		<a href="#tab_general" id="tab-general" class="nav-tab myd-tab nav-tab-active" onclick="mydChangeTab(event)"><?php esc_html_e( 'General', 'woo-order-on-whatsapp' );?></a>
		<a href="#tab_checkout" id="tab-checkout" class="nav-tab myd-tab" onclick="mydChangeTab(event)"><?php esc_html_e( 'Checkout', 'woo-order-on-whatsapp' );?></a>
		<a href="#tab_single_product" id="tab-single-product" class="nav-tab myd-tab" onclick="mydChangeTab(event)"><?php esc_html_e( 'Product Page', 'woo-order-on-whatsapp' );?></a>
		<a href="#tab_cart" id="tab-cart" class="nav-tab myd-tab" onclick="mydChangeTab(event)"><?php esc_html_e( 'Cart Page', 'woo-order-on-whatsapp' );?></a>
		<a href="#tab_support" id="tab-support" class="nav-tab myd-tab" onclick="mydChangeTab(event)"><?php esc_html_e( 'Support', 'woo-order-on-whatsapp' );?></a>
	</nav>

	<form method="post" action="options.php">
	<?php settings_fields( 'evwapp-settings-group' ); ?>
