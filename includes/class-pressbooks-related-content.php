<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       Nicole
 * @since      0.1
 *
 * @package    Pressbooks_Related_Content
 * @subpackage Pressbooks_Related_Content/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      0.1
 * @package    Pressbooks_Related_Content
 * @subpackage Pressbooks_Related_Content/includes
 * @author     Nicole <nicoleacuna95@gmail.com>
 */
class Pressbooks_Related_Content {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    0.1
	 * @access   protected
	 * @var      Pressbooks_Related_Content_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    0.1
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    0.1
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    0.1
	 */
	public function __construct() {

		$this->plugin_name = 'pressbooks-related-content';
		$this->version = '0.1.0.0';
		$this->load_dependencies();
		$this->set_locale();
		$this->define_metadata_changes();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Pressbooks_Related_Content_Loader. Orchestrates the hooks of the plugin.
	 * - Pressbooks_Related_Content_i18n. Defines internationalization functionality.
	 * - Pressbooks_Related_Content_Admin. Defines all hooks for the admin area.
	 * - Pressbooks_Related_Content_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    0.1
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * Functions related with plugins
		 */
		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pressbooks-related-content-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pressbooks-related-content-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-pressbooks-related-content-admin.php';

		 
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-pressbooks-related-content-public.php';
		/*
		*
		* The class responsible for print rescource metabox in frontend
		*/
		require_once plugin_dir_path( dirname(__FILE__) ) . 'includes/class-external-content.php';
		/**
		*
		* The class responsible for print related books metadata in frontend
		*/

		require_once plugin_dir_path( dirname(__FILE__) ) . 'includes/classs-pressbooks-related-books-metadata.php';
		/*
		*
		* The php file on are the shortcodes
		*/
		require_once plugin_dir_path( dirname(__FILE__) ) . 'includes/class-pressbooks-related-functions.php';

		/**
		 * Files with educational metadata
		 */
		require_once plugin_dir_path( dirname(__FILE__) ) . 'admin/class-pressbooks-metadata-educational.php';
		require_once plugin_dir_path( dirname(__FILE__) ) . 'admin/class-pressbooks-metadata-dublin.php';
		require_once plugin_dir_path( dirname(__FILE__) ) . 'admin/class-pressbooks-metadata-coins.php';



		/**
		 * Registering Site-Meta post type if AIOM not installed and add custom-metadata functionality
		 */
		if (!is_plugin_active('all-in-one-metadata/all-in-one-metadata.php')){
			require_once plugin_dir_path( dirname(__FILE__) ) . 'admin/class-pressbooks-metadata-site-cpt.php';
			if (!is_plugin_active('pressbooks/pressbooks.php')){	

				include_once plugin_dir_path( dirname( __FILE__ ) ) . 'symbionts/custom-metadata/custom_metadata.php';
			}
		}

		$this->loader = new Pressbooks_Related_Content_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Pressbooks_Related_Content_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    0.1
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Pressbooks_Related_Content_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}
	  
	/**
	 * Register all of the metadata customization that are
	 * in Pb_Rc_Chapter class.
	 *
	 *
	 * @since    0.1
	 * @access   private
	 */
	private function define_metadata_changes() {
		
		//create a instance of Pb_Rc_chapter class
		$plugin_chapter_metadata = new Pb_Rc_Chapter( $this->get_plugin_name(), $this->get_version() );
		//create a instance of Pressbooks_Metadata_Related_Books_Metadata
		$plugin_related_books_metadata = new Pb_Rc_Books($this->get_plugin_name(), $this->get_version());
		
	}
	

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    0.1
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Pressbooks_Related_Content_Admin( $this->get_plugin_name(), $this->get_version() );

		//Load the options page
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'rc_add_option_pages' );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		// call the function options_checkbox that create a sections in admin page
		$this->loader->add_action( 'admin_init', $plugin_admin, 'options_checkbox' );
		// call the add_related_metabox function that know which settings have been selected 
		//and this to be able to create or not the fields in the metabox Related books
		$this->loader->add_action( 'custom_metadata_manager_init_metadata', $plugin_admin, 'add_related_metabox', 31 );
		// call the resourceS_in_post_type function that knows that checkbox has been selected and call other fucntion
		$this->loader->add_action( 'custom_metadata_manager_init_metadata', $plugin_admin, 'resources_in_post_type', 32 );
		// adds educational metadata metaboxes in desired locations
		$this->loader->add_action( 'custom_metadata_manager_init_metadata', $plugin_admin, 'edu_in_post_type', 33 );
		//adds metabox for links with translations
		$this->loader->add_action( 'custom_metadata_manager_init_metadata', $plugin_admin, 'trans_links', 34 );

		//Creating a custom post for site level metadata - only when pressbooks is not present
		if (!is_plugin_active('all-in-one-metadata/all-in-one-metadata.php')) {
			if (!\adminFunctions\Pressbooks_Metadata_Site_Cpt::pressbooks_identify()) {
				$this->loader->add_action( 'init', new \adminFunctions\Pressbooks_Metadata_Site_Cpt(), 'init' );
				$this->loader->add_action( 'post_updated_messages', new \adminFunctions\Pressbooks_Metadata_Site_Cpt(), 'change_custom_post_mess' );
			}
		}
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    0.1
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Pressbooks_Related_Content_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    0.1
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     0.1
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     0.1
	 * @return    Pressbooks_Related_Content_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     0.1
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}