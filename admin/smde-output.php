<?php

/**
 * Funtion for printing metatags in html
 *
 * @link URL
 *
 * @package simple-metadata-education
 * @subpackage output
 * @since x.x.x (when the file was introduced)
 */


//From this class it will use only lrmi functions and properties
use \vocabularies\SMDE_Metadata_Educational as lrmi_meta;

/**
* Prints metatags
* Used by simple-metadata plugin in smd_general_functions
*
* @since
*
*/

function smde_print_tags () {

	//retreiving option for active locations
	$locations = get_option('smde_locations');

	//Checking if we are executing Book Info or Site-Meta data for the front page - Site Level - Book Level
	if(!is_plugin_active('pressbooks/pressbooks.php')){
		$front_schema = 'site-meta';
	}else{
		$front_schema = 'metadata';
	}

	//recieving post type of current post
	$post_schema = get_post_type();
	$metadata	=	[];

	//defining if page is post (any post type) or front-page
	if ( is_front_page() ) {
		if (isset($locations[$front_schema]) && $locations[$front_schema]) {

			//initializng new instance of educational vocabulary class (in future more vocabularies)
			$lrmi_meta = new lrmi_meta($front_schema);
			//calling vocabulary class method for printing metatags
			$metdata = $lrmi_meta->smde_get_metatags();
		}
	} elseif (!is_home()){
		if (isset($locations[$post_schema]) && $locations[$post_schema]) {

			//initializng new instance of educational vocabulary class (in future more vocabularies)
			$lrmi_meta = new lrmi_meta($post_schema);
			//calling vocabulary class method for printing metatags
			$metadata = $lrmi_meta->smde_get_metatags();
		}
	}

	return $metadata;
}
