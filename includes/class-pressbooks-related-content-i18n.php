<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       Nicole
 * @since      0.1
 *
 * @package    Pressbooks_Related_Content
 * @subpackage Pressbooks_Related_Content/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.1
 * @package    Pressbooks_Related_Content
 * @subpackage Pressbooks_Related_Content/includes
 * @author     Nicole <nicoleacuna95@gmail.com>
 */
class Pressbooks_Related_Content_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pressbooks-related-content',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
