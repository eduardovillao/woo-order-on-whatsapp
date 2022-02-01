<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div id="tab-advanced-content" class="myd-tabs-content">
    
    <h2><?php esc_html_e( 'Advanced Settings', 'woo-order-on-whatsapp' );?></h2>
    <p><?php esc_html_e( 'In this section you can edit some advanced options.', 'woo-order-on-whatsapp' );?></p>
            
    <table class="form-table">
        <tbody>
            <tr class="evwapp_trackingcode">
                <th scope="row">
                    <label for="wow_tracking_code"><b>CHANGE</b></label>
                </th>
                <td>
                    <input type="text" name="evwapp_tracking_code" class="evwapp_input" value="<?php echo get_option('evwapp_tracking_code'); ?>">
                    <p class="wow_desc">CHANGE.</p>
                </td>
            </tr>
        </tbody>
    </table>

</div>