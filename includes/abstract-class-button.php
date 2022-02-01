<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

abstract class OMW_Button {

    /**
     * SVG icon
     *
     * @var string
     * @since 2.8
     */
    public $icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg_wapp_evowap" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 90 90" style="enable-background:new 0 0 90 90;" xml:space="preserve"><path id="WhatsApp" d="M90,43.841c0,24.213-19.779,43.841-44.182,43.841c-7.747,0-15.025-1.98-21.357-5.455L0,90l7.975-23.522 c-4.023-6.606-6.34-14.354-6.34-22.637C1.635,19.628,21.416,0,45.818,0C70.223,0,90,19.628,90,43.841z M45.818,6.982 c-20.484,0-37.146,16.535-37.146,36.859c0,8.065,2.629,15.534,7.076,21.61L11.107,79.14l14.275-4.537 c5.865,3.851,12.891,6.097,20.437,6.097c20.481,0,37.146-16.533,37.146-36.857S66.301,6.982,45.818,6.982z M68.129,53.938 c-0.273-0.447-0.994-0.717-2.076-1.254c-1.084-0.537-6.41-3.138-7.4-3.495c-0.993-0.358-1.717-0.538-2.438,0.537 c-0.721,1.076-2.797,3.495-3.43,4.212c-0.632,0.719-1.263,0.809-2.347,0.271c-1.082-0.537-4.571-1.673-8.708-5.333 c-3.219-2.848-5.393-6.364-6.025-7.441c-0.631-1.075-0.066-1.656,0.475-2.191c0.488-0.482,1.084-1.255,1.625-1.882 c0.543-0.628,0.723-1.075,1.082-1.793c0.363-0.717,0.182-1.344-0.09-1.883c-0.27-0.537-2.438-5.825-3.34-7.977 c-0.902-2.15-1.803-1.792-2.436-1.792c-0.631,0-1.354-0.09-2.076-0.09c-0.722,0-1.896,0.269-2.889,1.344 c-0.992,1.076-3.789,3.676-3.789,8.963c0,5.288,3.879,10.397,4.422,11.113c0.541,0.716,7.49,11.92,18.5,16.223 C58.2,65.771,58.2,64.336,60.186,64.156c1.984-0.179,6.406-2.599,7.312-5.107C68.398,56.537,68.398,54.386,68.129,53.938z" fill="#FFFFFF"/></svg>';

    /**
	 * Button text
	 * 
	 * @since 2.8
	 */
	public $button_text;

	/**
	 * Target option
	 * 
	 * @since 2.8
	 */
	public $target;

    /**
     * Custom message to send on WhatsApp
     * 
     * @since 2.8
     */
    public $button_custom_message;

    /**
     * Method to output button
     *
     * @since 2.8
     * @return void
     */
    protected abstract function output_btn();

    /**
	 * Create shared text
	 * 
	 * @since 2.8
	 */
	protected abstract function create_shared_text();

    /**
	 * Create WhatsApp link
	 * 
	 * @since 2.8
	 */
	public function create_whatsapp_link( $shared_text ) {
		
		return sprintf(
			'https://wa.me/%1$s?text=%2$s',
			OMW_Plugin::instance()->phone_number,
			urlencode( html_entity_decode ( $shared_text, ENT_QUOTES | ENT_HTML5, 'UTF-8' ) )
		);
	}

    /**
	 * Create HTML button
	 * 
	 * @since 2.8
	 */
	public function create_button( $link, $target, $button_text ) {

		?>
		<div class="div_evowap_btn">

            <?php if( is_singular( 'product' ) && wc_get_product()->is_type( 'variable' ) ) : ?>
				<form id="woapp-fields">
					<input type="hidden" id="woapp_number" value="'.$phone.'"></input>
					<input type="hidden" id="woapp_message" value="'.$encode_message.'"></input>
					<input type="hidden" id="woapp_name" value="'.$this->evowap_get_product_name().'"></input>
					<input type="hidden" id="woapp_reg_price" value="'.$this->evowap_get_product_price().'"></input>
					<input type="hidden" id="woapp_link" value="'.$this->evowap_get_product_link().'"></input>
				</form>
			<?php endif; ?>

			<?php printf(
			    '<a href="%1$s" class="evowap_btn" id="evowap_btn" role="button" target="%2$s">%3$s%4$s</a>',
			    esc_attr( $link ),
			    esc_attr( $target ),
			    $this->icon,
			    esc_html( $button_text )
		    ); ?>
		</div>
		<?php
	}

    /**
	 * Formated price with currency
	 *
     * @param object $product
	 * @return void
	 * @since 2.8
	 */
	public function get_formmated_price( $product ) {

		$price = wc_get_price_including_tax( $product );
		return OMW_Utils::format_price( $price );
	}
}