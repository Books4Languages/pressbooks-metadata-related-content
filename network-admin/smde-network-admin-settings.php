<?php

//network settings functionality

use \vocabularies\SMDE_Metadata_Educational as edu_meta;
use \vocabularies\SMDE_Metadata_Classification as class_meta;

defined ("ABSPATH") or die ("No script assholes!");

/**
 * Function for adding network settings page
 */
function smde_add_network_settings() {

    //adding settings metaboxes and settigns sections
    add_meta_box('smde-network-metadata-for-lang', 'Languages education', 'smde_network_render_metabox_for_lang', 'smd_net_set_page', 'normal', 'core');
    add_meta_box('smde-metadata-network-location', 'Educational Metadata', 'smde_network_render_metabox_schema_locations', 'smd_net_set_page', 'normal', 'core');
    add_meta_box('smde-network-metadata-edu-properties', 'Educational Properties Management', 'smde_network_render_metabox_edu_properties', 'smd_net_set_page', 'normal', 'core');
    


    add_settings_section( 'smde_network_meta_locations', '', '', 'smde_network_meta_locations' );

    add_settings_section( 'smde_network_meta_edu_properties', 'Educational Properties', '', 'smde_network_meta_edu_properties' );
    add_settings_section( 'smde_network_meta_class_properties', 'Classification Properties', '', 'smde_network_meta_edu_properties' );

    add_settings_section( 'smde_network_meta_for_lang', '', '', 'smde_network_meta_for_lang' );

    //registering settings
    register_setting('smde_network_meta_locations', 'smde_net_locations');
	register_setting ('smde_network_meta_edu_properties', 'smde_net_edu_shares');
	register_setting ('smde_network_meta_edu_properties', 'smde_net_edu_freezes');
	register_setting ('smde_network_meta_edu_properties', 'smde_net_class_shares');
	register_setting ('smde_network_meta_edu_properties', 'smde_net_class_freezes');
	register_setting ('smde_network_meta_for_lang', 'smde_net_for_lang');

	// getting options values from DB
	$post_types = smd_get_all_post_types();
	$locations = get_option('smde_net_locations');
	$shares_edu = get_option('smde_net_edu_shares');
	$freezes_edu = get_option('smde_net_edu_freezes');
	$shares_class = get_option('smde_net_class_shares');
	$freezes_class = get_option('smde_net_class_freezes');
	$is_for_lang = get_option('smde_net_for_lang');

	//adding settings for locations
	foreach ($post_types as $post_type) {

		//creating labels for settings
		if ('metadata' == $post_type){
			$label = 'Book Info';
		} else {
			$label = ucfirst($post_type);
		}

		add_settings_field ('smde_net_locations['.$post_type.']', $label, function () use ($post_type, $locations){
			$checked = isset($locations[$post_type]) ? true : false;
			?>
				<input type="checkbox" name="smde_net_locations[<?=$post_type?>]" id="smde_net_locations[<?=$post_type?>]" value="1" <?php checked(1, $checked);?>>
			<?php
		}, 'smde_network_meta_locations', 'smde_network_meta_locations');
	}

	//adding settings for educational properties management
	foreach (edu_meta::$edu_properties as $key => $data) {
		add_settings_field ('smde_net_edu_'.$key, ucfirst($data[0]), function () use ($key, $data, $shares_edu, $freezes_edu){
			$checked_edu_share = isset($shares_edu[$key]) ? true : false;
			$checked_edu_freeze = isset($freezes_edu[$key]) ? true : false;
			?>
				<label for="smde_net_edu_shares[<?=$key?>]"><i>Share</i> <input type="checkbox" name="smde_net_edu_shares[<?=$key?>]" id="smde_net_edu_shares[<?=$key?>]" value="1" <?php checked(1, $checked_edu_share);?>></label>
				<label for="smde_net_edu_freezes[<?=$key?>]"><i>Freeze</i> <input type="checkbox" name="smde_net_edu_freezes[<?=$key?>]" id="smde_net_edu_freezes[<?=$key?>]" value="1" <?php checked(1, $checked_edu_freeze);?>></label>
				<br><span class="description"><?=$data[1]?></span>
			<?php
		}, 'smde_network_meta_edu_properties', 'smde_network_meta_edu_properties');
	}

	//adding settings for classification properties management
	foreach (class_meta::$classification_properties_main as $key => $data) {

		//we do not add option for 'specificClass' property (no need to control it)
		if ('specificClass' == $key){
				continue;
		}

		if (get_blog_option(1, 'smde_net_for_lang') && ('eduFrame' == $key || 'iscedField' == $key)){
				continue;
		}

		add_settings_field ('smde_net_class_'.$key, ucfirst($data[0]), function () use ($key, $shares_class, $freezes_class){
			$checked_class_share = isset($shares_class[$key]) ? true : false;
			$checked_class_freeze = isset($freezes_class[$key]) ? true : false;
			?>
				<label for="smde_net_class_shares[<?=$key?>]"><i>Share</i> <input type="checkbox" name="smde_net_class_shares[<?=$key?>]" id="smde_net_class_shares[<?=$key?>]" value="1" <?php checked(1, $checked_class_share);?>></label>
				<label for="smde_net_class_freezes[<?=$key?>]"><i>Freeze</i> <input type="checkbox" name="smde_net_class_freezes[<?=$key?>]" id="smde_net_class_freezes[<?=$key?>]" value="1" <?php checked(1, $checked_class_freeze);?>></label>
			<?php
		}, 'smde_network_meta_edu_properties', 'smde_network_meta_class_properties');
	}

	if (get_blog_option(1, 'smde_net_for_lang')){
		add_settings_field ('smde_net_class_shares[eduLang]', 'Studying content', function () use ($key, $shares_class, $freezes_class){
			$checked_class_share = isset($shares_class['eduLang']) ? true : false;
			$checked_class_freeze = isset($freezes_class['eduLang']) ? true : false;
			?>
				<label for="smde_net_class_shares[eduLang]"><i>Share</i> <input type="checkbox" name="smde_net_class_shares[eduLang]" id="smde_net_class_shares[eduLang]" value="1" <?php checked(1, $checked_class_share);?>></label>
				<label for="smde_net_class_freezes[eduLang]"><i>Freeze</i> <input type="checkbox" name="smde_net_class_freezes[eduLang]" id="smde_net_class_freezes[eduLang]" value="1" <?php checked(1, $checked_class_freeze);?>></label>
			<?php
		}, 'smde_network_meta_edu_properties', 'smde_network_meta_class_properties');
	}

	//adding setting for languages education
	add_settings_field ('smde_net_for_lang', 'Content is for languages education', function () use ($is_for_lang){
			$checked = $is_for_lang ? true : false;
			?>
				<input type="checkbox" name="smde_net_for_lang" id="smde_net_for_lang" value="1" <?php checked(1, $checked);?>>
			<?php
		}, 'smde_network_meta_for_lang', 'smde_network_meta_for_lang');
}

/**
 * Function for rendering network settings page
 */
function smde_render_network_settings(){
	wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
	    ?>
	    <div class="wrap">
	    	<?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) { //in case settings were saved, we show notice?>
        	<div class="notice notice-success is-dismissible"> 
				<p><strong>Settings saved.</strong></p>
			</div>
			<?php } ?>
		    <div class="metabox-holder">
			    <?php
			    	do_meta_boxes('smde_net_set_page', 'normal','');
			    ?>
		    </div>
	    </div>
	    <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready( function($) {
                // close postboxes that should be closed
                $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                // postboxes setup
                postboxes.add_postbox_toggles('<?php echo 'smde_net_set_page'; ?>');
            });
            //]]>
		</script>
		<?php
}

/**
 * Function for rendering metabox of locations
 */
function smde_network_render_metabox_schema_locations(){
	?>
	<div id="smde_network_meta_locations" class="smde_network_meta_locations">
		<span class="description">Description for educational network locations metabox</span>
		<form method="post" action="edit.php?action=smde_update_network_locations">
			<?php
			settings_fields( 'smde_network_meta_locations' );
			do_settings_sections( 'smde_network_meta_locations' );
			submit_button();
			?>
		</form>
		<p></p>
	</div>
	<?php
}

/**
 * Function for rendering metabox for properties management
 */
function smde_network_render_metabox_edu_properties(){
	?>
	<div id="smde_network_meta_edu_properties" class="smde_network_meta_edu_properties">
		<span class="description">Description for educational network properties metabox</span>
		<form method="post" action="edit.php?action=smde_update_network_options">
			<?php
			settings_fields( 'smde_network_meta_edu_properties' );
			do_settings_sections( 'smde_network_meta_edu_properties' );
			submit_button();
			?>
		</form>
		<p></p>
	</div>
	<?php
}

/**
 * Function for rendering metabox for properties management
 */
function smde_network_render_metabox_for_lang(){
	?>
	<div id="smde_network_meta_for_lang" class="smde_network_meta_for_lang">
		<span class="description">Description for language education metabox</span>
		<form method="post" action="edit.php?action=smde_update_network_for_lang">
			<?php
			settings_fields( 'smde_network_meta_for_lang' );
			do_settings_sections( 'smde_network_meta_for_lang' );
			submit_button();
			?>
		</form>
		<p></p>
	</div>
	<?php
}

/**
 * Handler for locations settings update
 */
function smde_update_network_locations() {

	//checking admin reffer to prevent direct access to this function
	check_admin_referer('smde_network_meta_locations-options');

	//Wordpress Database variable for database operations
    global $wpdb;

    //collecting locations accumulative option from POST request
	$locations = isset($_POST['smde_net_locations']) ? $_POST['smde_net_locations'] : array();

	//updating network location option
	update_blog_option(1, 'smde_net_locations', $locations);

	//Grabbing all the site IDs
    $siteids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

    //Going through the sites and updating active locations site-by-site
    foreach ($siteids as $site_id) {
    	if (1 == $site_id){
    		continue;
    	}

    	switch_to_blog($site_id);

    	//getting blog active lcoations
    	$locations_local = get_option('smde_locations') ?: array();

    	//we merge active locations of blog with active locations from network settings
    	$locations_local = array_merge($locations_local, $locations);

    	update_option('smde_locations', $locations_local);

    }

    restore_current_blog();

	// At the end we redirect back to our options page.
    wp_redirect(add_query_arg(array('page' => 'smd_net_set_page',
    'settings-updated' => 'true'), network_admin_url('settings.php')));

    exit;
}

/**
 * Handler for properties settings update
 */
function smde_update_network_options() {

	//checking admin reffer to prevent direct access to this function
	check_admin_referer('smde_network_meta_edu_properties-options');

	//Wordpress Database variable for database operations
    global $wpdb;

    //collecting sharing and freezeing options for educational propertis and classification form POST request
    $freezes = isset($_POST['smde_net_edu_freezes']) ? $_POST['smde_net_edu_freezes'] : array();
    $shares = isset($_POST['smde_net_edu_shares']) ? $_POST['smde_net_edu_shares'] : array();
    //if property is frozen, it's automatically shared
    $shares = array_merge($shares, $freezes);

    $freezes_class = isset($_POST['smde_net_class_freezes']) ? $_POST['smde_net_class_freezes'] : array();
    $shares_class = isset($_POST['smde_net_class_shares']) ? $_POST['smde_net_class_shares'] : array();
    //if property is frozen, it's automatically shared
    $shares_class = array_merge($shares_class, $freezes_class);
    //updating network options
	update_blog_option(1, 'smde_net_edu_freezes', $freezes);
	update_blog_option(1, 'smde_net_edu_shares', $shares);
	update_blog_option(1, 'smde_net_class_freezes', $freezes_class);
	update_blog_option(1, 'smde_net_class_shares', $shares_class);

	//Grabbing all the site IDs
    $siteids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

    //Going through the sites
    foreach ($siteids as $site_id) {

    	if (1 == $site_id){
    		continue;
    	}

    	switch_to_blog($site_id);

    	//collecting local blog options values and merge them with ones from network settings
    	$freezes_local = get_option('smde_edu_freezes') ?: array();
    	$freezes_local = array_merge($freezes_local, $freezes);

    	$shares_local = get_option('smde_edu_shares') ?: array();
    	$shares_local = array_merge($shares_local, $shares);

		$freezes_local_class = get_option('smde_class_freezes') ?: array();
    	$freezes_local_class = array_merge($freezes_local_class, $freezes_class);

    	$shares_local_class = get_option('smde_class_shares') ?: array();
    	$shares_local_class = array_merge($shares_local_class, $shares_class);    	

    	//updating local options
    	update_option('smde_edu_freezes', $freezes_local);
    	update_option('smde_edu_shares', $shares_local);
    	update_option('smde_class_freezes', $freezes_local_class);
    	update_option('smde_class_shares', $shares_local_class);

    	smde_update_overwrites();
    }

    restore_current_blog();

	// At the end we redirect back to our options page.
    wp_redirect(add_query_arg(array('page' => 'smd_net_set_page',
    'settings-updated' => 'true'), network_admin_url('settings.php')));

    exit;
}

/**
 * Handler for type of education update
 */
function smde_update_network_for_lang() {
	//checking admin reffer to prevent direct access to this function
	check_admin_referer('smde_network_meta_for_lang-options');

	$is_for_languages = isset($_POST['smde_net_for_lang']) ? $_POST['smde_net_for_lang'] : '';
	update_blog_option(1, 'smde_net_for_lang', $is_for_languages);

	// At the end we redirect back to our options page.
    wp_redirect(add_query_arg(array('page' => 'smd_net_set_page',
    'settings-updated' => 'true'), network_admin_url('settings.php')));

    exit;
}


add_action( 'network_admin_menu', 'smde_add_network_settings', 1000);
add_action( 'network_admin_edit_smde_update_network_locations', 'smde_update_network_locations');
add_action( 'network_admin_edit_smde_update_network_options', 'smde_update_network_options');
add_action( 'network_admin_edit_smde_update_network_for_lang', 'smde_update_network_for_lang');