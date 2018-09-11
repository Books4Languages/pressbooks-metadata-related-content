<?php

//creating metaboxes for educational metadata

use \vocabularies\SMDE_Metadata_Educational as lrmi_meta;

defined ("ABSPATH") or die ("No script assholes!");


function smde_create_metaboxes() {

	if (1 != get_current_blog_id()){

		$active_locations = get_option('smde_locations');

		foreach ($active_locations as $location => $val) {
			new lrmi_meta($location);
		}
	}

}

function smde_remove_defaults() {
	//removing default metaboxes of Simple Metadata from posts and pages
	remove_meta_box( 'smd_post_type', 'post', 'side' );
	remove_meta_box( 'smd_page_type', 'page', 'side' );
}

add_action( 'custom_metadata_manager_init_metadata', 'smde_create_metaboxes');
add_action('add_meta_boxes', 'smde_remove_defaults', 100);