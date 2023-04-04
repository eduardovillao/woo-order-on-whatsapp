<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * OMW plugin main class
 *
 * Class to initialize the plugin.
 *
 * @since 2.8
 */
final class OMW_Plugin {
	/**
	 * Instance
	 *
	 * @since 2.2
	 *
	 * @access private
	 * @static
	 *
	 * @var OMW_Init The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Button in product page option
	 *
	 * @since 2.8
	 * @var string
	 */
	public $button_in_product_page;

	/**
	 * Button in cart page option
	 *
	 * @since 2.8
	 * @var string
	 */
	public $button_in_cart_page;

	/**
	 * Phone option
	 *
	 * @since 2.8
	 * @var int
	 */
	public $phone_number;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 2.2
	 *
	 * @access public
	 * @static
	 *
	 * @return OMW_Init An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

    /**
     * TODO: wakeup and clone functions
     */

	/**
	 * Constructor
	 *
	 * Private method for prevent instance outsite the class.
	 *
	 * @since 2.2
	 *
	 * @access private
	 */
	private function __construct() {

		$this->button_in_product_page = get_option( 'evwapp_opiton_show_btn_single');
		$this->button_in_cart_page = get_option( 'evwapp_opiton_show_cart' );
		$this->phone_number = get_option( 'evwapp_opiton_phone_number' );

        /**
         * Do action for pro version check loaded
         *
         * @since 2.0
         */
        do_action( 'omw_plugin_loaded' );

		// Init plugin
        add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin and all classes after WooCommerce and other plugins is loaded.
	 *
	 * @since 2.2
	 *
	 * @access public
	 */
	public function init() {

		/**
		 * Check if WooCommerce is activated
		 */
		if( ! $this->plugin_is_active( 'woocommerce/woocommerce.php' ) ) {

			add_action( 'admin_notcies', [ $this, 'notice_woo_inactived' ] );
			return;
		}

        /**
         * Do action for init other extensions
         *
         * @since 2.0
         */
        do_action( 'omw_plugin_init' );

        /**
         * Include initial required files
         */
		include_once OMW_PLUGIN_PATH . 'includes/class-utils.php';
		include_once OMW_PLUGIN_PATH . 'includes/abstract-class-button.php';

		/**
		 * TODO: Check basic if basic settings are selected
		 */

		/**
		 * Include admin class
		 */
		if( is_admin() ) {

			include_once OMW_PLUGIN_PATH . 'includes/class-admin.php';

            $admin = new OMW_Admin;
            add_action( 'admin_init', [ $admin, 'register_settings' ] );
            add_action( 'admin_menu', [ $admin, 'add_admin_page' ] );
		}

		/**
		 * Check option and include product page btn class
		 */
		if( $this->button_in_product_page === 'yes' ) {

			include_once OMW_PLUGIN_PATH . 'includes/class-button-product-page.php';

            $button_product_page = new OMW_Button_Product_Page;
			add_action( 'wp_head', [ $button_product_page, 'hide_woo_elements' ] );
			add_action( 'woocommerce_after_add_to_cart_form', [ $button_product_page, 'output_btn' ] );
			add_shortcode( 'woo-order-on-whatsapp', [ $button_product_page, 'output_btn' ] );
		}

		/**
		 * Check option and include car page btn class
		 */
		if( $this->button_in_cart_page === 'yes' ) {

			include_once OMW_PLUGIN_PATH . 'includes/class-button-cart.php';

            $button_cart = new OMW_Button_Cart;
			add_action('woocommerce_after_cart_table', [ $button_cart, 'output_btn' ] );
		}

		/**
		 * Enqueue styles and scripts
		 */
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_plugin_css' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_plugin_js' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_plugin_css' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_plugin_js' ] );
	}

	/**
	 * Admin notice - WooCommerce
	 *
	 * Warning when the site doesn't have WooCommerce activated.
	 *
	 * @since 2.2
	 *
	 * @access public
	 */
	public function notice_woo_inactived() {

		$message = sprintf(
			esc_html__( '%1$s requires WooCommerce to be installed and activated.', 'woo-order-on-whatsapp' ),
			'<strong>Order on WhatsApp for WooCommerce</strong>'
		);

		$html_message = sprintf( '<div class="notice notice-error"><p>%1$s</p></div>', $message );

		echo wp_kses_post( $html_message );
	}

	/**
	 * Enqueue CSS
	 *
	 * Register and enqueue CSS.
	 *
	 * @since 2.2
	 *
	 * @access public
	 */
	public function enqueue_plugin_css() {

		wp_enqueue_style( 'omw_style',  OMW_PLUGN_URL . '/assets/css/style.css', array(), OMW_VERSION );
	}

	/**
	 * Enqueue JS
	 *
	 * Register and enqueue JS.
	 *
	 * @since 2.2
	 *
	 * @access public
	 */
	public function enqueue_plugin_js() {

		wp_enqueue_script( 'omw_script',  OMW_PLUGN_URL . '/assets/js/front-js.js', array('jquery'), OMW_VERSION, true );
	}

	/**
	 * Enqueue ADMIN CSS
	 *
	 * Register and enqueue CSS.
	 *
	 * @since 2.2
	 *
	 * @access public
	 */
	public function enqueue_admin_plugin_css() {

		wp_enqueue_style( 'omw_admin_style',  OMW_PLUGN_URL . '/assets/css/admin/admin-style.css', array(), OMW_VERSION );
	}

	/**
	 * Enqueue ADMIN JS
	 *
	 * Register and enqueue JS.
	 *
	 * @since 2.2
	 *
	 * @access public
	 */
	public function enqueue_admin_plugin_js() {

		wp_enqueue_script( 'omw_admin_script', OMW_PLUGN_URL . '/assets/js/admin/admin-settings.js', [], OMW_VERSION, true );
	}

	/**
	 * Check plugin is activated
	 *
	 * @since 2.8
	 * @return boolean
	 * @param string $plugin
	 */
	public function plugin_is_active( $plugin ) {

		return function_exists( 'is_plugin_active' ) ? is_plugin_active( $plugin ) : in_array( $plugin, (array) get_option( 'active_plugins', array() ), true );
	}
}
