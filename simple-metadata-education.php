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

include_once plugin_dir_path( __FILE__ ) . "admin/smde-site-cpt.php";
include_once plugin_dir_path( __FILE__ ) . "admin/smde-admin-settings.php";
include_once plugin_dir_path( __FILE__ ) . "admin/smde-init-metaboxes.php";
include_once plugin_dir_path( __FILE__ ) . "network-admin/smde-network-admin-settings.php";