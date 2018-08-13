<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              Nicole
 * @since             0.1
 * @package           Pressbooks_Related_Content
 *
 * @wordpress-plugin
 * Plugin Name:       Pressbooks-related-content
 * Plugin URI:        Pb-rc
 * Description:       This plugin creates links fields in  new chapter metabox and shot this information in frontend
 * Version:           0.1
 * Author:            Nicole
 * Author URI:        Nicole
 * License:           GPL-3.0
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pressbooks-related-content
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pressbooks-related-content-activator.php
 */
function activate_pressbooks_related_content() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pressbooks-related-content-activator.php';
	Pressbooks_Related_Content_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pressbooks-related-content-deactivator.php
 */
function deactivate_pressbooks_related_content() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pressbooks-related-content-deactivator.php';
	Pressbooks_Related_Content_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pressbooks_related_content' );
register_deactivation_hook( __FILE__, 'deactivate_pressbooks_related_content' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pressbooks-related-content.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1
 */
function run_pressbooks_related_content() {

	$plugin = new Pressbooks_Related_Content();
	$plugin->run();

}
run_pressbooks_related_content();
