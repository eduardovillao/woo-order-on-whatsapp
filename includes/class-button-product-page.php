<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to add button in single product page
 *
 * @since 2.8
 */
class OMW_Button_Product_Page extends OMW_Button {
	/**
	 * Product object
	 *
	 * @since 2.8
	 */
	public $product;

	/**
	 * Hide price option
	 *
	 * @since 2.8
	 */
	public $hide_price;

	/**
	 * Hide add to cart button
	 *
	 * @since 2.8
	 */
	public $hide_add_to_cart_button;

	/**
	 * Hide plugin button on mobile
	 *
	 * @since 2.8
	 */
	public $hide_whatsapp_button_on_mobile;

	/**
	 * Construc the class
	 *
	 * @since 2.8
	 */
	public function __construct() {

		$this->hide_price = get_option( 'evwapp_opiton_remove_price' );
		$this->hide_add_to_cart_button = get_option( 'evwapp_opiton_remove_cart_btn' );
		$this->hide_whatsapp_button_on_mobile = get_option( 'evwapp_opiton_remove_btn' );
		$this->button_custom_message = get_option( 'evwapp_opiton_message' );
		$this->button_text = get_option( 'evwapp_opiton_text_button' );
		$this->target = get_option( 'evwapp_opiton_target' );
	}

	/**
	 * Output button
	 *
	 * @since 2.8
	 * @return void
	 */
	public function output_btn() {

		if( is_singular( 'product' ) ) {

			$this->product = wc_get_product();
			$shared_text = $this->create_shared_text();
			$whatsapp_link = $this->create_whatsapp_link( $shared_text );
			return $this->create_button( $whatsapp_link, $this->target, $this->button_text );

		} else {

			return esc_html_e( 'Sorry, its not a product page. Please use this shortcode only on your product page.', 'woo-order-on-whatsapp' );
		}
	}

	/**
	 * Create shared text
	 *
	 * @since 2.8
	 */
	public function create_shared_text() {

		$product = $this->product;

		return sprintf(
			'%1$s%2$s%3$s%4$s%5$s%6$s%7$s',
			$this->button_custom_message,
			OMW_Utils::$doble_break_line,
			$product->get_name(),
			OMW_Utils::$break_line,
			$this->get_formmated_price( $product ),
			OMW_Utils::$break_line,
			$product->get_permalink()
		);
	}

	/**
	 * Hide woocommerce product page elements
	 *
	 * @since 2.8
	 * @return void
	 */
	public function hide_woo_elements() {

		if( is_singular( 'product' ) ) {

			if( $this->hide_price === 'yes' ) {
				?>
				<style>.product .price {display: none !important;}</style>
				<?php
			}

			if( $this->hide_add_to_cart_button === 'yes' ) {
				?>
				<style>.product .cart {display: none !important;}</style>
				<?php
			}

			if( $this->hide_whatsapp_button_on_mobile === 'yes' ) {
				?>
				<style>@media screen and (min-width: 768px) {.div_evowap_btn {display: none !important;}}</style>
				<?php
			}
		}
	}
}
