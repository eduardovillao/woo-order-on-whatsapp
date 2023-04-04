<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class with static methos to help and formating the plugins/functions.
 *
 * @since 2.8
 */
class OMW_Utils {
	/**
	 * Simple break line.
	 *
	 * @var string
	 */
	public static $break_line = PHP_EOL;

	/**
	 * Double breal line
	 *
	 * @var string
	 */
	public static $doble_break_line = PHP_EOL . PHP_EOL;

	/**
	 * Format phone like a woocommerce settins
	 *
	 * @param $price
	 * @return void
	 * @since 2.8
	 */
	public static function format_price( $price ) {
		if ( empty( $price ) ) {
			return;
		}

		$currency = get_woocommerce_currency_symbol();
		$thousand_separator = get_option( 'woocommerce_price_thousand_sep' );
		$decimal_separator = get_option( 'woocommerce_price_decimal_sep');
		$number_of_decimals = get_option( 'woocommerce_price_num_decimals' );

		return $currency . ' ' . number_format( $price, $number_of_decimals, $thousand_separator, $decimal_separator );
	}

	/**
	 * Tag to pro version
	 *
	 * @since 2.0
	 * @return string
	 */
	public static function get_pro_tag() {
		echo '<span class="owm-pro-tag">' . esc_html__( 'Only on Pro', 'woo-order-on-whatsapp' ) . '';
	}
}
