<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://askual.com
 * @since      1.0.0
 *
 * @package    Ameshash
 * @subpackage Ameshash/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ameshash
 * @subpackage Ameshash/admin
 * @author     Askual Technologies <info@askual.com>
 */
class Ameshash_Admin {

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

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ameshash_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ameshash_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ameshash-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ameshash_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ameshash_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ameshash-admin.js', array( 'jquery' ), $this->version, false );

	}

	////////////////////////////////////////////////////////
	public function add_plugin_admin_menu() {
	    add_options_page( 'Ameshash by Askual', 'Ameshash by Askual', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
	    );
	}	
	public function add_action_links( $links ) {
	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );
	}
	public function display_plugin_setup_page() {
	    include_once( 'partials/ameshash-admin-display.php' );
	}
	public function options_update() {
	    register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}
	public function validate($input) {
	    // All checkboxes inputs        
	    $valid = array();

	    if ( isset( $input['normal'] ) ) {
	    	$valid['normal'] = $input['normal'];
	    }
	    // $valid['normal'] = array_map('wp_filter_nohtml_kses', (array)$normal);
	    $valid['abnormal'] = (isset($input['normal']) && !empty($input['normal'])) ? 1 : 0;
	    // $valid['orthodox'] = (isset($input['orthodox']) && !empty($input['orthodox'])) ? 1 : 0;
	    return $valid;
	}

}
