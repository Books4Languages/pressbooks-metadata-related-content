<?php

/*
Plugin Name: Simple Metadata Education
Plugin URI: https://github.com/my-language-skills/simple-metadata-education
Description: Simple Metadata add-on for educational purposes.
Version: 1.0
Author: My Language Skills team
Author URI: https://github.com/my-language-skills
Text Domain: simple-metadata-education
Domain Path: /languages
License: GPL 3.0
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
        		<p><strong>'Simple Metadata Education'</strong> functionality is deprecated due to the following reason: <strong>'Simple Metadata'</strong> plugin is not installed or not activated. Please, install <strong>'Simple Metadata'</strong> in order to fix the problem.</p>
    		</div>
    	<?php
		});
	} else { //notification for single site installation
		add_action( 'admin_notices', function () {
			?>
    		<div class="notice notice-info is-dismissible">
        		<p><strong>'Simple Metadata Education'</strong> functionality is deprecated due to the following reason: <strong>'Simple Metadata'</strong> plugin is not installed or not activated. Please, install <strong>'Simple Metadata'</strong> plugin in order to fix the problem.</p>
    		</div>
    	<?php
		});
	}
}
/*
* Auto update from github
*
* @since 1.0
*/
require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
		'https://github.com/my-language-skills/simple-metadata-education/',
		__FILE__,
		'simple-metadata-education'
);
