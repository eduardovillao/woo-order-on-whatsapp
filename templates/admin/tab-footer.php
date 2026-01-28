<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
		<?php if ( ! did_action( 'oww_plugin_init' ) ) : ?>
			<a class="owm-offer-banner__link" href="https://codecanyon.net/item/order-on-whatsapp-for-woocommerce/25824812" target="_blank">
				<picture>
					<source srcset="/wp-content/plugins/woo-order-on-whatsapp/assets/img/own-offer-banner.avif" type="image/avif">
					<source srcset="/wp-content/plugins/woo-order-on-whatsapp/assets/img/own-offer-banner.webp" type="image/webp">
					<img src="/wp-content/plugins/woo-order-on-whatsapp/assets/img/own-offer-banner.png" alt="<?php esc_html_e( 'Order on WhatsApp for WooCommerce', 'woo-order-on-whatsapp' );?>" class="owm-offer-banner__image" decoding="async">
				</picture>
			</a>
		<?php endif; ?>

		<p class="submit">
			<button type="submit" name="submit_dados_update" id="submit_evwapp" class="button button-primary"><?php esc_html_e( 'Save settings', 'woo-order-on-whatsapp' );?></button>
		</p>
	</form>
</div>
