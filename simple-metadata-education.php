<?php

/*
Plugin Name: Simple Metadata Education
Plugin URI: https://github.com/my-language-skills/simple-metadata-education
Description: Simple Metadata add-on for educational purposes
Version: 1.0
Author: My Language Skills team
Author URI: https://github.com/my-language-skills
Text Domain: simple-metadata-education
Domain Path: /languages
License: GPL 3.0
*/

defined ("ABSPATH") or die ("No script assholes!");

require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

//if not presbooks and AIOM not installed, load custom_metadata symbiont (when all packages will be organized, second condition can be removed)
if (!is_plugin_active('pressbooks/pressbooks.php') && !function_exists('x_add_metadata_field')){
	require_once plugin_dir_path( dirname(__FILE__ ) ) . '/simple-metadata-education/symbionts/custom-metadata/custom_metadata.php';
}

include_once plugin_dir_path( __FILE__ ) . "admin/smde-site-cpt.php";
include_once plugin_dir_path( __FILE__ ) . "admin/vocabularies/smde-lrmi-vocabulary.php";
include_once plugin_dir_path( __FILE__ ) . "admin/smde-admin-settings.php";
include_once plugin_dir_path( __FILE__ ) . "admin/smde-output.php";
include_once plugin_dir_path( __FILE__ ) . "admin/smde-init-metaboxes.php";
//loading network settings only for multisite installation
if (is_multisite()){
	include_once plugin_dir_path( __FILE__ ) . "network-admin/smde-network-admin-settings.php";
}