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
 	
 	extract(shortcode_atts(array(
 		'type' => 'type'
 		),$type));

 	$resources= new Pb_Rc_Chapter('Pressbooks-related-content', '0.1' );

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
add_shortcode('related_content', 'print_related_content');

/*
*Shortcode that calls the print_related_books_fields() function
*
*/

function print_related_books(){

	$RBF= new Pb_Rc_Books('Pressbooks-related-content', '0.1' );
	$RBF->print_related_books_fields();
}
add_shortcode('related_books', 'print_related_books');

/*
*Shortcode that calls the print_link_based() function
*
*/

function print_links_based(){

	$RL= new Pb_Rc_Books('Pressbooks-related-content', '0.1' );
	$RL->print_link_based();
}
add_shortcode('related_based', 'print_links_based');

?>

