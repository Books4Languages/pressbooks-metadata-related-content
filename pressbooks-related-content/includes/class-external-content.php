<?php

/**
 * The file that defines the core plugin class
 *
 * A class that creates new Chapter metabox and new links fields.
 *
 * @link       Nicole
 * @since      0.1
 *
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
	 * The  name of this plugin.
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
	* The function which produces the metafields to 
	* Chapter metabox with custom metadata of Pressbooks
	*
	* @since 0.1
	*/
	/*
	public function add_metadata(){


		//---- Chapter Metadata metabox ----//

		// create a new group to the Chapter post type
		x_add_metadata_group( 'resources_metadata', 'chapter', array(
			'label' => 'Resources'
			
		) );

		//----------- Metafields ----------- //
		
		// add Activities metafield to  Chapter Metadata metabox
		x_add_metadata_field( 	'pb_activities', 'chapter', array(
			'group' 		=>	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=>	'Activities',
			'description'	=>	'The URL of activities.',
			'placeholder' 	=>	'http://site.com/',
			'multiple'      =>  'true'
		) );

		// add Video metafield to  Chapter Metadata metabox
		x_add_metadata_field( 	'pb_video', 'chapter', array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Video',
			'description' 	=> 	'The URL of video',
			'multiple'      =>  'true',
			'placeholder' 	=>	'http://site.com/'
		) );

		// add Audio metafield to  Chapter Metadata metabox
		x_add_metadata_field( 	'pb_audio', 'chapter', array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Audio',
			'multiple'      =>  'true',
			'description' 	=> 	'The URL of audio',
			'placeholder' 	=>	'http://site.com/'
		) );

		//add Bibliography metafield to  Chapter Metadata metabox
		x_add_metadata_field( 	'pb_bibliography', 'chapter', array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Bibliography',
			'multiple'      =>  'true',
			'description' 	=> 	'The URL of bibliography',
			'placeholder' 	=>	'http://site.com/'
		) );

		//add Exercises metafield to  Chapter Metadata metabox
		x_add_metadata_field( 	'pb_exercises', 'chapter', array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Exercises',
			'multiple'      =>  'true',
			'description' 	=> 	'The URL of exercises',
			'placeholder' 	=>	'http://site.com/'
		) );

		

	}*/

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
	 * This function is called  in one shortcode in class-pressbooks-related-functions.php 
	 * This function receives as a parameter the name of one of the fields or an all 
	 * if you want to display the information of all
	 *
	 * @since 0.1
	 */
	 function print_chapter_r_fields($cont){
	
		
	  /*Gets the chapter resources metadata from the database*/
        global $wpdb;
        global $post;
        //We take data from the database. From the _postmeta table
        $table_name=$wpdb->prefix.'postmeta';
 		//We create an array with the field value for each field
        $meta_act = $wpdb->get_results("SELECT meta_value FROM $table_name WHERE meta_key='pb_activities' AND post_id='$post->ID'  ORDER BY meta_id DESC");
        $meta_video = $wpdb->get_results("SELECT meta_value FROM $table_name WHERE meta_key='pb_video' AND post_id='$post->ID' ORDER BY meta_id DESC");
        $meta_audio = $wpdb->get_results("SELECT meta_value FROM $table_name WHERE meta_key='pb_audio'AND post_id='$post->ID' ORDER BY meta_id DESC");
        $meta_exer = $wpdb->get_results("SELECT meta_value  FROM $table_name WHERE meta_key='pb_exercises' AND post_id='$post->ID' ORDER BY meta_id DESC");
        $meta_biblio = $wpdb->get_results("SELECT meta_value FROM $table_name WHERE meta_key='pb_bibliography' AND post_id='$post->ID' ORDER BY meta_id DESC");
 		// This variable is used to know if all fields are empty
 		$emptys=true;
 		//For each field we see whether they are empty or not. If they are not, then emptys= false.
 		foreach($meta_act as $meta_key) {
			
			$value=$meta_key->meta_value;
			if($value!='' || $value != null){
				$emptys=false;		
			}
		}
		foreach($meta_video as $meta_key) {
			
			$value=$meta_key->meta_value;
			if($value!='' || $value != null){
				$emptys=false;		
			}
		}
		foreach($meta_audio as $meta_key) {
			 
			$value=$meta_key->meta_value;
			if($value!='' || $value != null){
				$emptys=false;		
			}
		}
		foreach($meta_exer as $meta_key) {
			
			$value=$meta_key->meta_value;
			if($value!='' || $value != null){
				$emptys=false;		
			}
		}
		foreach($meta_biblio as $meta_key) {
		
			$value=$meta_key->meta_value;
			if($value!='' || $value != null){
				$emptys=false;		
			}
		}

    	
       /* Create a table that contains the chapter metadata. Print this table in frontend */
		?>
		<table class="metadata_questtions_answers">
		<?php
		// If there is some field occupied then the title will appear on the frontend
		if($emptys==false){ ?>
			<tr><td> RESOURCES </td></tr>
		<?php 
		}
		//These variables serve to know if the title of each field should appear in the frontend
		$tituloAc=true; 
		$tituloVi= true;
		$tituloAu=true;
		$tituloExe= true;
		$titulo_biblio=true;
		//We see if the content is equal to all or if it is equal to the field name. If so we show the information of the field
		if($cont=="all" || $cont=="Activities"){
			foreach($meta_act as $meta_key) {
				// we see the value of the field
				$value=$meta_key->meta_value;
				// if the value is null , the title =false
				if($value=='' || $value == null){
					$tituloAc=false;
				}
				//Only if the title is true will be shown. And the title will become false to only show once
				if($tituloAc){
					$tituloAc=false;
					?>
					<tr><td> Activities </td></tr>
				<?php 
				}
				//If the field is not empty the link will be displayed
				if($value!='' || $value != null){
					?>
					<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$value.'"> >>GO>> </a>';?></p></td></tr>
					<?php 
				}
				?>
			<?php
			}
		}
		//We see if the content is equal to all or if it is equal to the field name. If so we show the information of the field
		if($cont=="all" || $cont=="Video"){
			foreach($meta_video as $meta_key) {
				// we see the value of the field
				$value=$meta_key->meta_value;
				// if the value is null , the title =false
				if($value=='' || $value == null){
					$tituloVi=false;
				}
				//Only if the title is true will be shown. And the title will become false to only show once
				if($tituloVi){
					$tituloVi=false;
					?>
					<tr><td> Videos </td></tr>
				<?php 
				}
				//If the field is not empty the link will be displayed
				if($value!='' || $value != null){
				?>
				<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$meta_key->meta_value.'"> >>GO>> </a>';?></p></td></tr>
				<?php 
				}
				?>

			<?php
			}
		}
		
		//We see if the content is equal to all or if it is equal to the field name. If so we show the information of the field
		if($cont=="all" || $cont=="Audio"){
			foreach($meta_audio as $meta_key) {
		 		// we see the value of the field
				$value=$meta_key->meta_value;
				// if the value is null , the title =false
				if($value=='' || $value == null){
					$tituloAu=false;
				}
				//Only if the title is true will be shown. And the title will become false to only show once
				if($tituloAu){
					$tituloAu=false;
					?>
					<tr><td> Audio </td></tr>
				<?php 
				}
				//If the field is not empty the link will be displayed
				if($value!='' || $value != null){
				?>
				<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$meta_key->meta_value.'"> >>GO>> </a>';?></p></td></tr>
				<?php 
				}
				?>

			<?php
			}
		}
		?>
		<?php
		//We see if the content is equal to all or if it is equal to the field name. If so we show the information of the field
		if($cont=="all" || $cont=="Exercises"){
			foreach($meta_exer as $meta_key) {
				// we see the value of the field
				$value=$meta_key->meta_value;
				// if the value is null , the title =false
				if($value=='' || $value == null){
					$tituloExe=false;
				}
				//Only if the title is true will be shown. And the title will become false to only show once
				if($tituloExe){
					$tituloExe=false;
					?>
					<tr><td> Exercises </td></tr>
				<?php 
				}
				//If the field is not empty the link will be displayed
				if($value!='' || $value != null){
				?>
				<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$meta_key->meta_value.'"> >>GO>> </a>';?></p></td></tr>
				<?php 
				}
				?>

			<?php
			}
		}
		
		//We see if the content is equal to all or if it is equal to the field name. If so we show the information of the field
		if($cont=="all" || $cont=="Biblio"){
			foreach($meta_biblio as $meta_key) {
				// we see the value of the field
				$value=$meta_key->meta_value;
				// if the value is null , the title =false
				if($value=='' || $value == null){
					$titulo_biblio=false;
				}
				//Only if the title is true will be shown. And the title will become false to only show once
				if($titulo_biblio){
					$titulo_biblio=false;
					?>
					<tr><td> Bibliography </td></tr>
				<?php 
				}
				//If the field is not empty the link will be displayed
				if($value!='' || $value != null){
				?>
				<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$meta_key->meta_value.'"> >>GO>> </a>';?></p></td></tr>
				
				<?php 
				}
				?>

			<?php
			}
		}
		?>
		</table>
		<?php 
		
	}

}

