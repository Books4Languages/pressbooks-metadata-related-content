<?php

use \vocabularies\SMDE_Metadata_Educational as lrmi_meta;

//Creating settings subpage for Simple Metadata

defined ("ABSPATH") or die ("No script assholes!");

/**
 * Function to add plugin settings subpage and registering settings and their sections
 */
function smde_add_education_settings() {
	//we don't create settings page in blog 1 (not necessary)
	if ((1 != get_current_blog_id() && is_multisite()) || !is_multisite()){

		add_submenu_page('smd_set_page','Educational Metadata', 'Educational Metadata', 'manage_options', 'smde_set_page', 'smde_render_settings');

		add_meta_box('smde-metadata-location', 'Location Of Metadata', 'smde_render_metabox_schema_locations', 'smde_set_page', 'normal', 'core');

		add_settings_section( 'smde_meta_locations', '', '', 'smde_meta_locations' );

		add_meta_box('smde-metadata-lrmi-properties', 'LRMI Properties Management', 'smde_render_metabox_lrmi_properties', 'smde_set_page', 'normal', 'core');

		add_settings_section( 'smde_meta_lrmi_properties', '', '', 'smde_meta_lrmi_properties' );

		register_setting('smde_meta_locations', 'smde_locations');

		register_setting ('smde_meta_lrmi_properties', 'smde_lrmi_shares');

		register_setting ('smde_meta_lrmi_properties', 'smde_lrmi_freezes');

		$post_types = smd_get_all_post_types();
		$locations = get_option('smde_locations');
		$shares_lrmi = get_option('smde_lrmi_shares');
		$freezes_lrmi = get_option('smde_lrmi_freezes');

		$network_locations = [];
		$network_shares_lrmi = [];
		$network_freezes_lrmi = [];

		if (is_multisite()){
			$network_locations = get_blog_option(1, 'smde_net_locations');
			$network_shares_lrmi = get_blog_option(1, 'smde_net_lrmi_shares');
			$network_freezes_lrmi = get_blog_option(1, 'smde_net_lrmi_freezes');
		}

		foreach ($post_types as $post_type) {
			if ('metadata' == $post_type){
				$label = 'Book Info';
			} else {
				$label = ucfirst($post_type);
			}
			add_settings_field ('smde_locations['.$post_type.']', $label, function () use ($post_type, $locations, $network_locations){
				$checked = isset($locations[$post_type]) ? true : false;
				$disabled = isset($network_locations[$post_type]) && $network_locations[$post_type] ? 'disabled' : '';
				?>
					<input type="checkbox" name="smde_locations[<?=$post_type?>]" id="smde_locations[<?=$post_type?>]" value="1" <?php checked(1, $checked); echo $disabled;?>>
				<?php
				if ('disabled' == $disabled){
					?>
						<input type="hidden" name="smde_locations[<?=$post_type?>]" value="1">
					<?php
				}
			}, 'smde_meta_locations', 'smde_meta_locations');
		}

		foreach (lrmi_meta::$lrmi_properties as $key => $data) {
			add_settings_field ('smde_lrmi_'.$key, ucfirst($data[1]), function () use ($key, $shares_lrmi, $freezes_lrmi, $network_shares_lrmi, $network_freezes_lrmi){
				$checked_lrmi_share = isset($shares_lrmi[$key]) ? true : false;
				$checked_lrmi_freeze = isset($freezes_lrmi[$key]) ? true : false;
				$disabled_share = isset($network_shares_lrmi[$key]) && $network_shares_lrmi[$key] ? 'disabled' : '';
				$disabled_freeze = isset($network_freezes_lrmi[$key]) && $network_freezes_lrmi[$key] ? 'disabled' : '';
				?>
					<label for="smde_lrmi_shares[<?=$key?>]"><i>Share</i> <input type="checkbox" name="smde_lrmi_shares[<?=$key?>]" id="smde_lrmi_shares[<?=$key?>]" value="1" <?php checked(1, $checked_lrmi_share); echo $disabled_share?>></label>
					<label for="smde_lrmi_freezes[<?=$key?>]"><i>Freeze</i> <input type="checkbox" name="smde_lrmi_freezes[<?=$key?>]" id="smde_lrmi_freezes[<?=$key?>]" value="1" <?php checked(1, $checked_lrmi_freeze); echo $disabled_freeze?>></label>
				<?php
				if ('disabled' == $disabled_share){
					?>
						<input type="hidden" name="smde_lrmi_shares[<?=$key?>]" value="1">
					<?php
				}
				if ('disabled' == $disabled_freeze){
					?>
						<input type="hidden" name="smde_lrmi_freezes[<?=$key?>]" value="1">
					<?php
				}
			}, 'smde_meta_lrmi_properties', 'smde_meta_lrmi_properties');
		}
	}
}

/**
 * Function for rendering settings subpage
 */
function smde_render_settings() {
	if(!current_user_can('manage_options')){
		return;
	}

	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	?>
        <div class="wrap">
        	<?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) { ?>
        	<div class="notice notice-success is-dismissible"> 
				<p><strong>Settings saved.</strong></p>
			</div>
			<?php smde_update_overwrites();}?>
            <h2>Simple Metadata Education Settings</h2>
            <div class="metabox-holder">
					<?php
					do_meta_boxes('smde_set_page', 'normal','');
					?>
            </div>
        </div>
        <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready( function($) {
                // close postboxes that should be closed
                $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                // postboxes setup
                postboxes.add_postbox_toggles('smde_set_page');
            });
            //]]>
        </script>
		<?php
}

/**
 * Function for rendering 'Locations' metabox
 */
function smde_render_metabox_schema_locations(){
	?>
	<div id="smde_meta_locations" class="smde_meta_locations">
		<form method="post" action="options.php">
			<?php
			settings_fields( 'smde_meta_locations' );
			do_settings_sections( 'smde_meta_locations' );
			submit_button();
			?>
		</form>
		<p></p>
	</div>
	<?php
}

/**
 * Function for rendering 'LRMI properties' metabox
 */
function smde_render_metabox_lrmi_properties(){
	$locations = get_option('smde_locations');
	$level = is_plugin_active('pressbooks/pressbooks.php') ? 'metadata' : 'site-meta';
	$label = $level == 'metadata' ? 'Book Info' : 'Site-Meta';
	if (isset($locations[$level]) && $locations[$level]){
	?>
	<div id="smde_meta_lrmi_properties" class="smde_meta_lrmi_properties">
		<form method="post" action="options.php">
			<?php
			settings_fields( 'smde_meta_lrmi_properties' );
			submit_button();
			do_settings_sections( 'smde_meta_lrmi_properties' );
			?>
		</form>
		<p></p>
	</div>
	<?php
	} else {
		?>
			<p style="color: red;">Activate <?=$label?> location in order to manage properties.</p>
		<?php
	}
}

/**
 * Function for updating options and forcing overwritings on settings update
 */
function smde_update_overwrites(){

	$locations = get_option('smde_locations');
	$shares_lrmi = get_option('smde_lrmi_shares');
	$freezes_lrmi = get_option('smde_lrmi_freezes');

	
	if(empty($shares_lrmi) && empty($freezes_lrmi)){
		return;
	}

	//Wordpress Database variable for database operations
	global $wpdb;
    //Get the posts table name
    $postsTable = $wpdb->prefix . "posts";
    //Get the postmeta table name
    $postMetaTable = $wpdb->prefix . "postmeta";

    //defining site-meta post type
    $meta_type = is_plugin_active('pressbooks/pressbooks.php') ? 'metadata' : 'site-meta';

    //fetching site-meta/book info post
    $meta_post = $wpdb->get_results($wpdb->prepare(" 
        SELECT ID FROM $postsTable WHERE post_type LIKE %s AND 
        post_status LIKE %s",$meta_type,'publish'),ARRAY_A);

    //If we have more than one or 0 ids in the array then return and stop operation
    //If we have no chapters or posts to distribute data also stop operation
    if(count($meta_post) > 1 || count($meta_post) == 0){
        return;
    }

    //unwrapping ID from subarrays
    $meta_post_id = $meta_post[0]['ID'];


    //getting metadata of site-meta/books info post
    $meta_post_meta = $wpdb->get_results($wpdb->prepare(" 
        SELECT `meta_key`, `meta_value` FROM $postMetaTable WHERE `post_id` LIKE %s
        AND `meta_key` LIKE %s AND `meta_key` LIKE %s
        AND `meta_value` <>''",$meta_post_id,'%%smde_%%','%%_vocab%%'.$meta_type.'%%')
            ,ARRAY_A);
    
 	//Array for storing metakey=>metavalue
    $metaData = null;
    //unwrapping data from subarrays
    foreach($meta_post_meta as $meta){
        $metaData[$meta['meta_key']] = $meta['meta_value'];
    }
    //if there are no fields of educational meta in site-meta/ book info, nothing to share or freeze, exit
    if(count($metaData) == 0){
        return;
    }

    //checking if there is somthing to share
	if(!empty($shares_lrmi)){

		//looping through all active locations
		foreach ($locations as $location => $val){
			if ($location == $meta_type) {
				continue;
			}
        	//Getting all posts of $location type
        	$posts_ids = $wpdb->get_results($wpdb->prepare(" 
        	SELECT `ID` FROM `$postsTable` WHERE `post_type` = %s",$location),ARRAY_A);

        	//looping through all posts of type $locations
        	foreach ($posts_ids as $post_id) {
        		$post_id = $post_id['ID'];

        		foreach ($shares_lrmi as $key => $value) {
        			$meta_key = 'smde_'.strtolower($key).'_lrmi_vocab_'.$location;
        			$metadata_meta_key = 'smde_'.strtolower($key).'_lrmi_vocab_'.$meta_type;
        			if(!get_post_meta($post_id, $meta_key)){
        				update_post_meta($post_id, $meta_key, $metaData[$metadata_meta_key]);
        			}
        		}
        	}

		}
	}

	//checking if there is somthing to share
	if(!empty($freezes_lrmi)){

		//looping through all active locations
		foreach ($locations as $location => $val){
			if ($location == $meta_type) {
				continue;
			}
        	//Getting all posts of $location type
        	$posts_ids = $wpdb->get_results($wpdb->prepare(" 
        	SELECT `ID` FROM `$postsTable` WHERE `post_type` = %s",$location),ARRAY_A);

        	//looping through all posts of type $locations
        	foreach ($posts_ids as $post_id) {
        		$post_id = $post_id['ID'];

        		foreach ($freezes_lrmi as $key => $value) {
        			$meta_key = 'smde_'.strtolower($key).'_lrmi_vocab_'.$location;
        			$metadata_meta_key = 'smde_'.strtolower($key).'_lrmi_vocab_'.$meta_type;
        			if(isset($metaData[$metadata_meta_key])){
        				update_post_meta($post_id, $meta_key, $metaData[$metadata_meta_key]);
        			}
        		}
        	}

		}
	}
}

add_action('admin_menu', 'smde_add_education_settings', 100);
