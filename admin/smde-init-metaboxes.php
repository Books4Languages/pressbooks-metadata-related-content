<?php

//creating metaboxes for educational metadata

use \vocabularies\SMDE_Metadata_Educational as lrmi_meta;

defined ("ABSPATH") or die ("No script assholes!");


function smde_create_metaboxes() {

	$active_locations = get_option('smde_locations');

	foreach ($active_locations as $location => $val) {
		new lrmi_meta($location);
	}
}

add_action( 'custom_metadata_manager_init_metadata', 'smde_create_metaboxes');