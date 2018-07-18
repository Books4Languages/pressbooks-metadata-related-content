<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       Nicole
 * @since      0.1
 *
 * @package    Pressbooks_Related_Content
 * @subpackage Pressbooks_Related_Content/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pressbooks_Related_Content
 * @subpackage Pressbooks_Related_Content/admin
 * @author     Nicole <nicoleacuna95@gmail.com>
 */

 
class Pressbooks_Related_Content_Admin {


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
	 * @since    0.1
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function rc_add_option_pages(){


		add_menu_page(__('Related Content', 'aiom-educational-related-content'),
			"RC", 'manage_options', 'pressbooks-related-content_resources_options_page',
			array($this, 'render_options_page_rc'), 'dashicons-search');
		add_meta_box('edu_rel_content', 'Settings', array($this, 'render_opt_metabox'), 'pressbooks-related-content_resources_options_page',
            'normal', 'core');

		if(!is_plugin_active('all-in-one-metadata/all-in-one-metadata.php')){
		    if (!\adminFunctions\Pressbooks_Metadata_Site_Cpt::pressbooks_identify()) {
			    //Used to remove the default menu for the cpt we created
			    remove_menu_page( 'edit.php?post_type=site-meta' );
			    remove_meta_box( 'submitdiv', 'site-meta', 'side' );
			    add_meta_box( 'metadata-save', __( 'Save Site Metadata Information', 'all-in-one-metadata' ), array(
				    $this,
				    'metadata_save_box'
			    ), 'site-meta', 'side', 'high' );
			    $meta = \adminFunctions\Pressbooks_Metadata_Site_Cpt::get_site_meta_post();
			    if ( ! empty( $meta ) ) {
				    $site_meta_url = 'post.php?post=' . absint( $meta->ID ) . '&action=edit';
			    } else {
				    $site_meta_url = 'post-new.php?post_type=site-meta';
			    }
			    //adding Site-Meta page under main plugin page
			    add_submenu_page( 'tools.php', 'Site-Meta', 'Site-Meta', 'edit_posts', $site_meta_url );
		    }
		}
	}

	/**
	 * A function that manipulates the inputs for saving the new cpt data
	 * @since    0.1
	 */
	function metadata_save_box( $post ) {
		if ( 'publish' === $post->post_status ) { ?>
            <input name="original_publish" type="hidden" id="original_publish" value="Update"/>
            <input name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p" value="<?=__('Save', 'all-in-one-metadata')?>"/>
		<?php } else { ?>
            <input name="original_publish" type="hidden" id="original_publish" value="Publish"/>
            <input name="publish" id="publish" type="submit" class="button button-primary button-large" value="<?=__('Save', 'all-in-one-metadata')?>" tabindex="5" accesskey="p"/>
			<?php
		}
	}


	/**
	 * Function for rendering options page of a plugin
	 */
	public function render_options_page_rc(){
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<?php do_meta_boxes('pressbooks-related-content_resources_options_page', 'normal', ''); ?>
			</div>
		</div>
		<script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready( function($) {
                // close postboxes that should be closed
                $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                // postboxes setup
                postboxes.add_postbox_toggles('<?php echo 'pressbooks-related-content_resources_options_page'; ?>');
            });
            //]]>
		</script>
		<?php
	}

	/**
	 * Function for rendering metabox in settings page
	 */
	public function render_opt_metabox(){
	    ?>
        <form action="options.php" method="post">
	        <?php
	        settings_fields('pressbooks-related-content_resources_options_page');
	        do_settings_sections('pressbooks-related-content_resources_options_page');
	        submit_button();
	        ?>
            <br></form> <?php
    }


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pressbooks_Related_Content_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pressbooks_Related_Content_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/checkbox.css', array(), $this->version, 'all' );
		
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pressbooks_Related_Content_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pressbooks_Related_Content_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pressbooks-related-content-admin.js', array(), $this->version, 'all' );

	}

	/**
	*
	* This function is responsible for creating sections and recording all settings
	* This function is called from the Pressbooks_Related_Content class in the
	* define_admin_hooks function. 
	*
	* @since    0.2
	*/
	
	public function options_checkbox(){

	    //create a new section called options_resources
	    add_settings_section(  
		    'OPTIONS_RESOURCES', // Section ID 
		    'OPTIONS FOR FIELDS RESOURCES', // Section Title
		    array( $this, 'RESOURCES_callback'), // Callback
		    'pressbooks-related-content_resources_options_page' // What Page?  
	    );

	     //create a new section called show_info
	    add_settings_section(  
		    'show_info', // Section ID 
		    'WHERE SHOW THE INFORMATION', // Section Title
		    array( $this, 'show_info_callback'), // Callback
		    'pressbooks-related-content_resources_options_page' // What Page?  
	    );

	    //create a new section called related_op
	    add_settings_section(  
		    'related_op', // Section ID 
		    'OPTIONS FOR RELATED BOOKS', // Section Title
		    array( $this, 'related_callback'), // Callback
		    'pressbooks-related-content_resources_options_page' // What Page?
	    );

	    //create a new section called button_op
	    add_settings_section(  
		    'button_op', // Section ID 
		    'WHERE SHOW THE ENABLE BUTTON', // Section Title
		    array( $this, 'button_callback'), // Callback
		    'pressbooks-related-content_resources_options_page' // What Page?
	    );

		//create a new section for location of educational metadata
		add_settings_section(
			'edu_locations', // Section ID
			'EDUCATIONAL METADATA', // Section Title
			array( $this, 'show_edu_info_callback'), // Callback
			'pressbooks-related-content_resources_options_page' // What Page?
		);
		
	    //register the settings  for options_resoources section
	    register_setting( 'pressbooks-related-content_resources_options_page', 'video_op' );
	    register_setting('pressbooks-related-content_resources_options_page', 'audios_op');
	    register_setting('pressbooks-related-content_resources_options_page', 'act_op');
	    register_setting('pressbooks-related-content_resources_options_page', 'exer_op');
	    register_setting('pressbooks-related-content_resources_options_page', 'biblio_op');
	    //register the settings  for related_op section
		register_setting( 'pressbooks-related-content_resources_options_page', 'options_related' );
		register_setting( 'pressbooks-related-content_resources_options_page', 'voculary_op' );
		register_setting( 'pressbooks-related-content_resources_options_page', 'grammar_op' );
		register_setting( 'pressbooks-related-content_resources_options_page', 'phonetics_op' );
		register_setting( 'pressbooks-related-content_resources_options_page', 'texts_op' );
		register_setting( 'pressbooks-related-content_resources_options_page', 'cultural_op' );
		register_setting( 'pressbooks-related-content_resources_options_page', 'extra_op' );
		register_setting( 'pressbooks-related-content_resources_options_page', 'link_based_op' );
		//register the settings for button_op section
		register_setting( 'pressbooks-related-content_resources_options_page', 'part_button' );
		register_setting( 'pressbooks-related-content_resources_options_page', 'chapter_button' );
		register_setting( 'pressbooks-related-content_resources_options_page', 'front_button' );
		register_setting( 'pressbooks-related-content_resources_options_page', 'back_button' );
		//register the settings for show info section
		//take all the post types of the site
		$post_types = get_post_types( ['public' => true], 'names' );
		// for each post types we create one setting
		foreach ( $post_types as $post_type ) {
			register_setting( 'pressbooks-related-content_resources_options_page',  $post_type . '_op' );
			register_setting( 'pressbooks-related-content_resources_options_page',  $post_type . '_edu_op' );
			register_setting( 'pressbooks-related-content_resources_options_page',  $post_type . '_edu_dublin_op' );
			register_setting( 'pressbooks-related-content_resources_options_page',  $post_type . '_edu_coins_op' );
		}
		register_setting( 'pressbooks-related-content_resources_options_page',  'metadata_edu_op' );

    }
 
 	/**
 	* This function is a options_resources section callback
 	* This function is started to create the section
 	*
 	* @since    0.2
 	*/

    function RESOURCES_callback($args) { // Section Callback
    	//We make a small introduction of the section
		echo '<p> Choose which fields you want to display in the post type that you choose later. Then these fields will be displayed in the frontend </p>';
		//We create a variable for each setting. Each variable contains html code that creates a checkbox.
		$video = '<input type="checkbox" id="1" name="video_op" value="videos" ' . checked('videos', get_option('video_op'), false) . '/>' . 'Videos';   
		$audio = '<input type="checkbox" id="2" name="audios_op" value="audios" ' . checked('audios', get_option('audios_op'), false) . '/>' . 'Audios';
		$act = '<input type="checkbox" id="3" name="act_op" value="act" ' . checked('act', get_option('act_op'), false) . '/>' . 'Activities';
		$exer = '<input type="checkbox" id="4" name="exer_op" value="exer" ' . checked('exer', get_option('exer_op'), false) . '/>' . 'Exercises';
		$biblio = '<input type="checkbox" id="5" name="biblio_op" value="biblio" ' . checked('biblio', get_option('biblio_op'), false) . '/>' . 'Bibliography';
		// Print code HTML
		echo '<ul>';
		echo '<li>'. $video . '</li>';
		echo '<li>'. $audio. '</li>';
		echo  '<li>'. $act . '</li>' ;
		echo '<li>'. $exer . '</li>';
		echo'<li>'. $biblio . '</li>';
		echo '</ul>';
	}

	/**
	* This function is a related_op section 
	* This function is started when create the section
	*
	* @since    0.2
	*/
	function related_callback() { // Section Callback
		//We make a small introduction of the section
		echo '<p> Choose the fields to show in metabox Related Books in Book info</p>';  
		//We create a variable for each setting. Each variable contains html code that creates a checkbox. 
		$voculary = '<input type="checkbox" id="1" name="voculary_op" value="voculary" ' . checked('voculary', get_option('voculary_op'), false) . '/>' . 'Voculary';   
		$grammar = '<input type="checkbox" id="2" name="grammar_op" value="grammar" ' . checked('grammar', get_option('grammar_op'), false) . '/>' . 'Grammar';
		$phonetics = '<input type="checkbox" id="3" name="phonetics_op" value="phonetics" ' . checked('phonetics', get_option('phonetics_op'), false) . '/>' . 'Phonetics and Spelling';
		$texts = '<input type="checkbox" id="4" name="texts_op" value="texts" ' . checked('texts', get_option('texts_op'), false) . '/>' . 'Texts and Functions';
		$cultural = '<input type="checkbox" id="5" name="cultural_op" value="cultural" ' . checked('cultural', get_option('cultural_op'), false) . '/>' . 'Cultural and Sociocultural';
		$extra = '<input type="checkbox" id="5" name="extra_op" value="extra" ' . checked('extra', get_option('extra_op'), false) . '/>' . 'Extra Content';
		$link_based = '<input type="checkbox" id="5" name="link_based_op" value="link_based" ' . checked('link_based', get_option('link_based_op'), false) . '/>' . 'Link Based';
		
		// Print HTML code
		echo '<ul>';
	    echo '<li>'. $voculary . '</li>';
	    echo '<li>'. $grammar. '</li>';
	    echo  '<li>'. $phonetics . '</li>' ;
	    echo '<li>'. $texts . '</li>';
	    echo'<li>'. $cultural . '</li>';
	    echo'<li>'. $extra . '</li>';
	    echo'<li>'. $link_based . '</li>';

	}

	/**
	* This function is a button_op section callback
	* This function is started to create a section
	*
	* @since    0.2
	*/
	function button_callback($args){// Section Callback
		//We make a small introduction of the section
		echo '<p> Choose the post types in which you want the button to appear</p> ';
		//We create a variable for each setting. Each variable contains html code that creates a checkbox. 
		$part_b = '<input type="checkbox" id="1" name="part_button" value="part" ' . checked('part', get_option('part_button'), false) . '/>' . 'Part';   
		$chapter_b = '<input type="checkbox" id="2" name="chapter_button" value="chapter" ' . checked('chapter', get_option('chapter_button'), false) . '/>' . 'Chapter';
		$front_b= '<input type="checkbox" id="3" name="front_button" value="front-matter" ' . checked('front-matter', get_option('front_button'), false) . '/>' . 'Front Matter';
		$back_b = '<input type="checkbox" id="4" name="back_button" value="back-matter" ' . checked('back-matter', get_option('back_button'), false) . '/>' . 'Back Matter';
		// Print HTML code
		echo '<ul>';
		echo '<li>' . $part_b . '</li>';
		echo '<li>' . $chapter_b . '</li>';
		echo '<li>' . $front_b . '</li>';
		echo '<li>' . $back_b . '</li>';
	}

	/**
	* This function is a show info section callback
	* This function is started to create the section
	*
	* @since    0.2
	*/
    function show_info_callback($args) { // Section Callback
    	//We make a small introduction of the section
	    echo '<p> Choose the post types of the following post types. In the post type that you choose will be shown the previously chosen fields.</p>';
	    //We create a variable for each post type. Each variable contains html code that creates a checkbox. 
	    $post_types = get_post_types( ['public' => true], 'names' );

		echo '<ul>';
		//If pressbooks is installed then we only show 4 post types: part, chapter, front-matter and back-matter
		if ( @include_once( WP_PLUGIN_DIR . '/pressbooks/compatibility.php' ) ) {
			foreach ( $post_types as $post_type ) {
				if($post_type=='part' || $post_type=='chapter' || $post_type=='front-matter' || $post_type=='back-matter' )
					echo '<li>' .'<input type="checkbox"  name='. $post_type . '_op' .' value="1" ' . checked(1, get_option($post_type . '_op'), false) . '/>' . $post_type  . '</li>';
			}
		}else{
			//Otherwise we show all
			foreach ( $post_types as $post_type ) {

				echo '<li>' .'<input type="checkbox"  name='. $post_type . '_op' .' value="1" ' . checked(1, get_option($post_type . '_op'), false) . '/>' . $post_type  . '</li>';
			}
		}
		echo '</ul>'; 
	}

	/**
	 * Rendering section for educational metadata locations
	 *
	 * @since    0.2
	 */
	function show_edu_info_callback($args) { // Section Callback
		//We make a small introduction of the section
		echo '<p> Choose type(s) of educational metadata you would like to use and desired locations for it.</p>';
		//We create a variable for each post type. Each variable contains html code that creates a checkbox.
		$post_types = get_post_types( ['public' => true], 'names' );

		echo '<h3>LRMI Metadata</h3>';

		echo '<ul>';
		//If pressbooks is installed then we only show 4 post types: part, chapter, front-matter and back-matter
		if ( @include_once( WP_PLUGIN_DIR . '/pressbooks/compatibility.php' ) ) {
			foreach ( $post_types as $post_type ) {
				if($post_type=='part' || $post_type=='chapter' || $post_type=='front-matter' || $post_type=='back-matter' )
					echo '<li>' .'<input type="checkbox"  name='. $post_type . '_edu_op' .' value="1" ' . checked(1, get_option($post_type . '_edu_op'), false) . '/>' . $post_type  . '</li>';
			}
			echo '<li>' .'<input type="checkbox"  name="metadata_edu_op"  value="1" ' . checked(1, get_option('metadata_edu_op'), false) . '/>Book Info</li>';
		}else{
			//Otherwise we show all
			foreach ( $post_types as $post_type ) {

				echo '<li>' .'<input type="checkbox"  name='. $post_type . '_edu_op' .' value="1" ' . checked(1, get_option($post_type . '_edu_op'), false) . '/>' . $post_type  . '</li>';
			}
		}
		echo '</ul>';

		echo '<h3>COinS Metadata</h3>';

		echo '<ul>';
		//If pressbooks is installed then we only show 4 post types: part, chapter, front-matter and back-matter
		if ( @include_once( WP_PLUGIN_DIR . '/pressbooks/compatibility.php' ) ) {
			foreach ( $post_types as $post_type ) {
				if($post_type=='part' || $post_type=='chapter' || $post_type=='front-matter' || $post_type=='back-matter' )
					echo '<li>' .'<input type="checkbox"  name='. $post_type . '_edu_coins_op' .' value="1" ' . checked(1, get_option($post_type . '_edu_coins_op'), false) . '/>' . $post_type  . '</li>';
			}
			echo '<li>' .'<input type="checkbox"  name="metadata_edu_coins_op"  value="1" ' . checked(1, get_option('metadata_edu_coins_op'), false) . '/>Book Info</li>';
		}else{
			//Otherwise we show all
			foreach ( $post_types as $post_type ) {

				echo '<li>' .'<input type="checkbox"  name='. $post_type . '_edu_coins_op' .' value="1" ' . checked(1, get_option($post_type . '_edu_coins_op'), false) . '/>' . $post_type  . '</li>';
			}
		}
		echo '</ul>';

		echo '<h3>Dublin Core Metadata</h3>';

		echo '<ul>';
		//If pressbooks is installed then we only show 4 post types: part, chapter, front-matter and back-matter
		if ( @include_once( WP_PLUGIN_DIR . '/pressbooks/compatibility.php' ) ) {
			foreach ( $post_types as $post_type ) {
				if($post_type=='part' || $post_type=='chapter' || $post_type=='front-matter' || $post_type=='back-matter' )
					echo '<li>' .'<input type="checkbox"  name='. $post_type . '_edu_dublin_op' .' value="1" ' . checked(1, get_option($post_type . '_edu_dublin_op'), false) . '/>' . $post_type  . '</li>';
			}
			echo '<li>' .'<input type="checkbox"  name="metadata_edu_dublin_op"  value="1" ' . checked(1, get_option('metadata_edu_dublin_op'), false) . '/>Book Info</li>';
		}else{
			//Otherwise we show all
			foreach ( $post_types as $post_type ) {

				echo '<li>' .'<input type="checkbox"  name='. $post_type . '_edu_dublin_op' .' value="1" ' . checked(1, get_option($post_type . '_edu_dublin_op'), false) . '/>' . $post_type  . '</li>';
			}
		}
		echo '</ul>';
	}

	/**
	* This function is responsible for collecting the data of the post types of the database.
	* With this information we know that checkbox has been selected so that we can call the
	* function add_resouces_metabox ($ post_type) which is passed as an argument the post type 
	* selected in the checkbox.
	*
	* @since    0.2
	*/
    public function resources_in_post_type(){
    	//We create the DB variable
    	global $wpdb;
    	//We take the table in which the prefix is 'options'
    	$table_po= $wpdb->prefix .'options';
    	//We get all the names of the post types
		$post_types = get_post_types( ['public' => true], 'names' );
	 	//For each post type we create a variable that contains the information of each post type in the database
		foreach ( $post_types as $post_type ){
			$value=$post_type . '_op';
			$query=  $wpdb->prepare("SELECT option_value FROM $table_po WHERE  option_name=%s", $value );
	    	${"op_".$post_type}= $wpdb->get_results($query);  	
		}
		//For each post type we create a foreach which returns the value of the post type previously collected from the database.
		foreach ( $post_types as $post_type){	
			foreach (${"op_".$post_type} as $option_name) {
				${"value_".$post_type}= $option_name->option_value;
				//We see if the value of the post type in the database is null or empty. 
				//If it is not empty it means that it has been selected
				if(${"value_".$post_type}!= '' || ${"value_".$post_type}!=null){	//If it has been selected we call the function				
					$this->add_resources_metabox($post_type);
				}
			}
		}
			
	}

	/**
	* This function is responsible for obtaining information from the database on the fields of 
	* video, audio, activities, exercises and bibliography.
	* With this information you know if the field has been selected or not. 
	*Receive as parameter the post type where you want to display the selected fields
	*
	* 
	* @since    0.2
	*/
	 public function add_resources_metabox($posttype){

    	global $wpdb;
    	//We take the table with prefix 'options'
    	$table_resources_op= $wpdb->prefix .'options';
    	//For each setting of the resources section we create a variable that contains the information of the database
    	$vid_op=  $wpdb->get_results("SELECT option_value FROM $table_resources_op WHERE  option_name='video_op' ");
    	$au_op=  $wpdb->get_results("SELECT option_value FROM $table_resources_op WHERE  option_name='audios_op' ");
    	$ac_op=  $wpdb->get_results("SELECT option_value FROM $table_resources_op WHERE  option_name='act_op' ");
    	$exr_op=  $wpdb->get_results("SELECT option_value FROM $table_resources_op WHERE  option_name='exer_op' ");
    	$bli_op=  $wpdb->get_results("SELECT option_value FROM $table_resources_op WHERE  option_name='biblio_op' ");
    	//Create these variables and then know whether to create the field or not
    	$video=false;
    	$audio=false;
    	$activities=false;
    	$exercises= false;
    	$biblio=false;
    	//We see the value of the video option, 
    	//if it is not empty then we put the value of the previous variable to true
    	foreach ($vid_op as $option_name) {
    		$vid_value= $option_name->option_value;
    		if($vid_value!= '' || $vid_value!=null)
    			$video=true;
    	}
    	//We see the value of the audio option,
    	// if it is not empty then we put the value of the previous variable to true
    	foreach ($au_op as $option_name) {
    		$au_value= $option_name->option_value;
    		if($au_value!= '' || $au_value!=null)
    			$audio=true;
    	}
    	//We see the value of the activities option, 
    	//if it is not empty then we put the value of the previous variable to true
    	foreach ($ac_op as $option_name) {
    		$ac_value= $option_name->option_value;
    		if($ac_value!= '' || $ac_value!=null)
    			$activities=true;
    	}
    	//We see the value of the exercise option, 
    	//if it is not empty then we put the value of the previous variable to true
    	foreach ($exr_op as $option_name) {
    		$exr_value= $option_name->option_value;
    		if($exr_value!= '' || $exr_value!=null)
    			$exercises=true;
    	}
    	//We see the value of the bibliography option, 
    	//if it is not empty then we put the value of the previous variable to true
    	foreach ($bli_op as $option_name) {
    		$bli_value= $option_name->option_value;
    		if($bli_value!= '' || $bli_value!=null)
    			$biblio=true;
    	}
    
	    //Once we know that settings have been selected,
	    // we create the fields in which the variable is true. 
	    //The post type variable tells us in which post type we visualize the created fields

	    //---- Create metabox ----//

		// create a new group to the Chapter post type
		x_add_metadata_group( 'resources_metadata',$posttype, array(
			'label' => 'Resources',
            'description' => 'IMPORTANT! Input URLs without protocol prefix, like instead of <i>http://mysite.com</i> always write just <i>mysite.com</i>, otherwise it can lead to linking errors.'
			
		) );

		if($activities==true){
		// add Activities metafield to metabox
		x_add_metadata_field( 	'pb_activities', $posttype, array(
			'group' 		=>	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=>	'Activities',
			'description'	=>	'The URL of activities.',
			'placeholder' 	=>	'site.com',
			'multiple'      =>  'true'
		) );
		}
		if($exercises==true){
		//add Exercises metafield to metabox
		x_add_metadata_field( 	'pb_exercises', $posttype, array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Exercises',
			'multiple'      =>  'true',
			'description' 	=> 	'The URL of exercises',
			'placeholder' 	=>	'site.com'
		) );
		}
		if($video==true){
		// add Video metafield to  metabox
		x_add_metadata_field( 	'pb_video', $posttype, array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Video',
			'description' 	=> 	'The URL of video',
			'multiple'      =>  'true',
			'placeholder' 	=>	'site.com'
		) );
		}
		if($audio==true){
		// add Audio metafield to metabox
		x_add_metadata_field( 	'pb_audio',$posttype, array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Audio',
			'multiple'      =>  'true',
			'description' 	=> 	'The URL of audio',
			'placeholder' 	=>	'site.com'
		) );
		}
		if($biblio==true){
		//add Bibliography metafield to metabox
		x_add_metadata_field( 	'pb_bibliography', $posttype, array(
			'group' 		=> 	'resources_metadata',
			'field_type'	=> 	'text',
			'label' 		=> 	'Bibliography',
			'multiple'      =>  'true',
			'description' 	=> 	'The URL of bibliography',
			'placeholder' 	=>	'site.com'
		) );
		}
		
 	}
 	
 	/**
 	* This function is responsible for obtaining information about the related 
 	* settings to the database.
 	* With this information we can know which settings have been selected and 
 	* this to be able to create or not the fields in the metabox Related books in Book info. 
 	* Also look at where to show the enable button
 	*
 	* @since    0.2
 	*
 	*/

	public function add_related_metabox(){

		global $wpdb;
		//We take the table with prefix 'options'
    	$table_related_op= $wpdb->prefix .'options';
    	//For each setting we take your information from the database
    	$voc_op=  $wpdb->get_results("SELECT option_value FROM $table_related_op WHERE  option_name='voculary_op' ");
    	$gra_op=  $wpdb->get_results("SELECT option_value FROM $table_related_op WHERE  option_name='grammar_op' ");
    	$pho_op=  $wpdb->get_results("SELECT option_value FROM $table_related_op WHERE  option_name='phonetics_op' ");
    	$text_op=  $wpdb->get_results("SELECT option_value FROM $table_related_op WHERE  option_name='texts_op' ");
    	$cul_op=  $wpdb->get_results("SELECT option_value FROM $table_related_op WHERE  option_name='cultural_op' ");
    	$extra_op=  $wpdb->get_results("SELECT option_value FROM $table_related_op WHERE  option_name='extra_op'  ");
    	$link_op=  $wpdb->get_results("SELECT option_value FROM $table_related_op WHERE  option_name='link_based_op' ");
    	$part_op=  $wpdb->get_results("SELECT option_value FROM $table_related_op WHERE  option_name='part_button' ");
    	$chap_op=  $wpdb->get_results("SELECT option_value FROM $table_related_op WHERE  option_name='chapter_button' ");
    	$back_op=  $wpdb->get_results("SELECT option_value FROM $table_related_op WHERE  option_name='front_button' ");
    	$front_op=  $wpdb->get_results("SELECT option_value FROM $table_related_op WHERE  option_name='back_button' ");
    	//We create variables to know whether to create the field or not
    	$voc=  false;
    	$gra= false;
    	$pho= false;
    	$text=false;
    	$cul= false;
    	$extra=false;
    	$link=false;
    	
    	//We see if the value of the vocabulary setting is not null. 
    	//If so, then we set the value of the previous variable to true
    	foreach ($voc_op as $option_name){
    		$voc_value=$option_name->option_value;
    		if($voc_value!='' || $voc_value!= null)
    			$voc=true;
    	}
    	//We see if the value of the grammar setting is not null. 
    	//If so, then we set the value of the previous variable to true
		foreach ($gra_op as $option_name){
    		$gra_value=$option_name->option_value;
    		if($gra_value!='' || $gra_value!= null)
    			$gra=true;
    	}
    	//We see if the value of the phonetics setting is not null. 
    	//If so, then we set the value of the previous variable to true
    	foreach ($pho_op as $option_name){
    		$pho_value=$option_name->option_value;
    		if($pho_value!='' || $pho_value!= null)
    			$pho=true;
    	//We see if the value of the text setting is not null. 
    	//If so, then we set the value of the previous variable to true
    	}foreach ($text_op as $option_name){
    		$text_value=$option_name->option_value;
    		if($text_value!='' || $text_value!= null)
    			$text=true;
    	//We see if the value of the cultural setting is not null.
    	// If so, then we set the value of the previous variable to true
    	}foreach ($cul_op as $option_name){
    		$cul_value=$option_name->option_value;
    		if($cul_value!='' || $cul_value!= null)
    			$cul=true;
    	//We see if the value of the extra setting is not null. 
    	//If so, then we set the value of the previous variable to true
    	}foreach ($extra_op as $option_name){
    		$extra_value=$option_name->option_value;
    		if($extra_value!='' || $extra_value!= null)
    			$extra=true;
    	//We see if the value of the link setting is not null. 
    	//If so, then we set the value of the previous variable to true
    	}foreach ($link_op as $option_name){
    		$link_value=$option_name->option_value;
    		if($link_value!='' || $link_value!= null)
    			$link=true;
    	}
    	//We see if the value of the part setting is not null. 
    	//If so, then we call the function to create the button in the corresponding post type
    	foreach ($part_op as $option_name){
    		$part_value=$option_name->option_value;
    		if($part_value!='' || $part_value!= null)
    			$this->add_button_in($part_value);
    	}
    	//We see if the value of the chapter setting is not null. 
    	//If so, then we call the function to create the button in the corresponding post type
    	foreach ($chap_op as $option_name){
    		$chap_value=$option_name->option_value;
    		if($chap_value!='' || $chap_value!= null)
    			$this->add_button_in($chap_value);
    	}
    	//We see if the value of the back setting is not null. 
    	//If so, then we call the function to create the button in the corresponding post type
    	foreach ($back_op as $option_name){
    		$back_value=$option_name->option_value;
    		if($back_value!='' || $back_value!= null)
    			$this->add_button_in($back_value);
    	}
    	//We see if the value of the front setting is not null. 
    	//If so, then we call the function to create the button in the corresponding post type
    	foreach ($front_op as $option_name){
    		$front_value=$option_name->option_value;
    		if($front_value!='' || $front_value!= null)
    			$this->add_button_in($front_value);
    	}

    	//We add a brief explanation
		$explaination= 'The books (one per content type) that are meant to '
			. 'be linked with this one.<br/>';
               
      	$add='For <span style="color:red;">Books4Languages</span> books you can write just the book name you want to relate! <b>Mybook</b> <br/>';
       	$add.='You can also enter external links! <b>mybook.com</b>';

       	$post_type = \adminFunctions\Pressbooks_Metadata_Site_Cpt::pressbooks_identify() ? 'metadata' : 'site-meta';
        
        //We create a metabox Related books
		x_add_metadata_group( 'Related_Books', 'metadata', array(
			'label' => 'Related Books',
			'description'=>$explaination.$add

		) );
	   //Only if the variable is true we create the field
       if($voc==true){
		/* Create  text field Vocabulary */
		x_add_metadata_field( 	'vocabulary_book', $post_type, array(
			'group' 		=>	'Related_Books',
			'field_type'	=> 	'text',
			'label' 		=>	'Vocabulary',
			'description'	=>	'The URL of vocabulary. You can insert a word (name of the book) or a link to vocabulary Book.',
			'placeholder' 	=>	'http://site.com/'
		) );
		}
		if($gra==true){
		/* Create  text field Grammar */
		x_add_metadata_field( 	'grammar_book', $post_type, array(
			'group' 		=>	'Related_Books',
			'field_type'	=> 	'text',
			'label' 		=>	'Grammar',
			'description'	=>	'The URL of grammar. You can insert a word (name of the book) or a link to grammar Book',
			'placeholder' 	=>	'http://site.com/'
		) );
		}
		if($pho==true){
		/* Create  text field Phonetics and Spelling */
		x_add_metadata_field( 	'phonetics_spelling_book', $post_type, array(
			'group' 		=>	'Related_Books',
			'field_type'	=> 	'text',
			'label' 		=>	'Phonetics and Spelling',
			'description'	=>	'The URL of phonetics. You can insert a word (name of the book) or a link to phonetics and spelling Book',
			'placeholder' 	=>	'http://site.com/'
		) );
		}
		if($text==true){
		/* Create  text field Texts and functions */
		x_add_metadata_field( 	'texts_functions_book', $post_type, array(
			'group' 		=>	'Related_Books',
			'field_type'	=> 	'text',
			'label' 		=>	'Texts and Functions',
			'description'	=>	'The URL of texts and functions. You can insert a word (name of the book) or a link to Texts and Functions',
			'placeholder' 	=>	'http://site.com/'
		) );
		}
		if($cul==true){
		/* Create  text field Cultural and Sociocultural*/
		x_add_metadata_field( 'cultural_functions_book', $post_type, array(
			'group' 		=>	'Related_Books',
			'field_type'	=> 	'text',
			'label' 		=>	'Cultural and Sociocultural',
			'description'	=>	'The URL of Cultutal and Sociocultural. You can insert a word (name of the book) or a link to Cultutal and Sociocultural Book',
			'placeholder' 	=>	'http://site.com/'
		) );
		}
		if($extra==true){
		/* Create  text field Extra content */
		x_add_metadata_field( 'extra_content_book', $post_type, array(
			'group' 		=>	'Related_Books',
			'field_type'	=> 	'text',
			'label' 		=>	'Extra Content',
			'description'	=>	'The URL of Extra Content. You can insert a word (name of the book) or link to other Book',
			'placeholder' 	=>	'http://site.com/'
		) );
		}
		
		if($link==true){
		/* Create  text field link based. This link will be the link of the book on which it is based*/
		x_add_metadata_field( 'link_based', $post_type, array(
			'group' => 'Related_Books', // the group name
			'description' => 'The URL of book based. You can insert a word (name of the book)  or the link on which it is based',
			'label' => ' Link of book based ', // field label
			'field_type' => 'text',
		) );
		}
	}

	/**
	*
	*This function is responsible for displaying the enable button 
	*in the posttype that is passed as parameter
	*
	* @since    0.2
	*/
	public function add_button_in($posttype){
		//We create a metabox Related books button where will be the button that 
		//will make you see or not the information. 
		//This button will be only in the parts.
		x_add_metadata_group( 'Related_Books_button', $posttype, array(
			'label' => 'Related Books'
		) );
		/* Create  button */
		x_add_metadata_field( 'button_Rc', $posttype, array(
			'group' => 'Related_Books_button',
			'label' => 'Enable Related Books',
			'field_type' => 'checkbox',
		) );
	}

	/**
	 * Function for providing educational metaboxes
     *
     * @since 0.2
	 */
	public function edu_in_post_type () {

		$post_types = get_post_types( [ 'public' => true ], 'names' );
		//If pressbooks is installed then we only show 4 post types: part, chapter, front-matter and back-matter
		if ( @include_once( WP_PLUGIN_DIR . '/pressbooks/compatibility.php' ) ) {
			foreach ( $post_types as $post_type ) {
				if ( $post_type == 'part' || $post_type == 'chapter' || $post_type == 'front-matter' || $post_type == 'back-matter' || $post_type=='metadata') {

				    if (get_option( $post_type . '_edu_op' )) {
					    new \educa\Pressbooks_Metadata_Educational( $post_type );
				    }

				    if (get_option( $post_type . '_edu_dublin_op' )) {

				        new \educa\Pressbooks_Metadata_Dublin( $post_type );
				    }

					if (get_option( $post_type . '_edu_coins_op' )) {

						new \educa\Pressbooks_Metadata_Coins( $post_type );
					}

				}
			}
		}else{
			foreach ( $post_types as $post_type ) {

				if ( get_option( $post_type . '_edu_op' )){

				    new \educa\Pressbooks_Metadata_Educational( $post_type );
			    }

				if (get_option( $post_type . '_edu_dublin_op' )) {

					new \educa\Pressbooks_Metadata_Dublin( $post_type );
				}

				if (get_option( $post_type . '_edu_coins_op' )) {

					new \educa\Pressbooks_Metadata_Coins( $post_type );
				}
            }
		}

	}

	/**
	 * Function for creation of metabox for links to translations
     *
     * @since 0.2
	 */
	public function trans_links(){

		$post_type = \adminFunctions\Pressbooks_Metadata_Site_Cpt::pressbooks_identify() ? 'metadata' : 'site-meta';

		x_add_metadata_group( 'translations', $post_type, array(
			'label' => 'Translations'
		) );
		$languages = scandir(plugin_dir_path( dirname(__FILE__) ).'/includes/FLAGS' );
		unset($languages[0], $languages[1]);
		foreach ($languages as $language) {
		    $language = explode('.',$language)[0];
			x_add_metadata_field( 'pb_trans_'.$language, $post_type, array(
				'group'      => 'translations',
				'label'      => ucfirst($language),
				'field_type' => 'text',
			) );
		}
    }

}
