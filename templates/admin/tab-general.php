<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="tab-general-content" class="myd-tabs-content myd-tabs-content--active">
	<h2><?php esc_html_e( 'General Settings', 'woo-order-on-whatsapp' );?></h2>
		<table class="form-table">
			<tbody>
				<tr">
					<th scope="row">
						<label for="evwapp_opiton_phone_number"><?php esc_html_e( 'WhatsApp Number', 'woo-order-on-whatsapp' );?></label>
					</th>
					<td>
						<input type="text" name="evwapp_opiton_phone_number" id="evwapp_opiton_phone_number" class="regular-text" value="<?php echo get_option('evwapp_opiton_phone_number'); ?>" inputmode="numeric" pattern="\d*" placeholder="5551XXXXXXXXX" required>
						<p class="omw-description"><?php esc_html_e( 'Enter with your country code 5551XXXXXXXXX', 'woo-order-on-whatsapp');?></p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="evwapp_opiton_show_thank"><?php esc_html_e( 'Auto redirect after checkout?', 'woo-order-on-whatsapp' );?> <?php OMW_Utils::get_pro_tag(); ?></label>
					</th>
					<td>
						<input type="checkbox" disabled name="evwapp_opiton_show_thank" id="evwapp_opiton_show_thank" value="yes" <?php checked( get_option('evwapp_opiton_show_thank'), 'yes' );?>><?php esc_html_e( 'Yes, redirect after checkout.', 'woo-order-on-whatsapp' );?>
						<p class="omw-description"><?php esc_html_e( 'Customer will be redirected to WhatsApp with a custom message defined on tab "Checkout".', 'woo-order-on-whatsapp' );?></p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="evwapp_opiton_show_btn_single"><?php esc_html_e( 'Show button in Product page?', 'woo-order-on-whatsapp' );?></label>
					</th>
					<td>
						<input type="checkbox" name="evwapp_opiton_show_btn_single" id="evwapp_opiton_show_btn_single" value="yes" <?php checked( get_option('evwapp_opiton_show_btn_single'), 'yes' );?>><?php esc_html_e( 'Yes, show button in single product page.', 'woo-order-on-whatsapp' );?>
						<p class="omw-description"><?php esc_html_e( 'The button will be displayed on product page after "add to cart" button.', 'woo-order-on-whatsapp' );?></p>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="evwapp_opiton_show_cart"><?php esc_html_e( 'Show button in cart page?', 'order-on-whatspp-for-woocommerce' );?></label>
					</th>
					<td>
						<input type="checkbox" name="evwapp_opiton_show_cart" id="evwapp_opiton_show_cart" value="yes" <?php checked( get_option('evwapp_opiton_show_cart'), 'yes' );?>><?php esc_html_e( 'Yes, show button in cart page.', 'order-on-whatspp-for-woocommerce' );?>
						<p class="omw-description"><?php esc_html_e( 'The button will be displayed on cart page.', 'woo-order-on-whatsapp' );?></p>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="card">
			<h3><?php esc_html_e( 'Widget for Elementor', 'woo-order-on-whatsapp' );?> <?php OMW_Utils::get_pro_tag(); ?></h3>
			<p><?php echo wp_kses_post( __( 'Now, the <b>PRO version</b> has a <b>Widget for Elemento!</b> You can use that in all pages, and select wath product the button get and redirect information for WhatsApp. Open Elementor editor and search for: "Order on WhatsApp Button".', 'woo-order-on-whatsapp' ) );?></p>
		</div>
</div>
