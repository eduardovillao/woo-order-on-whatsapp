<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div id="tab-checkout-content" class="myd-tabs-content">

    <h2><?php esc_html_e( 'Checkout', 'woo-order-on-whatsapp' );?></h2>
    <p><?php esc_html_e( 'In this section you can edit your message used in redirect after checkout.', 'woo-order-on-whatsapp' );?></p>
    
    <div class="card">
        <h3><?php esc_html_e( 'How to use?', 'woo-order-on-whatsapp' );?></h3>
        <p>2 - <?php esc_html_e( 'Define the template for products loop in "Template for Products Loop" for use in your custom message.', 'woo-order-on-whatsapp' );?></p>
        <p>2 - <?php esc_html_e( 'Create full custom message in "Custom Order Message" for use when customer is redirects to WhatsApp after checkout.', 'woo-order-on-whatsapp' );?></p>
    </div>

    <h3><?php esc_html_e( 'Template for Products Loop', 'woo-order-on-whatsapp' );?> <?php OMW_Utils::get_pro_tag(); ?></h3>
    <p class="description"><?php esc_html_e( 'Avaliable tokens for product loop.', 'woo-order-on-whatsapp' );?></p>

    <ul>
        <li><code>{product-name}</code> - <?php esc_html_e( 'Product Name', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{product-price}</code> - <?php esc_html_e( 'Product Price', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{product-qty}</code> - <?php esc_html_e( 'Product Quantity', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{product-sku}</code> - <?php esc_html_e( 'Product Sku', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{product-atributes}</code> - <?php esc_html_e( 'Product Atributes', 'woo-order-on-whatsapp' );?>.</li>
    </ul>

    <textarea name="evwapp_opiton_product_order_message" class="large-text" disabled rows="6"><?php echo get_option( 'evwapp_opiton_product_order_message' );?></textarea>

    <div class="card">
        <h3><?php esc_html_e( 'Important:', 'woo-order-on-whatsapp' );?></h3>
        <p><?php esc_html_e( '"Template for Products Loop" its a loop, so you must use each token once. The plugin will repeat this loop for all products in your order.', 'woo-order-on-whatsapp' );?></p>
    </div>

    <h3><?php esc_html_e( 'Custom Order Message', 'woo-order-on-whatsapp' );?> <?php OMW_Utils::get_pro_tag(); ?></h3>
    <p class="description"><?php esc_html_e( 'Avaliable tokens for message.', 'woo-order-on-whatsapp' );?></p>
        
    <ul>
        <li><code>{order-number}</code> - <?php esc_html_e( 'Order Number', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{order-payment}</code> - <?php esc_html_e( 'Order Payment', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{order-subtotal}</code> - <?php esc_html_e( 'Order Subtotal', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{order-total}</code> - <?php esc_html_e( 'Order Total', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{order-note}</code> - <?php esc_html_e( 'Order Note', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{order-products}</code> - <?php esc_html_e( "Order Products. This token is the result of the configuration above, don't forget to add it.", 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{customer-name}</code> - <?php esc_html_e( 'Customer name', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{customer-phone}</code> - <?php esc_html_e( 'Customer Phone', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{customer-mail}</code> - <?php esc_html_e( 'Customer Mail', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{customer-address}</code> - <?php esc_html_e( 'Customer Address', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{customer-state}</code> - <?php esc_html_e( 'Customer State', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{customer-city}</code> - <?php esc_html_e( 'Customer City', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{customer-zipcode}</code> - <?php esc_html_e( 'Customer Zipcode', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{shipping-total}</code> - <?php esc_html_e( 'Shipping Total', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{shipping-method}</code> - <?php esc_html_e( 'Shipping Method', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{meta-{[your-meta-field]}</code> - <?php esc_html_e( 'Get value from custom fields', 'woo-order-on-whatsapp' );?>.</li>
        <li><code>{meta-data-{[your-meta]}</code> - <?php esc_html_e( 'Get value from custom order meta (Inputs created in the checkout form)', 'woo-order-on-whatsapp' );?>.</li>
    </ul>

    <textarea name="evwapp_opiton_order_message" class="large-text" rows="20" disabled ><?php echo get_option( 'evwapp_opiton_order_message' );?></textarea>

</div>