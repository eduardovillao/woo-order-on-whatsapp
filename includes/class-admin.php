<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to implement admin options
 *
 * @since 2.8
 */
class OMW_Admin {
	/**
	 * Settings option group
	 *
	 * @since 2.8
	 */
	public $option_group;

	/**
	 * Plugin name
	 *
	 * @since 2.8
	 */
	public $plugin_name;

	/**
	 * Page options slug
	 *
	 * @since 2.8
	 */
	public $page_options_slug;

	/**
	 * Page title
	 *
	 * @since 2.0
	 */
	public $page_title;

	/**
	 * Settings
	 *
	 * @since 2.8
	 */
	public $settings = [];

	/**
	 * Page templates
	 *
	 * @since 2.0
	 */
	public $templates = [];

	/**
	 * Construct the class
	 *
	 * @since 2.8
	 */
	public function __construct() {

		$this->option_group = 'evwapp-settings-group';
		$this->plugin_name = 'Order Mobile for WooCommerce';
		$this->page_title = 'Order on Mobile for WooCommerce Options';
		$this->page_options_slug = 'order-on-mobile-for-woocommerce-config';
		$this->settings = [
			'evwapp_opiton_phone_number' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_message' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_message_cart' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_text_button' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_text_button_cart' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_target' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_show_cart' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_remove_btn' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_remove_cart_btn' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_remove_price' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_text_btn_thank' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_message_thank' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_title_thank' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_show_btn_single' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			],
			'evwapp_opiton_cart_button_target' => [
				'option_group' => $this->option_group,
				'args' => [
					'sanitize_callback' => 'sanitize_text_field',
				]
			]
		];

		$this->templates = [
			'general' => OMW_PLUGIN_PATH . 'templates/admin/tab-general.php',
			'checkout' => OMW_PLUGIN_PATH . 'templates/admin/tab-checkout.php',
			'single_product' => OMW_PLUGIN_PATH . 'templates/admin/tab-single-product.php',
			'cart' => OMW_PLUGIN_PATH . 'templates/admin/tab-cart.php',
			'support' => OMW_PLUGIN_PATH . 'templates/admin/tab-support.php',
		];
	}

	///'evwapp_opiton_phone_number' intval

	/**
	 * Undocumented function
	 *
	 * @since 2.8
	 * @return void
	 */
	public function add_admin_page() {
		\add_menu_page(
			apply_filters( 'omw_admin_page_title', $this->page_title ),
			apply_filters( 'omw_admin_page_name', $this->plugin_name ),
			'publish_posts',
			'order-on-mobile-for-woocommerce-dashboard',
			'',
			OMW_PLUGN_URL . 'assets/img/whatsapp.webp',
			56,
		);

		\add_submenu_page(
			'order-on-mobile-for-woocommerce-dashboard',
			\esc_html__( 'Dashboard', 'woo-order-on-whatsapp' ),
			\esc_html__( 'Dashboard', 'woo-order-on-whatsapp' ),
			'publish_posts',
			'order-on-mobile-for-woocommerce-dashboard',
			[ $this, 'get_template_dashboard' ],
			0
		);

		\add_submenu_page(
			'order-on-mobile-for-woocommerce-dashboard',
			\esc_html__( 'Settings', 'woo-order-on-whatsapp' ),
			\esc_html__( 'Settings', 'woo-order-on-whatsapp' ),
			'publish_posts',
			apply_filters( 'omw_admin_page_slug', $this->page_options_slug ),
			[ $this, 'create_admin_page' ],
			1
		);
	}

	public function get_template_dashboard() {
		$template = apply_filters( 'omw_template_path_dashboard', OMW_PLUGIN_PATH . 'templates/admin/dashboard.php' );
		include_once $template;
	}

	/**
	 * Register settings
	 *
	 * @since 2.8
	 * @return void
	 */
	public function register_settings() {

		/**
		 * Action to implement more admin settings.
		 */
		$settings = apply_filters( 'omw_before_register_admin_settings', $this->settings );

		foreach( $settings as $setting_name => $data ) {

			register_setting(
				$data['option_group'],
				$setting_name,
				$data['args']
			);
		}
	}

	/**
	 * Admin page
	 *
	 * @since 2.8
	 * @return void
	 */
	public function create_admin_page() {

		/**
		 * Action to edit/extende admin page templates.
		 */
		$templates = apply_filters( 'omw_after_output_templates', $this->templates );

		include_once OMW_PLUGIN_PATH . 'templates/admin/tab-header.php';
		foreach( $templates as $template ) {
			include_once $template;
		}
		include_once OMW_PLUGIN_PATH . 'templates/admin/tab-footer.php';
	}
}
