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


?>

