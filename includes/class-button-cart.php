<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * Class to implement button in woocommerce cart page
 *
 * @since 2.8
 */
class OMW_Button_Cart extends OMW_Button {
    /**
     * Cart items object
     *
     * @since 2.8
     */
    public $cart_items;

    /**
     * Construct the class
     *
     * @since 2.8
     */
    public function __construct() {
        $this->button_custom_message = get_option( 'evwapp_opiton_message_cart' );
        $this->button_text = get_option( 'evwapp_opiton_text_button_cart' );
        $this->target = get_option( 'evwapp_opiton_cart_button_target' );
    }

    /**
     * Output button
     *
     * @since 2.8
     * @return void
     */
    public function output_btn() {
        if ( is_cart() ) {
            $this->cart_items = WC()->cart->get_cart_contents();
            $shared_text = $this->create_shared_text();
		    $whatsapp_link = $this->create_whatsapp_link( $shared_text );
            $this->create_button( $whatsapp_link, $this->target, $this->button_text );
        }
    }

	/**
	 * Create shared text
	 *
	 * @since 2.8
	 */
	public function create_shared_text() {
		return sprintf(
			'%1$s%2$s%3$s%4$s%5$s',
			$this->button_custom_message,
			OMW_Utils::$doble_break_line,
			implode( OMW_Utils::$break_line, $this->get_cart_items() ),
			OMW_Utils::$break_line,
			__( 'Cart Total: ', 'woo-order-on-whatsapp' ) . $this->get_formated_cart_total()
		);
	}

	/**
	 * Get cart items
	 *
	 * @since 2.8
	 * @return array
	 */
	public function get_cart_items() {
		$cart = $this->cart_items;
		if( empty( $cart ) ) {
			return array();
		}

		$items = array();
		foreach ( $cart as $cart_item ) {
			$product = $cart_item['data'];
			$product_variation = '';
			if ( $product->get_type() === 'variation' ) {
				$product_variation = implode( ',', $cart_item['data']->get_variation_attributes() );
			}

			$items[] = sprintf(
				'-> %1$s x %2$s %3$s = %4$s %5$s',
				$cart_item['quantity'],
				$product->get_name(),
				$product_variation,
				$this->get_formmated_price( $product ),
				OMW_Utils::$break_line
			);
		}

		return $items;
	}

    /**
     * Get formated cart total
     *
     * @since 2.8
     */
    public function get_formated_cart_total() {
        $cart_total = WC()->cart->get_cart_contents_total();
        return OMW_Utils::format_price( $cart_total );
    }
}
