<?php

/**
 * Summary (no period for file headers)
 *
 * Creates metaboxes for educational metadata
 *
 * @link URL
 *
 * @package simple-metadata-education
 * @subpackage admin/init_metaboxe
 * @since x.x.x (when the file was introduced)
 */


use \vocabularies\SMDE_Metadata_Educational as edu_meta;
use \vocabularies\SMDE_Metadata_Classification as class_meta;

defined ("ABSPATH") or die ("No script assholes!");

/**
* Function for producing metaboxes in all active locations.
*
* @since
*
*/

function smde_create_metaboxes() {

	//for blog 1 in multisite installation we don't create metaboxes as we don't create settings page
	if (1 != get_current_blog_id() || !is_multisite() ){

		//receiving option for active locations of educational metadata
		$active_locations = get_option('smde_locations') ?: [];

		foreach ($active_locations as $location => $val) {
			//create objects for each smde_location values (site_meta, post, page... )
			new edu_meta($location);
			new class_meta($location);
		}
	}
}


add_action( 'custom_metadata_manager_init_metadata', 'smde_create_metaboxes');
