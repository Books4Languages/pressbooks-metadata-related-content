<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              aa
 * @since             1.0.0
 * @package           Prueba
 *
 * @wordpress-plugin
 * Plugin Name:       Prueba
 * Plugin URI:        aa
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Nicole
 * Author URI:        aa
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       prueba
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-prueba-activator.php
 */
function activate_prueba() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-prueba-activator.php';
	Prueba_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-prueba-deactivator.php
 */
function deactivate_prueba() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-prueba-deactivator.php';
	Prueba_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_prueba' );
register_deactivation_hook( __FILE__, 'deactivate_prueba' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-prueba.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_prueba() {

	$plugin = new Prueba();
	$plugin->run();

}
run_prueba();
