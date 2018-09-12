<?php

//functionality for printing metatags

use \vocabularies\SMDE_Metadata_Educational as lrmi_meta;

/**
 * Function for printing metatags in site front-end
 */
function smde_print_tags () {

	$locations = get_option('smde_locations');

	//Checking if we are executing Book Info or Site-Meta data for the front page - Site Level - Book Level
	if(!is_plugin_active('pressbooks/pressbooks.php')){
		$front_schema = 'site-meta';
	}else{
		$front_schema = 'metadata';
	}

	//recieving post type of current post
	$post_schema = get_post_type();

	//defining if page is post or front-page
	if ( is_front_page() ) {
		if (isset($locations[$front_schema]) && $locations[$front_schema]) {
			$lrmi_meta = new lrmi_meta($front_schema);
			echo $lrmi_meta->smde_get_metatags();
		}
	} elseif (!is_home()){
		if (isset($locations[$post_schema]) && $locations[$post_schema]) {
			$lrmi_meta = new lrmi_meta($post_schema);
			echo $lrmi_meta->smde_get_metatags();
		}
	}

}

add_action ('wp_head', 'smde_print_tags');