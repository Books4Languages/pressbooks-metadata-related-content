<?php

/**
 * The file that defines the core plugin class
 *
 * A class that creates new Chapter metabox and new links fields.
 *
 * @link       Nicole
 * @since      0.2
 *
 * @package    Pressbooks-related-content
 * @subpackage Pressbooks-related-content/includes
 * @author     Nicole <nicoleacuna95@gmail.com>
 */

/**
	* Initialize the class and set its properties.
	*
	* @since  0.2
	*/

	Class Pb_Rc_Books{

	/**
	 * The  name of this plugin.
	 *
	 * @since    0.2
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	/**
	 * The version of this plugin.
	 *
	 * @since    0.2
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	/**
	 * True if all fields are empty.
	 *
	 * @since    0.2
	 * @access   private
	 * @var      bool    $allempty   True if all fields are empty
	 */
	private $allempty;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      0.2
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 * @param      bool    $allempty   True if all fields are empty.
	 */

	public function __construct( $plugin_name, $version ) {
		
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->allempty=true;
	
	}

	
	/**
	* This function return the instance of the class
	* @since 0.2
	*/

	public static function get_instance(){

		if ( NULL == Pb_Rc_Books::$instance ) {
			Pb_Rc_Books::$instance
				= new Pb_Rc_Books();
		}
		return Pb_Rc_Books::$instance;
	}

	/**
	*
	* This function takes information from the fields field_based field and 
	* languages and it does it through the database. (These fields are created in admin class in admin file of this plugin) .
	* To create the new link, we divide in three parts the url (a, b, c) and change the part b by the value of the field_based.
	* This information is shown in the footer. Display a link and the image of the language flag.	
	* This function is called by a shortcode in class-pressbooks-related-functions.php.
	*
	* @since 0.2
	*
	*/
	public function print_link_based() {
		// globals variables of database and post
		global $wpdb;
		global $post;
		//Variable that serves to know if it's a link
		$findme  = '.com';
		//We take the domain of our site , part A
		$domain= get_blog_details()->domain;
		//We take the url from our site 
		$page_base_uri = $_SERVER['REQUEST_URI'];
		//We take the part that interests us, part C
		$page_uri=strstr(substr($page_base_uri, 1), '/'); 
		//This variable serves to show or not show the title
		$first=false;
		//We take the data from the fields of the database table
       	$table_l=$wpdb->prefix.'postmeta';
       	//For each field we create an array with the data
       	$meta_l_based= $wpdb->get_results("SELECT meta_value FROM $table_l WHERE  meta_key='link_based' ORDER BY meta_id ASC ");
        $meta_lang = $wpdb->get_results("SELECT meta_value FROM $table_l WHERE  meta_key='pb_isced_field_metadata' ORDER BY meta_id ASC   ");
        //We see the size of the array for each field
        $tam_l_based= count($meta_l_based);
        $tam_lang= count($meta_lang);
    
        ?>
        <!--We create the table that will be displayed in the frontend-->
        <table class="metadata_questions_answers">
       
        	<?php
        	//For that traverses the array of the link-based field
        	for($i=0; $i<$tam_l_based; $i++) {
        		//Only display information if there are values in the languages field
        		if($tam_lang-1>=$i){
        			//We collect the values of the fields in link and lang
        			$link=$meta_l_based[$i]->meta_value;
        			$lang=$meta_lang[$i]->meta_value;
        			//We move to lowercase and concatenate .png
        			$lang_im = strtolower($lang) . '.png';
        			//If it is the first time we show the title
        			if($first!=true){
        				$first=true;
        				?> 
        				<tr><td> LINKS BASED </td></tr>
        				<?php
        			}
        			//We see if .com exists inside the link variable
        			$ps = strpos($link, $findme);
        			//We take the image of the folder FLAGS
        			$imagen= plugin_dir_url( __FILE__ ) . 'FLAGS/' . $lang_im;
        			//If the fields are not empty and not found .com
        			if(($link!='' || $link!= null) and ($lang!='' || $lang!= null) and $ps==false){	  
        			//If any language has been selected and link not empty
        			if($lang!='--select--' || $link!=''){   
        			//We create a new link that redirects us to the new page and we show an image that is also a link 		
        			?>
					<tr><td><p><?php  echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$domain.'/'. $link. $page_uri.'"> >> '. 
					$lang .'>> </a>';?></p></td></tr>

					<tr><td> <?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$domain.'/'. $link. $page_uri.'">  <img src="'.$imagen.'"> </a>'; ?> </td></tr>
		
			<?php
					}
					}
					else
						//But if we found .com and selected a language or the link is not empty
						if( $ps==true && $lang!='--select--' || $link!=''){
							// Then we show the link and we also show it in image form
						?>
						<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$link.'"> >> '. $lang.' >> </a>';?></p></td></tr>
						
						<tr><td> <?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$link.'">  <img src="'.$imagen.'"></a>'; ?> </td></tr>
						<?php
							
						}
				}
			}
			?>
		</table>
		<?php
    }

 

	/**
	 * Checks if the related book option is enabled for the current page.
	 * Receive with parameter the post_id
	 *
	 * @since 0.2
	 * @return boolean true if the option is enabled, false otherwise.
	 */

	public function are_related_books_enabled($post_id) {
		global $wpdb;
		$tableA=$wpdb->prefix.'postmeta';
		//We take the data button_rc from the database 
		$button = $wpdb->get_results("SELECT meta_value FROM $tableA WHERE  meta_key='button_Rc' AND post_id=$post_id ");
		//Save the size of the array
		$button_count= count($button);
		//If it is not 0, it is that the button exists therefore it is activate
		if($button_count!=0){
			return true;
		}
		return false;

	}
	

	/**
	 *
	 * Prints the links (HTML code) to related books for the public part of
	 * the book. (theme)
	 * Get information about resource fields in database and print the table created with the information.
	 * To create the new link, we divide in three parts the url (a, b, c) and change the part b by the value of the field.
	 * This fucntion is called by shortcode in clas-pressbooks-related-functions.php
	 * 
	 * @since 0.2
	 */
	public function print_related_books_fields() {
		// global database variable
		global $wpdb;
		//Variable that serves to know if it's a link
		$findme  = '.com';
		//We take the domain of our site, part A
		$domain= get_blog_details()->domain;
		//We take the url from our site
		$page_base_uri = $_SERVER['REQUEST_URI'];
		//We take the part that interests us, part C
		$data = explode('/', $page_base_uri);
		$page_uri = '/'.$data[3].'/'.$data[4].'/';
		//We take from the database the data of the  vocabulary, grammar, phonetics, cultural, extra fields
       	$table2=$wpdb->prefix.'postmeta';
        $meta_voc = $wpdb->get_results("SELECT meta_value FROM $table2 WHERE  meta_key='vocabulary_book' ");
        $meta_gra = $wpdb->get_results("SELECT meta_value FROM $table2 WHERE  meta_key='grammar_book' ");
        $meta_pho = $wpdb->get_results("SELECT meta_value FROM $table2 WHERE  meta_key='phonetics_spelling_book'");
        $meta_text = $wpdb->get_results("SELECT meta_value FROM $table2 WHERE  meta_key='texts_functions_book' ");
        $meta_cul = $wpdb->get_results("SELECT meta_value FROM $table2 WHERE  meta_key='cultural_functions_book' ");
        $meta_extra = $wpdb->get_results("SELECT meta_value FROM $table2 WHERE  meta_key='extra_content_book' ");
		?>
		<!-- Wew create a table for frontend-->
		<table class="metadata_questions_answers">
		<tr><td> RELATED BOOKS </td></tr>
		<?php
		//These variables are used to know whether to show the title or not
		$tituloVoc=true;
		$tituloGra=true;
		$tituloPho=true;
		$tituloText=true;
		$tituloCul=true;
		$tituloExtra=true;
		//We create a for each field
		//for for meta_voc
		foreach($meta_voc as $meta_key) {
			//We take the value of the field
		    $value_voc=$meta_key->meta_value;
		    //We see if it's a link or a word. If it is a link contains .com
			$pos = strpos($value_voc, $findme);
		    //If the value is empty or null the title is not displayed
		    if($value_voc=='' || $value_voc == null){
				$tituloVoc=false;
			}
			//If we show the title, we pass the variable to false and set the allempty variable to false and show the title
			if($tituloVoc){
				$tituloVoc=false;
				$allempty=false;
				?>
				<tr><td> Vocabulary </td></tr>
			<?php 
			}
			//If the field is not empty and is not a link, then we create a link
			if(($value_voc!='' || $value_voc!=null) and $pos==false ) {
			?>
			<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$domain.'/'. $value_voc. $page_uri.'"> >>GO>> </a>';?></p></td></tr>
	
			<?php
			}
			//If the field is a link we redirect to the link
			else{?>
				<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$value_voc.'"> >>GO>> </a>';?></p></td></tr>
		<?php
		}
		}
		//for for meta_gra
		foreach($meta_gra as $meta_key) {
			//We take the value of the field
		    $value_gra=$meta_key->meta_value;
		    //We see if it's a link or a word. If it is a link contains .com
		    $pos2 = strpos($value_gra, $findme);
		     //If the value is empty or null the title is not displayed
		    if($value_gra=='' || $value_gra == null){
				$tituloGra=false;
			}
			//If we show the title, we pass the variable to false and set the allempty variable to false and show the title
			if($tituloGra){
				$tituloGra=false;
				$allempty=false;
				?>
				<tr><td> Grammar </td></tr>
			<?php 
			}
			//If the field is not empty and is not a link, then we create a link
			if(($value_gra!='' || $value_gra!=null) and $pos2==false){
			?>
			<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$domain.'/'. $value_gra. $page_uri.'"> >>GO>> </a>';?></p></td></tr>
		
			<?php
			}
			//If the field is a link we redirect to the link
			else{?>
				<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$value_gra.'"> >>GO>> </a>';?></p></td></tr>
		<?php
		}
		}

		foreach($meta_pho as $meta_key) {
			//We take the value of the field
		    $value_pho=$meta_key->meta_value;
		     //We see if it's a link or a word. If it is a link contains .com
		    $pos3 = strpos($value_pho, $findme);
		     //If the value is empty or null the title is not displayed
		    if($value_pho=='' || $value_pho == null){
				$tituloPho=false;
			}
			//If we show the title, we pass the variable to false and set the allempty variable to false and show the title
			if($tituloPho){
				$tituloPho=false;
				$allempty=false;
				?>
				<tr><td> Phonetics and Spelling </td></tr>
			<?php 
			}
			//If the field is not empty and is not a link, then we create a link
			if(($value_pho!='' || $value_pho!=null) and $pos3==false) {
			?>
			<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$domain.'/'. $value_pho. $page_uri.'"> >>GO>> </a>';?></p></td></tr>
			<?php
			}
			//If the field is a link we redirect to the link
			else{?>
				<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$value_pho.'"> >>GO>> </a>';?></p></td></tr>
		<?php
		}
		}

		foreach($meta_text as $meta_key) {
			//We take the value of the field
		    $value_text=$meta_key->meta_value;
		     //We see if it's a link or a word. If it is a link contains .com
		    $pos4 = strpos($value_text, $findme);
		     //If the value is empty or null the title is not displayed
		    if($value_text=='' || $value_text == null){
				$tituloText=false;

			}
			//If we show the title, we pass the variable to false and set the allempty variable to false and show the title
			if($tituloText){
				$tituloText=false;
				$allempty=false;
				?>
				<tr><td> Texts and Functions </td></tr>
			<?php 
			}
			//If the field is not empty and is not a link, then we create a link
			if(($value_text!='' || $value_text!=null) and $pos4==false){
			?>
			<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$domain.'/'. $value_text. $page_uri.'"> >>GO>> </a>';?></p></td></tr>
			<?php
			}
			//If the field is a link we redirect to the link
			else{?>
				<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$value_text.'"> >>GO>> </a>';?></p></td></tr>
		<?php
		}
		}

		foreach($meta_cul as $meta_key) {
			//We take the value of the field
		    $value_cul=$meta_key->meta_value;
		     //We see if it's a link or a word. If it is a link contains .com
		    $pos5 = strpos($value_cul, $findme);
		     //If the value is empty or null the title is not displayed
		    if($value_cul=='' || $value_cul == null){
				$tituloCul=false;
			}
			//If we show the title, we pass the variable to false and set the allempty variable to false and show the title
			if($tituloCul){
				$tituloCul=false;
				$allempty=false;
				?>
				<tr><td> Cultural and Sociocultural </td></tr>
			<?php 
			}
			//If the field is not empty and is not a link, then we create a link
			if(($value_cul!='' || $value_cul!=null) and $pos5==false){
			?>
			<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$domain.'/'. $value_cul. $page_uri.'"> >>GO>> </a>';?></p></td></tr>
			<?php
			}
			//If the field is a link we redirect to the link
			else{?>
				<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$value_cul.'"> >>GO>> </a>';?></p></td></tr>
		<?php
		}
		}

		foreach($meta_extra as $meta_key) {
			//We take the value of the field
		    $value_extra=$meta_key->meta_value;
		     //We see if it's a link or a word. If it is a link contains .com
		    $pos6 = strpos($value_extra, $findme);
		     //If the value is empty or null the title is not displayed
		    if($value_extra=='' || $value_extra == null){
				$tituloExtra=false;
			}
			//If we show the title, we pass the variable to false and set the allempty variable to false and show the title
			if($tituloExtra){
				$tituloExtra=false;
				$allempty=false;
				?>
				<tr><td> Extra Content </td></tr>
			<?php 
			}
			//If the field is not empty and is not a link, then we create a link
			if(($value_extra!='' || $value_extra!=null)and $pos6==false){
			?>
			<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$domain.'/'. $value_extra. $page_uri.'"> >>GO>> </a>';?></p></td></tr>
			<?php
			}
			//If the field is a link we redirect to the link
			else{?>
				<tr><td><p><?php echo '<a target="_blank" style="font-size:1em; color:blue;" href="'.'http://'.$value_extra.'"> >>GO>> </a>';?></p></td></tr>
		<?php
		}
		}
		?>

		</table>

	<?php

}

}
		
