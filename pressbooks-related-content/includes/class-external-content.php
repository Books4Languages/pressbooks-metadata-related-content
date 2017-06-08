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
 * @package    Pressbooks-related-content
 * @subpackage Pressbooks-related-content/includes
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
 * @package    Pressbooks-related-content
 * @subpackage Pressbooks-related-content/includes
 * @author     Nicole <nicoleacuna95@gmail.com>
 */
/**
	* Initialize the class and set its properties.
	*
	* @since  0.1
	*/

	Class Pb_Rc_Chapter{

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	/**
	 * The version of this plugin.
	 *
	 * @since    0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      0.1
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	* The function which produces the metafields to other
	* Chapter metabox with custom metadata of Pressbooks
	*
	* @since 0.1
	*/
	public function add_metadata(){


		//---- Chapter Metadata metabox ----//

		// adds a new group to the Chapter post type
		x_add_metadata_group( 'resources_metadata', 'chapter', array(
			'label' => 'Resources'
		) );

		//----------- metafields ----------- //
		
		// add Activities metafield
		x_add_metadata_field( 	'pb_activities', 'chapter', array(
			'group' 		=>	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=>	'Activities',
			'description'	=>	'The URL of activities.',
			'placeholder' 	=>	'http://site.com/',
			'multiple'      =>  'true'
		) );

		// add Video metafield
		x_add_metadata_field( 	'pb_video', 'chapter', array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Video',
			'description' 	=> 	'The URL of video',
			'multiple'      =>  'true',
			'placeholder' 	=>	'http://site.com/'
		) );

		// add Audio metafield
		x_add_metadata_field( 	'pb_audio', 'chapter', array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Audio',
			'multiple'      =>  'true',
			'description' 	=> 	'The URL of audio',
			'placeholder' 	=>	'http://site.com/'
		) );

		//add Bibliography metafield
		x_add_metadata_field( 	'pb_bibliography', 'chapter', array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Bibliography',
			'multiple'      =>  'true',
			'description' 	=> 	'The URL of bibliography',
			'placeholder' 	=>	'http://site.com/'
		) );

		//add Exercises metafield
		x_add_metadata_field( 	'pb_exercises', 'chapter', array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Exercises',
			'multiple'      =>  'true',
			'description' 	=> 	'The URL of exercises',
			'placeholder' 	=>	'http://site.com/'
		) );

		

	}

	/**
	* This function return the instance of the class
	* @since 0.1
	*/
	public static function get_instance(){

		if ( NULL == Pb_Rc_Chapter::$instance ) {
			Pb_Rc_Chapter::$instance
				= new Pb_Rc_Chapter();
		}
		return Pb_Rc_Chapter::$instance;
	}
	
	/**
	 * Prints the HTML code of chapter metadata for the public part of
	 * the book.
	 * This function is called by resource pop out in sidebar.php 
	 * sidebar.php is localized in child theme: books4languages
	 *
	 * @since 0.1
	 */
	public function print_chapter_r_fields(){
	
	  /*Gets the chapter resources metadata from the database*/
        global $wpdb;
        global $post;
        $table_name=$wpdb->prefix.'postmeta';
        $meta_act = $wpdb->get_results("SELECT meta_value FROM $table_name WHERE meta_key='pb_activities' ORDER BY meta_id DESC");
        $meta_video = $wpdb->get_results("SELECT meta_value FROM $table_name WHERE meta_key='pb_video' ORDER BY meta_id DESC");
        $meta_audio = $wpdb->get_results("SELECT meta_value FROM $table_name WHERE meta_key='pb_audio' ORDER BY meta_id DESC");
        $meta_exer = $wpdb->get_results("SELECT meta_value FROM $table_name WHERE meta_key='pb_exercises' ORDER BY meta_id DESC");
        $meta_biblio = $wpdb->get_results("SELECT meta_value FROM $table_name WHERE meta_key='pb_bibliography' ORDER BY meta_id DESC");


       /* Create a table that contains the chapter metadata. Print this table in frontend */
		?>

		<table class="metadata_questtions_answers">
		
		<td> Actividades </td>
		<?php 
		foreach($meta_act as $meta_key) {
			?>
			<tr>
			<?php 
			//quitamos los 'http:// y https://'
			?>
			<td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$meta_key->meta_value.'"> >>GO>> </a>';?></p></td>
			</tr> 
		<?php
		}
		?>
		<td> Videos </td>
		<?php
		foreach($meta_video as $meta_key) {
		?>
			<tr>
			<td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$meta_key->meta_value.'"> >>GO>> </a>';?></p></td>
			</tr> 

		<?php
		}
		?>
		<td> Audios </td>
		<?php

		foreach($meta_audio as $meta_key) {
		?>
			<tr>
			<td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$meta_key->meta_value.'"> >>GO>> </a>';?></p></td>
			</tr> 

		<?php
		}
		?>
		<td> Exercises </td>
		<?php

		foreach($meta_exer as $meta_key) {
		?>
			<tr>
			<td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$meta_key->meta_value.'"> >>GO>> </a>';?></p></td>
			</tr> 

		<?php
		}
		?>
		<td> Bibliography </td>
		<?php

		foreach($meta_biblio as $meta_key) {
			?>
			<tr>
			<td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$meta_key->meta_value.'"> >>GO>> </a>';?></p></td>
			</tr> 

		<?php
		}
		?>
		</table>
		<?php 
		

	}
}

