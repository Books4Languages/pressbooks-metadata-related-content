<?php
/**
 * The functions of the plugin.
 *
 *
 * @since      0.1
 *
 * @package    Pressbooks_Metadata
 * @subpackage Pressbooks_Metadata/includes
 * @author     Vasilis Georgoudis <vasilios.georgoudis@gmail.com>
 */
class Pr_Rc_Functions {
	
	/**
	* Prints all the informations about the Resources
	**/
	function print_chapter_resources_fields(){
		$pm_CR = Pb_Rc_Chapter::get_instance();
		$pm_CR->print_chapter_resources_fields();
	}

	/**
	 * Fixes pop-out for extra sidebar buttons.
	 */
	function pm_enqueue_scripts() {
		// TOC pop-out JS code without conflicts with Page Info's one
		wp_dequeue_script( 'pb-pop-out-toc' );
		wp_enqueue_script( 'pb-pop-out-toc', get_stylesheet_directory_uri() . '/js/pop-out.js', array( 'jquery' ), '1.0', false );
	}
	add_action( 'wp_enqueue_scripts', 'pm_enqueue_scripts' );

}