<?php
function evowap_add_admin_page() {
    //Generate evowap Admin Page
    add_menu_page( 'Woo Order on WhatsApp Options', 'Order on Mobile for Wocoommerce', 'manage_options', 'evowap_plugin_config', 'evowap_create_admin_page', plugin_dir_url( __FILE__ ) . '/img/whatsapp.png', 56 );

    //call register settings function
    add_action( 'admin_init', 'evowap_register_settings' );
}
add_action( 'admin_menu', 'evowap_add_admin_page' );

function evowap_register_settings() {
    ////register our settings
    register_setting( 'evwapp-settings-group', 'evwapp_opiton_phone_number' );
    register_setting( 'evwapp-settings-group', 'evwapp_opiton_message' );
    //register_setting( 'evwapp-settings-group', 'evwapp_opiton_message_cart' );
    register_setting( 'evwapp-settings-group', 'evwapp_opiton_text_button' );
    //register_setting( 'evwapp-settings-group', 'evwapp_opiton_text_button_cart' );
    register_setting( 'evwapp-settings-group', 'evwapp_opiton_target' );
    //register_setting( 'evwapp-settings-group', 'evwapp_opiton_show_cart' );
    //register_setting( 'evwapp-settings-group', 'evwapp_opiton_title' );
    //register_setting( 'evwapp-settings-group', 'evwapp_opiton_price' );
    //register_setting( 'evwapp-settings-group', 'evwapp_opiton_link' );
    register_setting( 'evwapp-settings-group', 'evwapp_opiton_remove_btn' );
    register_setting( 'evwapp-settings-group', 'evwapp_opiton_remove_price' );
    register_setting( 'evwapp-settings-group', 'evwapp_opiton_remove_cart_btn' );
    register_setting( 'evwapp-settings-group', 'evwapp_opiton_remove_btn' );
    //register_setting( 'evwapp-settings-group', 'evwapp_tracking_code' );
    add_option( 'evwapp_opiton_title', 'title' );
    add_option( 'evwapp_opiton_price', 'price' );
    add_option( 'evwapp_opiton_link', 'link' );
    add_option( 'evwapp_opiton_phone_number', '' );
    add_option( 'evwapp_opiton_message', '' );
    add_option( 'evwapp_opiton_text_button', '' );
}

function evowap_create_admin_page(){
?>
<div class="wrap">
    <h1>Order on Mobile for Wocoommerce</h1>
    <?php settings_errors(); ?>
    <h2 id="tabs" class="nav-tab-wrapper">
        <a href="#tab_basic_settings" id="tab-basic" class="nav-tab nav-tab-active">Bassic Settings</a>
        <a href="#tab_advanced_settings" id="tab-advanced" class="nav-tab ">Advanced Settings</a>
        <a href="#tab_support_content" id="tab-support" class="nav-tab ">Support</a>
    </h2>
    <form method="post" action="options.php">
    <?php settings_fields( 'evwapp-settings-group' ); ?>
    <div id="tab-basic-settings" class="wowapp-settings-form-page wowapp-active">           
        <h2 class="section_wow">Basic Settings</h2>
            <table class="form-table">
            <tbody>
                <tr class="evwapp_number">
                    <th scope="row">
                        <label class="evwapp_number_label" for="phone_number"><b>Your WhatsApp Number</b></label>
                    </th>
                    <td>
                        <input type="number" name="evwapp_opiton_phone_number" class="evwapp_input" value="<?php echo get_option('evwapp_opiton_phone_number'); ?>" placeholder="Your Phone Number"><br>
                        <span class="wow_desc">Enter with your country code +5551XXXXXXXXX</span>
                    </td>
                </tr>
                <tr class="evwapp_target">
                    <th scope="row">
                        <label class="evwapp_target_label" for="wow_target"><b>Open in new tab?</b></label>
                    </th>
                    <td>
                        <input type="checkbox" name="evwapp_opiton_target" class="evwapp_input_check" value="_blank" <?php checked( get_option('evwapp_opiton_target'), '_blank' );?>>Yes, open in new tab.<br>
                    </td>
                </tr>
                </tbody>
                </table>
                <hr>
                <h2 class="section_wow">Single Product Page Settings</h2>
                <span class="wow_desc">This options is for button in Single Product Page.</span>
                <table class="form-table">
                <tbody>
                <tr class="evwapp_message">
                    <th scope="row">
                        <label class="evwapp_message_label" for="message_wbw"><b>Your Custom Message</b></label>
                    </th>
                    <td>
                        <textarea name="evwapp_opiton_message" class="evwapp_input_areatext" rows="5" placeholder="Your Custom Message"><?php echo get_option('evwapp_opiton_message'); ?></textarea>
                    </td>
                </tr>
                <tr class="evwapp_btn_text">
                    <th scope="row">
                        <label class="evwapp_btn_txt_label" for="text_button"><b>Button Text</b></label>
                    </th>
                    <td>
                        <input type="text" name="evwapp_opiton_text_button" class="evwapp_input" value="<?php echo get_option('evwapp_opiton_text_button'); ?>" placeholder="Order on WhatsApp">
                    </td>
                </tr>
                </tbody>
                </table>
                <hr>
                <h2 class="section_wow">Cart Page Settings <span id="notice-wowpro">PRO VERSION</span></h2>
                <span class="wow_desc">This options is for button in Cart Page.</span>
                <table class="form-table">
                <tbody>
                    <tr class="evwapp_target">
                    <th scope="row">
                        <label class="evwapp_target_label" for="wow_target"><b>Display Button in cart page?</b></label>
                    </th>
                    <td>
                        <input type="checkbox" name="evwapp_opiton_show_cart" class="evwapp_input_check" value="yes">Yes, show button in cart page.<br>
                    </td>
                </tr>
                    <tr class="evwapp_message">
                    <th scope="row">
                        <label class="evwapp_message_label" for="message_wbw"><b>Your Custom Message</b></label>
                    </th>
                    <td>
                        <textarea name="evwapp_opiton_message_cart" class="evwapp_input_areatext" rows="5" placeholder="Your Custom Message"></textarea>
                    </td>
                </tr>
                <tr class="evwapp_btn_text">
                    <th scope="row">
                        <label class="evwapp_btn_txt_label" for="text_button"><b>Button Text</b></label>
                    </th>
                    <td>
                        <input type="text" name="evwapp_opiton_text_button_cart" class="evwapp_input" value="" placeholder="Order on WhatsApp">
                    </td>
                </tr>
                </tbody>
                </table>
            </div>
            <div id="tab-advanced-settings" class="wowapp-settings-form-page">
            <h2 class="section_wow">Manage Advanced Settings</h2>
            <table class="form-table">
            <tbody>
                <tr class="evwapp_info_send">
                    <th scope="row">
                        <label class="evwapp_info_send_label" for="wow_info_send"><b>What information do you want to receive?</b> <span id="notice-wowpro">PRO VERSION</span></label>
                    </th>
                    <td>
                        <input type="checkbox" name="evwapp_opiton_title" class="evwapp_input_check" value="title" checked="checked"> Product Title<br>

                        <input type="checkbox" name="evwapp_opiton_price" class="evwapp_input_check" value="price" checked="checked"> Product Price<br>

                        <input type="checkbox" name="evwapp_opiton_link" class="evwapp_input_check" value="link" checked="checked"> Product Link
                    </td>
                </tr>
                <tr class="evwapp_remove_add_btn">
                    <th scope="row">
                        <label class="evwapp_remove_btn_label" for="wow_remove_wow_btn"><b>Hide WhatsApp Button on Desktop Device?</b> <span id="notice-wowpro">PRO VERSION</span></label>
                    </th>
                    <td>
                        <input type="checkbox" name="evwapp_opiton_remove_btn" class="evwapp_input_check" value="yes">Yes, remove WhatsApp Button on Desktop.<br>
                    </td>
                </tr>
            <tr class="evwapp_remove_price">
                    <th scope="row">
                        <label class="evwapp_price_label" for="wow_remove_price"><b>Hide Price in Product Page?</b></label>
                    </th>
                    <td>
                        <input type="checkbox" name="evwapp_opiton_remove_price" class="evwapp_input_check" value="yes" <?php checked( get_option('evwapp_opiton_remove_price'), 'yes' );?>>Yes, remove price in Product page.<br>
                    </td>
                </tr>
            <tr class="evwapp_remove_add_btn">
                    <th scope="row">
                        <label class="evwapp_remove_add_label" for="wow_remove_add_btn"><b>Hide Add to Cart button?</b></label>
                    </th>
                    <td>
                        <input type="checkbox" name="evwapp_opiton_remove_cart_btn" class="evwapp_input_check" value="yes" <?php checked( get_option('evwapp_opiton_remove_cart_btn'), 'yes' );?>>Yes, remove Add to Cart button.<br>
                    </td>
                </tr>
                <tr class="evwapp_shortcode">
                    <th scope="row">
                        <label class="evwapp_shortcode" for="wow_remove_add_btn"><b>Shortcode</b> <span id="notice-wowpro">PRO VERSION</span></label>
                    </th>
                    <td>
                        <input type="text" class="evwapp_input" value="[woo-order-on-whatsapp]"><br>
                        <span class="wow_desc">Use this shortcode in your custom product page.</span>
                    </td>
                </tr>
            </tbody>
            </table>
            <hr>
            <h2 class="section_wow">Tracking <span id="notice-wowpro">PRO VERSION</span></h2>
            <span class="wow_desc">If you have your Google Analytics tracking code already installed in your site you can ignore this setting field.</span>
            <table class="form-table">
            <tbody>
                <tr class="evwapp_trackingcode">
                    <th scope="row">
                        <label class="evwapp_tracing_code" for="wow_tracking_code"><b>Google Analytics tracking code</b></label>
                    </th>
                    <td>
                        <input type="text" name="evwapp_tracking_code" class="evwapp_input" value="" placeholder="UA-000000-3"><br>
                        <span class="wow_desc">Insert here the Google Analytics tracking code. Like UA-000000-3.</span><br>                        
                    </td>
                </tr>
            </tbody>
            </table>
            <p class="evwapp_p_desc"><b>Note: </b>If you want to be sure that your buttons are tracked in your Google Analytics account:<br>1. Go to your Google Analytics account > Click on Real Time > Events.<br>2. Open your website in another tab and click on a Woo Order on WhatsApp button.<br>3. Check if you see that the click gets tracked in Google Analytics Events page.</p>
        </div>
        <div id="tab-support-content" class="wowapp-settings-form-page">
            <h2 class="section_wow">You need support?</h2>
            <p class="evwapp_p_desc">Hello, thank you for using our plugin! If you need anything, contact us in <a href="https://wa.me/5551999732683?text=Hi,%20i%20need%20support" target="_blank">Premium Support.</a></p>
            <h3>How the plugin send My Messages?</h3>
                <p class="evwapp_p_desc">Your message will be sent as the example below</p>
                <img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/img_exemple.jpg'; ?>"/>
        </div>
        <br><button type="submit" name="submit_dados_update" id="submit_evwapp" class="button button-primary">Save Options</button>
    </form>
</div>  
<?php
}
