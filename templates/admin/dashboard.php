<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="wrap">
	<h1>
		<?php esc_html_e( 'Dashboard', 'woo-order-on-whatsapp' ); ?>
	</h1>

	<section class="myd-custom-content-page">
		<?php if ( ! did_action( 'oww_plugin_init' ) ) : ?>
			<a class="owm-offer-banner__link" href="https://codecanyon.net/item/order-on-whatsapp-for-woocommerce/25824812" target="_blank">
				<picture>
					<source srcset="/wp-content/plugins/woo-order-on-whatsapp/assets/img/own-offer-banner.avif" type="image/avif">
					<source srcset="/wp-content/plugins/woo-order-on-whatsapp/assets/img/own-offer-banner.webp" type="image/webp">
					<img src="/wp-content/plugins/woo-order-on-whatsapp/assets/img/own-offer-banner.png" alt="<?php esc_html_e( 'Order on WhatsApp for WooCommerce', 'woo-order-on-whatsapp' );?>" class="owm-offer-banner__image" decoding="async">
				</picture>
			</a>
		<?php endif; ?>

		<div class="myd-admin-cards myd-card-2columns">
			<div class="mydd-admin-card">
				<h2 class="mydd-admin-card__title"><?php esc_html_e( 'Quick Access', 'woo-order-on-whatsapp' ); ?></h2>

				<div class="mydd-admin-card__content">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" color="#6a7282" fill="none">
						<path d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z" stroke="#6a7282" stroke-width="1.5" stroke-linejoin="round"></path>
						<path d="M8.5 10C7.67157 10 7 9.32843 7 8.5C7 7.67157 7.67157 7 8.5 7C9.32843 7 10 7.67157 10 8.5C10 9.32843 9.32843 10 8.5 10Z" stroke="#6a7282" stroke-width="1.5"></path>
						<path d="M15.5 17C16.3284 17 17 16.3284 17 15.5C17 14.6716 16.3284 14 15.5 14C14.6716 14 14 14.6716 14 15.5C14 16.3284 14.6716 17 15.5 17Z" stroke="#6a7282" stroke-width="1.5"></path>
						<path d="M10 8.5L17 8.5" stroke="#6a7282" stroke-width="1.5" stroke-linecap="round"></path>
						<path d="M14 15.5L7 15.5" stroke="#6a7282" stroke-width="1.5" stroke-linecap="round"></path>
					</svg>

					<div class="mydd-admin-card__text">
						<h3 class="myd-admin-cards__title"><?php esc_html_e( 'Settings', 'woo-order-on-whatsapp' ); ?></h3>
						<p class="myd-admin-cards__description"><?php esc_html_e( 'Configure checkout, delivery and general preferences.', 'woo-order-on-whatsapp' ); ?></p>
					</div>

					<a class="mydd-admin-button myd-cards--margin-top10" href="<?php echo esc_attr( site_url( '/wp-admin/admin.php?page=order-on-mobile-for-woocommerce-config' ) ); ?>">
						<?php echo esc_html_e( 'Access', 'woo-order-on-whatsapp' );?>
					</a>
				</div>
			</div>

			<div class="mydd-admin-card">
				<?php
					echo \WPFeatureLoop\Client::getInstance('cmljj016h000004l4i9gn0pkd')->renderWidget();
				?>
			</div>
		</div>
	</section>
</div>
