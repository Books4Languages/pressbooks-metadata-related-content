<?php

use \vocabularies\SMDE_Metadata_Educational as edu_meta;
use \vocabularies\SMDE_Metadata_Classification as class_meta;

//Creating settings subpage for Simple Metadata

defined ("ABSPATH") or die ("No script assholes!");

/**
 * Function to add plugin settings subpage and registering settings and their sections
 */
function smde_add_education_settings() {
	//we don't create settings page in blog 1 (not necessary)
	if ((1 != get_current_blog_id() && is_multisite()) || !is_multisite()){

		//adding submenu page to main plugin settigns page
		add_submenu_page('smd_set_page','Educational Metadata', 'Educational Metadata', 'manage_options', 'smde_set_page', 'smde_render_settings');

		//adding active locations metabox and settings section
		add_meta_box('smde-metadata-location', 'Educational Metadata', 'smde_render_metabox_schema_locations', 'smd_set_page', 'normal', 'core');

		add_settings_section( 'smde_meta_locations', '', '', 'smde_meta_locations' );

		//adding properties metabox and sections for educational properties and classification properties
		add_meta_box('smde-metadata-edu-properties', 'Properties Management', 'smde_render_metabox_edu_properties', 'smde_set_page', 'normal', 'core');

		add_settings_section( 'smde_meta_edu_properties', 'Educational Properties', '', 'smde_meta_edu_properties' );
		add_settings_section( 'smde_meta_class_properties', 'Classification Properties', '', 'smde_meta_edu_properties' );

		//registering setings to corresponding sections
		register_setting('smde_meta_locations', 'smde_locations');

		register_setting ('smde_meta_edu_properties', 'smde_edu_shares');

		register_setting ('smde_meta_edu_properties', 'smde_edu_freezes');

		register_setting ('smde_meta_edu_properties', 'smde_class_shares');

		register_setting ('smde_meta_edu_properties', 'smde_class_freezes');

		//receiving current options values and all registered post types
		$post_types = smd_get_all_post_types();
		$locations = get_option('smde_locations');
		$shares_edu = get_option('smde_edu_shares');
		$freezes_edu = get_option('smde_edu_freezes');
		$shares_class = get_option('smde_class_shares');
		$freezes_class = get_option('smde_class_freezes');

		//initializing variables for network settings in case installation is not multisite to avoid notices and warnings 
		$network_locations = [];
		$network_shares_edu = [];
		$network_freezes_edu = [];
		$network_shares_class = [];
		$network_freezes_class = [];

		//in case of multisite installation, we receive network options for locations and properties
		if (is_multisite()){
			$network_locations = get_blog_option(1, 'smde_net_locations');
			$network_shares_edu = get_blog_option(1, 'smde_net_edu_shares');
			$network_freezes_edu = get_blog_option(1, 'smde_net_edu_freezes');
			$network_shares_class = get_blog_option(1, 'smde_net_class_shares');
			$network_freezes_class = get_blog_option(1, 'smde_net_class_freezes');
		}

		//adding options for locations
		foreach ($post_types as $post_type) {
			if ('metadata' == $post_type){
				$label = 'Book Info';
			} else {
				$label = ucfirst($post_type);
			}
			add_settings_field ('smde_locations['.$post_type.']', $label, function () use ($post_type, $locations, $network_locations){
				$checked = isset($locations[$post_type]) ? true : false;
				//in case location is network active, checkbox is disabled (to prevent changes)
				$disabled = isset($network_locations[$post_type]) && $network_locations[$post_type] ? 'disabled' : '';
				?>
					<input type="checkbox" name="smde_locations[<?=$post_type?>]" id="smde_locations[<?=$post_type?>]" value="1" <?php checked(1, $checked); echo $disabled;?>>
				<?php
				//in case checkbox is disabled, we create hidden field to store value of option
				if ('disabled' == $disabled){
					?>
						<input type="hidden" name="smde_locations[<?=$post_type?>]" value="1">
					<?php
				}
			}, 'smde_meta_locations', 'smde_meta_locations');
		}

		//adding settings for educational properties
		foreach (edu_meta::$edu_properties as $key => $data) {

			add_settings_field ('smde_edu_'.$key, ucfirst($data[0]), function () use ($key, $data, $shares_edu, $freezes_edu, $network_shares_edu, $network_freezes_edu){
				$checked_edu_share = isset($shares_edu[$key]) ? true : false;
				$checked_edu_freeze = isset($freezes_edu[$key]) ? true : false;

				//in case share or freeze is network enabled, checkbox becomes disabled to prevent changes
				$disabled_share = isset($network_shares_edu[$key]) && $network_shares_edu[$key] ? 'disabled' : '';
				$disabled_freeze = isset($network_freezes_edu[$key]) && $network_freezes_edu[$key] ? 'disabled' : '';
				?>
					<label for="smde_edu_shares[<?=$key?>]"><i>Share</i> <input type="checkbox" name="smde_edu_shares[<?=$key?>]" id="smde_edu_shares[<?=$key?>]" value="1" <?php checked(1, $checked_edu_share); echo $disabled_share?>></label>
					<label for="smde_edu_freezes[<?=$key?>]"><i>Freeze</i> <input type="checkbox" name="smde_edu_freezes[<?=$key?>]" id="smde_edu_freezes[<?=$key?>]" value="1" <?php checked(1, $checked_edu_freeze); echo $disabled_freeze?>></label>
					<br><span class="description"><?=$data[1]?></span>
				<?php
				//if checkboxes are disabled, we add hidden field to store value of option
				if ('disabled' == $disabled_share){
					?>
						<input type="hidden" name="smde_edu_shares[<?=$key?>]" value="1">
					<?php
				}
				if ('disabled' == $disabled_freeze){
					?>
						<input type="hidden" name="smde_edu_freezes[<?=$key?>]" value="1">
					<?php
				}
			}, 'smde_meta_edu_properties', 'smde_meta_edu_properties');
		}

		//adding settings for classification properties
		foreach (class_meta::$classification_properties_main as $key => $data) {

			//we do not add option for 'specificClass' property (no need to control it)
			if ('specificClass' == $key){
				continue;
			}

			if (is_multisite() && get_blog_option(1, 'smde_net_for_lang') && ('eduFrame' == $key || 'iscedField' == $key)){
				continue;
			}

			add_settings_field ('smde_class_'.$key, ucfirst($data[0]), function () use ($key, $data, $shares_class, $freezes_class, $network_shares_class, $network_freezes_class){
				$checked_class_share = isset($shares_class[$key]) ? true : false;
				$checked_class_freeze = isset($freezes_class[$key]) ? true : false;
				//in case share or freeze is network enabled, checkbox becomes disabled to prevent changes
				$disabled_share = isset($network_shares_class[$key]) && $network_shares_class[$key] ? 'disabled' : '';
				$disabled_freeze = isset($network_freezes_class[$key]) && $network_freezes_class[$key] ? 'disabled' : '';
				?>
					<label for="smde_class_shares[<?=$key?>]"><i>Share</i> <input type="checkbox" name="smde_class_shares[<?=$key?>]" id="smde_class_shares[<?=$key?>]" value="1" <?php checked(1, $checked_class_share); echo $disabled_share?>></label>
					<label for="smde_class_freezes[<?=$key?>]"><i>Freeze</i> <input type="checkbox" name="smde_class_freezes[<?=$key?>]" id="smde_class_freezes[<?=$key?>]" value="1" <?php checked(1, $checked_class_freeze); echo $disabled_freeze?>></label>
					<br><span class="description"><?=$data[1]?></span>
				<?php
				//if checkboxes are disabled, we add hidden field to store value of option
				if ('disabled' == $disabled_share){
					?>
						<input type="hidden" name="smde_class_shares[<?=$key?>]" value="1">
					<?php
				}
				if ('disabled' == $disabled_freeze){
					?>
						<input type="hidden" name="smde_class_freezes[<?=$key?>]" value="1">
					<?php
				}
			}, 'smde_meta_edu_properties', 'smde_meta_class_properties');

		}

		if (is_multisite() && get_blog_option(1, 'smde_net_for_lang')){
			add_settings_field ('smde_class_eduLang', 'Studying content', function () use ($key, $shares_class, $freezes_class, $network_shares_class, $network_freezes_class){
				$checked_class_share = isset($shares_class['eduLang']) ? true : false;
				$checked_class_freeze = isset($freezes_class['eduLang']) ? true : false;
				//in case share or freeze is network enabled, checkbox becomes disabled to prevent changes
				$disabled_share = isset($network_shares_class['eduLang']) && $network_shares_class['eduLang'] ? 'disabled' : '';
				$disabled_freeze = isset($network_freezes_class['eduLang']) && $network_freezes_class['eduLang'] ? 'disabled' : '';
				?>
					<label for="smde_class_shares[eduLang]"><i>Share</i> <input type="checkbox" name="smde_class_shares[eduLang]" id="smde_class_shares[eduLang]" value="1" <?php checked(1, $checked_class_share);  echo $disabled_share?>></label>
					<label for="smde_class_freezes[eduLang]"><i>Freeze</i> <input type="checkbox" name="smde_class_freezes[eduLang]" id="smde_class_freezes[eduLang]" value="1" <?php checked(1, $checked_class_freeze);  echo $disabled_freeze?>></label>
					<br><span class="description">Language which content is about</span>
				<?php
			}, 'smde_meta_edu_properties', 'smde_meta_class_properties');
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
        	<?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) { //in case settings were saved we show notice and fire overwriting?>
        	<div class="notice notice-success is-dismissible"> 
				<p><strong>Settings saved.</strong></p>
			</div>
			<?php smde_update_overwrites(); }?>
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
		<span class="description">Description for educational locations metabox</span>
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
 * Function for rendering 'edu properties' metabox
 */
function smde_render_metabox_edu_properties(){
	$locations = get_option('smde_locations');
	$level = is_plugin_active('pressbooks/pressbooks.php') ? 'metadata' : 'site-meta';
	$label = $level == 'metadata' ? 'Book Info' : 'Site-Meta';
	if (isset($locations[$level]) && $locations[$level]){
	?>
	<div id="smde_meta_edu_properties" class="smde_meta_edu_properties">
		<span class="description">Description for educational properties metabox</span>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'smde_meta_edu_properties' );
			submit_button();
			do_settings_sections( 'smde_meta_edu_properties' );
			?>
		</form>
		<p></p>
	</div>
	<?php
	} else { // we don't show properties controls in case Book Info - Site-Meta location is not active (senseless)
		?>
			<p style="color: red;">Activate <?=$label?> location in order to manage properties.</p>
		<?php
	}
}

/**
 * Function for updating options and forcing overwritings on settings update
 */
function smde_update_overwrites(){

	//collecting options for locations, freezes and shares
	$locations = get_option('smde_locations');
	$shares_edu = get_option('smde_edu_shares');
	$freezes_edu = get_option('smde_edu_freezes');
	$shares_class = get_option('smde_class_shares');
	$freezes_class = get_option('smde_class_freezes');

	//if there is no freezes or shres at all, exit
	if(empty($shares_edu) && empty($freezes_edu) && empty($freezes_class) && empty($shares_class)){
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
    $metaData = [];
    //unwrapping data from subarrays
    foreach($meta_post_meta as $meta){
        $metaData[$meta['meta_key']] = $meta['meta_value'];
    }
    //if there are no fields of educational meta in site-meta/ book info, nothing to share or freeze, exit
    if(count($metaData) == 0){
        return;
    }

    //checking if there is somthing to share for educational properties, we always skip site-meta location
	if(!empty($shares_edu)){

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

        		foreach ($shares_edu as $key => $value) {
        			$meta_key = 'smde_'.strtolower($key).'_edu_vocabs_'.$location;
        			$metadata_meta_key = 'smde_'.strtolower($key).'_edu_vocabs_'.$meta_type;
        			//we share value only in case no value existed for this field before
        			if(!get_post_meta($post_id, $meta_key) || '' == get_post_meta($post_id, $meta_key)){
        				update_post_meta($post_id, $meta_key, $metaData[$metadata_meta_key]);
        			}
        		}
        	}

		}
	}

	//checking if there is somthing to freeze for educational properties, we always skip site-meta location
	if(!empty($freezes_edu)){

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

        		foreach ($freezes_edu as $key => $value) {
        			$meta_key = 'smde_'.strtolower($key).'_edu_vocabs_'.$location;
        			$metadata_meta_key = 'smde_'.strtolower($key).'_edu_vocabs_'.$meta_type;
        			//we freeze values only exisitng in Book Info
        			if(isset($metaData[$metadata_meta_key])){
        				update_post_meta($post_id, $meta_key, $metaData[$metadata_meta_key]);
        			}
        		}
        	}

		}
	}

	//checking if there is somthing to share for classification properties, we always skip site-meta location
	if(!empty($shares_class)){

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

        		foreach ($shares_class as $key => $value) {
        			$meta_key = 'smde_'.strtolower($key).'_class_vocab_'.$location;
        			$meta_key_desc = 'smde_'.strtolower($key).'_desc_class_vocab_'.$location;
        			$meta_key_url = 'smde_'.strtolower($key).'_url_class_vocab_'.$location;
        			$metadata_meta_key = 'smde_'.strtolower($key).'_class_vocab_'.$meta_type;
        			$metadata_meta_key_desc = 'smde_'.strtolower($key).'_desc_class_vocab_'.$meta_type;
        			$metadata_meta_key_url = 'smde_'.strtolower($key).'_url_class_vocab_'.$meta_type;

					//we share value only in case no value existed for this field before
        			if((!get_post_meta($post_id, $meta_key) || '' == get_post_meta($post_id, $meta_key)) && isset($metaData[$metadata_meta_key])){

        				update_post_meta($post_id, $meta_key, $metaData[$metadata_meta_key]);

        				if (!get_blog_option(1, 'smde_net_for_lang')){
        					//if description and url were provided, we also share them
        					if (isset($metaData[$metadata_meta_key_desc])){
        						update_post_meta($post_id, $meta_key_desc, $metaData[$metadata_meta_key_desc]);
        					}
        					if (isset($metaData[$metadata_meta_key_url])) {
        						update_post_meta($post_id, $meta_key_url, $metaData[$metadata_meta_key_url]);
        					}
        				}
        			}
        		}
        	}
		}
	}

	//checking if there is somthing to freeze for classification properties, we always skip site-meta location
	if(!empty($freezes_class)){

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

        		foreach ($freezes_class as $key => $value) {
        			$meta_key = 'smde_'.strtolower($key).'_class_vocab_'.$location;
        			$meta_key_desc = 'smde_'.strtolower($key).'_desc_class_vocab_'.$location;
        			$meta_key_url = 'smde_'.strtolower($key).'_url_class_vocab_'.$location;
        			$metadata_meta_key = 'smde_'.strtolower($key).'_class_vocab_'.$meta_type;
        			$metadata_meta_key_desc = 'smde_'.strtolower($key).'_desc_class_vocab_'.$meta_type;
        			$metadata_meta_key_url = 'smde_'.strtolower($key).'_url_class_vocab_'.$meta_type;

        			//we overwrite value only if it is defined in Book Info - Site Meta
        			if(isset($metaData[$metadata_meta_key])){

        				update_post_meta($post_id, $meta_key, $metaData[$metadata_meta_key]);

        				if (!get_blog_option(1, 'smde_net_for_lang')){
        					//in case description and url were provided, we also share them
        					if (isset($metaData[$metadata_meta_key_desc])){
        						update_post_meta($post_id, $meta_key_desc, $metaData[$metadata_meta_key_desc]);
        					}
        					if (isset($metaData[$metadata_meta_key_url])) {
        						update_post_meta($post_id, $meta_key_url, $metaData[$metadata_meta_key_url]);
        					}
        				}
        			}
        		}
        	}
		}
	}
}

add_action('admin_menu', 'smde_add_education_settings', 100);
add_action('updated_option', function( $option_name, $old_value, $value ){
	if ('smde_edu_freezes' == $option_name){
		$shares = get_option('smde_edu_shares') ?: [];
		$value = empty($value) ? [] : $value;
		$shares = array_merge($shares, $value);
		update_option('smde_edu_shares', $shares);
	}
	if ('smde_class_freezes' == $option_name){
		$shares = get_option('smde_class_shares') ?: [];
		$value = empty($value) ? [] : $value;
		$shares = array_merge($shares, $value);
		update_option('smde_class_shares', $shares);
	}
	if ('smde_locations' == $option_name){
		$locations_general = get_option('smd_locations') ?: [];
		$value = empty($value) ? [] : $value;
		$locations_general = array_merge($locations_general, $value);

		if (isset($locations_general['metadata'])){
			unset($locations_general['metadata']);
		}
		if (isset($locations_general['site-meta'])){
			unset($locations_general['site-meta']);
		}

		update_option('smd_locations', $locations_general);
	}
}, 10, 3);
