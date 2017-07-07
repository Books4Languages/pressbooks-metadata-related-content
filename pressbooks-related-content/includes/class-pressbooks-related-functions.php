<?php

/**
 * Create plugin shortcodes
 *
 * This file is used to create plugin shortcodes
 *
 * @link       Nicole
 * @since      0.2
 *
 * @package    Pressbooks_Related_Content
 * @subpackage Pressbooks_Related_Content/admin/partials
 */

/*
*Shortcode that calls the function print_chapter_r_fields with a parameter. 
*This parameter is the type. Depending on the type you 
*pass one parameter or another
*
*
*/
function print_related_content($type) {
 	// exract the atts array
 	extract(shortcode_atts(array(
 		'type' => 'type'
 		),$type));
 	//Instantiate Pb_Rc_Chapter class 
 	$resources= new Pb_Rc_Chapter('Pressbooks-related-content', '0.1' );
 	//We call for each case the function print_chapter_r_fields with a different parameter
 	switch ($type) {
 		case "rc_videos":
 			$resources-> print_chapter_r_fields("Video");
 			break;
 		case "rc_activities":
 			$resources-> print_chapter_r_fields("Activities");
 			break;
 		case "rc_exercises":
 			$resources-> print_chapter_r_fields("Exercises");
 			break;
 		case "rc_audios":
 			$resources-> print_chapter_r_fields("Audio");
 			break;
 		case "rc_biblio":
 			$resources-> print_chapter_r_fields("Biblio");
 			break;
 		case "all":
 			$resources-> print_chapter_r_fields("all");
 			break;
 	
 	}
	
}
//adding the shortcode
add_shortcode('related_content', 'print_related_content');

/*
* Shortcode that calls the print_related_books_fields() function
* that print the relationship between books.
*/

function print_related_books(){
	//Inistantiate Pb_Rc_Books class
	$RBF= new Pb_Rc_Books('Pressbooks-related-content', '0.1' );
	//call the function
	$RBF->print_related_books_fields();
}
//Adding the shrotcode
add_shortcode('related_books', 'print_related_books');

/*
* Shortcode that calls the print_link_based() function
* Print the link and flag of link based.
*/

function print_links_based(){
	//Inistantiate Pb_Rc_Books class
	$RL= new Pb_Rc_Books('Pressbooks-related-content', '0.1' );
	//call the function
	$RL->print_link_based();

}
//Adding the shortcode
add_shortcode('related_based', 'print_links_based');

/*
* 
* This function is responsible for displaying all information
* of Educational Information metabox. 
* To the values of the fields we access through
*  the function getBookInformation() of PressBooks
*
*/
function info_field() {
	
	// Let's field by field
	echo "INFO METADATA" ;
	echo '<br>';
    // global array that contains associations of name database and label
    global $metakeys;
    // add to metakeys array the new  associations
   	$metakeys['pb_isced_field_ed'] = __( 'ISCED field of education', 'pressbooks-book');
   	$metakeys['pb_isced_level_ed'] = __('ISCED level of education', 'pressbooks-book');
   	$metakeys['pb_age_range_ed'] = __('Age Range', 'pressbooks-book');
   	$metakeys['pb_edu_level_ed'] = __('Educational Level', 'pressbooks-book');
   	$metakeys['pb_edu_framework_ed'] = __('Educational Framework', 'pressbooks-book');
   	$metakeys['pb_learning_resource_type_ed'] = __('Learning Resource Type', 'pressbooks-book');
   	$metakeys['pb_interactivity_type_ed'] = __('Interactivity Type', 'pressbooks-book');
   	$metakeys['pb_time_required_ed'] = __('Class Learning Time (hours)', 'pressbooks-book');
   	$metakeys['pb_educational_role_ed'] = __('Educational Role', 'pressbooks-book');
   	$metakeys['pb_edu_use_ed'] = __('Educational Use', 'pressbooks-book');
   	$metakeys['pb_trg_desc_ed'] = __('Target Description', 'pressbooks-book');
   	$metakeys['pb_trg_url_ed'] = __('Target Url', 'pressbooks-book');
   	// get the information of the book 
	$metadata = \Pressbooks\Book::getBookInformation();
	// for each information of metadata, we see if the key is equal to some id of the fields we want to display
	foreach ( $metadata as $key => $val ) :
		
		if($key == 'pb_isced_field_ed' || $key == 'pb_isced_level_ed' ||  $key == 'pb_age_range_ed' || $key == 'pb_edu_level_ed' || $key == 'pb_edu_framework_ed' || $key == 'pb_learning_resource_type_ed' || $key == 'pb_interactivity_type_ed' || $key == 'pb_educational_role_ed' || $key == 'pb_time_required_ed' || $key == 'pb_edu_use_ed' || $key == 'pb_trg_desc_ed' || $key == 'pb_trg_url_ed'  ):
			// only if the value is not null or not select, we show the information
			if( $val!='--Select--' and $val!=''):
		?>
			<!-- show the label -->
			<?php echo $metakeys[ $key ] ; ?>   :
			<!-- show the value -->
			<?php echo $val;
				  echo '<br>'; ?>
	<?php 
			endif;
		endif;
	endforeach; 
	
 }

// adding shortcode
add_shortcode( 'show_metadata', 'info_field' );


?>

