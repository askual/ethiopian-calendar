<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://askual.com
 * @since             1.0.0
 * @package           Ameshash
 *
 * @wordpress-plugin
 * Plugin Name:       ameshash
 * Plugin URI:        http://askual.com/wordpress/ameshash
 * Description:       Bringing Ethiopian Calendar to WP world.
 * Version:           1.0.0
 * Author:            Askual Technologies
 * Author URI:        http://askual.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ameshash
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ameshash-activator.php
 */
function activate_ameshash() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ameshash-activator.php';
	Ameshash_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ameshash-deactivator.php
 */
function deactivate_ameshash() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ameshash-deactivator.php';
	Ameshash_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ameshash' );
register_deactivation_hook( __FILE__, 'deactivate_ameshash' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ameshash.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ameshash() {

	$plugin = new Ameshash();
	$plugin->run();

}
run_ameshash();
