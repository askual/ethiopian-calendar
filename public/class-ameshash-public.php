<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://askual.com
 * @since      1.0.0
 *
 * @package    Ameshash
 * @subpackage Ameshash/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ameshash
 * @subpackage Ameshash/public
 * @author     Askual Technologies <info@askual.com>
 */
use Geezify\Geezify;
use Andegna\Calender;

class Ameshash_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ameshash-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ameshash-public.js', array( 'jquery' ), $this->version, false );
	}
	/////////////////////////////////////////////
	function wporg_filter_title($title){
	    return 'The ' . $title . ' was filtered';
	}
	function to_andegna_calendar($date){
		$geez = Geezify::create();
		$date2 = new \DateTime($date);
		// $thetime = \Andegna\DateTimeFactory::fromDateTime($date2)->format(DATE_COOKIE);
		$thetime = \Andegna\DateTimeFactory::fromDateTime($date2);
		// return $thetime->format('Y-m-d')->format(Andegna\Constants::DATE_ETHIOPIAN);
		$options = get_option($this->plugin_name);
        // $orthodox = $options['orthodox'];
        $normal = $options['normal'];
        if ($normal == 2)
			return $thetime->format(Andegna\Constants::DATE_ETHIOPIAN);
		if ($normal == 1)
			return $thetime->format(Andegna\Constants::DATE_GEEZ_ORTHODOX);
		// return $geez->toGeez(123)." ".$date." ?";
	}
}
