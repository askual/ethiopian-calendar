<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://askual.com
 * @since      1.0.0
 *
 * @package    Ethiopian_Calendar
 * @subpackage Ethiopian_Calendar/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ethiopian_Calendar
 * @subpackage Ethiopian_Calendar/admin
 * @author     Askual Tech <info@askual.com>
 */
class Ethiopian_Calendar_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ethiopian-calendar-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ethiopian-calendar-admin.js', array( 'jquery' ), $this->version, false );

	}



	public function register_ethiopian_calendar_menu_page() {
		// add_options_page( 'ethiopian Calendar by Askual', 'ethiopian Calendar by Askual', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'));
		add_menu_page(
			'Ethiopian Calendar',
			'Ethiopian Calendar',
			'add_users',
			$this->plugin_name,
			array($this,'display_ethiopian_calendar_home_page'),
			'dashicons-calendar-alt'
		);

		add_submenu_page($this->plugin_name,'settings', 'Settings', 'add_users', $this->plugin_name.'_setting', array($this,'display_ethiopian_calendar_setting_page'));

	}
	public function display_ethiopian_calendar_home_page() {
		include_once( 'partials/ameshash-admin-home.php' );
	}
	public function display_ethiopian_calendar_setting_page() {
		include_once( 'partials/ameshash-admin-settings.php' );
	}



	public function add_action_links( $links ) {
	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">	' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );
	}
	public function options_update() {
	    register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}
	public function validate($input) {
	    // All checkboxes inputs
	    $valid = array();

			if ( isset( $input['language'] ) ) {
	    	$valid['language'] = $input['language'];
	    }
			if ( isset( $input['format'] ) ) {
	    	$valid['format'] = $input['format'];
	    }

	    if ( isset( $input['normal'] ) ) {
	    	$valid['normal'] = $input['normal'];
	    }
	    // $valid['normal'] = array_map('wp_filter_nohtml_kses', (array)$normal);
	    $valid['abnormal'] = (isset($input['normal']) && !empty($input['normal'])) ? 1 : 0;
	    // $valid['orthodox'] = (isset($input['orthodox']) && !empty($input['orthodox'])) ? 1 : 0;
	    return $valid;
	}









	function my_plugin_menu() {
		add_dashboard_page('My Plugin Dashboard', 'My Plugin', 'read', 'my-unique-identifier', 'my_plugin_function');
	}


	// Function that outputs the contents of the dashboard widget
	function dashboard_widget_function( $post, $callback_args ) {
		echo "Hello World, this is my first Dashboard Widget!";
	}

	function askual_ethiopian_activation_notice()
	{
		if($_SERVER['SERVER_PORT'] != 80){
			$port = ":".$_SERVER['SERVER_PORT'];
		}else{
			$port = "";
		}
		if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
			$url = "https://".$_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
		}else{
			$url = "http://".$_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
		}
		$dismissed = get_option('wpp_dismissed', false);
		if (!$dismissed && $dismissed!=0) {
			global $wpp_settings;
			if ($wpp_settings['persian_date'] != 'enable' && $url != admin_url('admin.php?page=ethiopian-calendar_setting')) {
				$output = sprintf(__('<div class="updated wpp-message"><p>ethiopian activated, you may need to configure it to work properly. <a href="%s">Go to configuration page</a> &ndash; <a href="%s">Dismiss</a></p></div>', 'wp-parsidate'), admin_url('admin.php?page=ethiopian-calendar_setting'), add_query_arg('wpp-action', 'dismiss-notice'));
				echo $output;
			}
		}
	}

}
