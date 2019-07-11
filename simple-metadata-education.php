<?php

/**
 * Simple Metadata - Education
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/my-language-skills/simple-metadata-education
 * @since             1.0
 * @package           simple-metadata-education
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Metadata - Education
 * Plugin URI:        https://github.com/my-language-skills/simple-metadata-education
 * Description:       Simple Metadata add-on for educational purposes.
 * Version:           1.1
 * Author:            My Language Skills team
 * Author URI:        https://github.com/my-language-skills/
 * License:           GPL 3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       simple-metadata-education
 * Domain Path:       /languages
 */

defined ("ABSPATH") or die ("No script assholes!");

require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

//we enable plugin functionality only if main plugin - Simple Metadata - is installed
if(is_plugin_active('simple-metadata/simple-metadata.php')){
	include_once plugin_dir_path( __FILE__ ) . "admin/vocabularies/smde-vocabulary.php";
	include_once plugin_dir_path( __FILE__ ) . "admin/vocabularies/smde-lrmi-vocabulary.php";
	include_once plugin_dir_path( __FILE__ ) . "admin/vocabularies/smde-classification-vocabulary.php";
	include_once plugin_dir_path( __FILE__ ) . "admin/smde-admin-settings.php";
	include_once plugin_dir_path( __FILE__ ) . "admin/smde-output.php";
	include_once plugin_dir_path( __FILE__ ) . "admin/smde-init-metaboxes.php";
	//loading network settings only for multisite installation
	if (is_multisite()){
		include_once plugin_dir_path( __FILE__ ) . "network-admin/smde-network-admin-settings.php";
	}
} else { //in case Simple Metadata is not installed, we notify user about it and do not enable plugin functionality
	//notification for multisite installation
	if (is_multisite()){
		add_action( 'network_admin_notices', function () {
			?>
    		<div class="notice notice-info is-dismissible">
        		<p>
							<strong>'Simple Metadata Education'</strong>
							<?php esc_html_e('functionality is deprecated due to the following reason:', 'simple-metadata-education'); ?>
							<strong>'Simple Metadata'</strong>
							<?php esc_html_e('plugin is not installed or not activated. Please, install', 'simple-metadata-education'); ?>
							<strong>'Simple Metadata'</strong>
							<?php esc_html_e('in order to fix the problem.', 'simple-metadata-education'); ?>
						</p>
    		</div>
    	<?php
		});
	} else { //notification for single site installation
		add_action( 'admin_notices', function () {
			?>
    		<div class="notice notice-info is-dismissible">
        		<p>
							<strong>'Simple Metadata Education'</strong>
							<?php esc_html_e('functionality is deprecated due to the following reason:', 'simple-metadata-education'); ?>
							<strong>'Simple Metadata'</strong>
							<?php esc_html_e('plugin is not installed or not activated. Please, install', 'simple-metadata-education'); ?>
							<strong>'Simple Metadata'</strong>
							<?php esc_html_e('in order to fix the problem.', 'simple-metadata-education'); ?>
						</p>
    		</div>
    	<?php
		});
	}
}

/**
 * Internalization
 * It loads the MO file for plugin's translation
 *
 * @since 1.2
 * @author @davideC00
 *
 */
	function smde_load_plugin_textdomain() {
    load_plugin_textdomain( 'simple-metadata-education', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

/**
 * Called when the activated plugin has been loaded
 */
add_action( 'plugins_loaded', 'smde_load_plugin_textdomain' );
