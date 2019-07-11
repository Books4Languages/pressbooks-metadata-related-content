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
  add_meta_box('smde-network-metadata-for-lang', __('Languages education', 'simple-metadata-education'), 'smde_network_render_metabox_for_lang', 'smd_net_set_page', 'normal', 'core');
  add_meta_box('smde-metadata-network-location', __('Educational Metadata', 'simple-metadata-education'), 'smde_network_render_metabox_schema_locations', 'smd_net_set_page', 'normal', 'core');
  add_meta_box('smde-network-metadata-edu-properties', __('Educational Properties Management', 'simple-metadata-education'), 'smde_network_render_metabox_edu_properties', 'smd_net_set_page', 'normal', 'core');



  add_settings_section( 'smde_network_meta_locations', '', '', 'smde_network_meta_locations' );

  add_settings_section( 'smde_network_meta_edu_properties', __('Educational Properties', 'simple-metadata-education'), '', 'smde_network_meta_edu_properties' );
  add_settings_section( 'smde_network_meta_class_properties', __('Classification Properties', 'simple-metadata-education'), '', 'smde_network_meta_edu_properties' );

  add_settings_section( 'smde_network_meta_for_lang', '', '', 'smde_network_meta_for_lang' );

  //registering settings
  register_setting('smde_network_meta_locations', 'smde_net_locations');
	register_setting ('smde_network_meta_edu_properties', 'smde_net_edu_shares');
	register_setting ('smde_network_meta_edu_properties', 'smde_net_edu_freezes');
	register_setting ('smde_network_meta_edu_properties', 'smde_net_class_shares');
	register_setting ('smde_network_meta_edu_properties', 'smde_net_class_freezes');
	register_setting ('smde_network_meta_for_lang', 'smde_net_for_lang');


  register_setting ('smde_network_meta_edu_properties', 'smde_net_edu_');
  register_setting ('smde_network_meta_class_properties', 'smde_net_class_');

	// getting options values from DB
	$post_types = smd_get_all_post_types();
	$locations = get_option('smde_net_locations');
	$shares_edu1 = get_option('smde_net_edu_shares');
	$freezes_edu = get_option('smde_net_edu_freezes');
	$shares_class1 = get_option('smde_net_class_shares');
	$freezes_class = get_option('smde_net_class_freezes');
	$is_for_lang = get_option('smde_net_for_lang');


  $shares_edu = get_option('smde_net_edu_');
  $shares_class = get_option('smde_net_class_');

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

      $shares_edu[$key] = !empty($shares_edu[$key]) ? $shares_edu[$key] : '0';

			?>
      <label for="smde_net_edu_disable[<?=$key?>]"><?php esc_html_e('Disable', 'simple-metadata-education');?> <input type="radio"  name="smde_net_edu_[<?=$key?>]" value="1" id="smde_net_edu_disable[<?=$key?>]" <?php if ($shares_edu[$key]=='1') { echo "checked='checked'"; }
      ?> <?php checked('disable', get_option('smde_net_edu_'.$key)); ?> ></label>
      <label for="smde_net_edu_local_value[<?=$key?>]"><?php esc_html_e('Local value', 'simple-metadata-education');?> <input type="radio"  name="smde_net_edu_[<?=$key?>]" value="0" id="smde_net_edu_local_value[<?=$key?>]" <?php if ($shares_edu[$key]=='0') { echo "checked='checked'"; }
      ?>  <?php checked('0', get_option('smde_net_edu_'.$key)); ?> ></label>
      <label  for="smde_net_edu_share[<?=$key?>]"><?php esc_html_e('Share', 'simple-metadata-education');?> <input type="radio"  name="smde_net_edu_[<?=$key?>]" value="2" id="smde_net_edu_share[<?=$key?>]" <?php if ($shares_edu[$key]=='2') { echo "checked='checked'"; }
      ?> <?php checked('share', get_option($shares_edu[$key])); ?>></label>
      <label for="smde_net_edu_freeze[<?=$key?>]"><?php esc_html_e('Freeze', 'simple-metadata-education');?> <input type="radio"  name="smde_net_edu_[<?=$key?>]" value="3" id="smde_net_edu_freeze[<?=$key?>]"  <?php if ($shares_edu[$key]=='3') { echo "checked='checked'"; }
      ?>  <?php checked('freeze', get_option('smde_net_edu_'.$key)); ?>></label>
        <br><span class="description"><?=$data[1]?></span>
      <?php
      //if checkboxes are disabled, we add hidden field to store value of option
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

		add_settings_field ('smde_net_class_'.$key, ucfirst($data[0]), function () use ($key, $data, $shares_class, $freezes_class){
			$checked_class_share = isset($shares_class[$key]) ? true : false;
			$checked_class_freeze = isset($freezes_class[$key]) ? true : false;

      $shares_class[$key] = !empty($shares_class[$key]) ? $shares_class[$key] : '0';

	?>
      <label for="smde_net_class_disable[<?=$key?>]"><?php esc_html_e('Disable', 'simple-metadata-education'); ?> <input type="radio"  name="smde_net_class_[<?=$key?>]" value="1" id="smde_net_class_disable[<?=$key?>]" <?php if ($shares_class[$key]=='1') { echo "checked='checked'"; }
      ?> <?php checked('disable', get_option('smde_net_class_'.$key)); ?> ></label>
      <label for="smde_net_class_local_value[<?=$key?>]"><?php esc_html_e('Local value', 'simple-metadata-education'); ?> <input type="radio"  name="smde_net_class_[<?=$key?>]" value="0" id="smde_net_class_local_value[<?=$key?>]" <?php if ($shares_class[$key]=='0') { echo "checked='checked'"; }
      ?>  <?php checked('0', get_option('smde_net_class_'.$key)); ?> ></label>
      <label  for="smde_net_class_share[<?=$key?>]"><?php esc_html_e('Share', 'simple-metadata-education'); ?> <input type="radio"  name="smde_net_class_[<?=$key?>]" value="2" id="smde_net_class_share[<?=$key?>]" <?php if ($shares_class[$key]=='2') { echo "checked='checked'"; }
      ?> <?php checked('share', get_option($shares_class[$key])); ?>></label>
      <label for="smde_net_class_freeze[<?=$key?>]"><?php esc_html_e('Freeze', 'simple-metadata-education'); ?> <input type="radio"  name="smde_net_class_[<?=$key?>]" value="3" id="smde_net_class_freeze[<?=$key?>]"  <?php if ($shares_class[$key]=='3') { echo "checked='checked'"; }
      ?>  <?php checked('freeze', get_option('smde_net_class_'.$key)); ?>></label>
        <br><span class="description"><?=$data[1]?></span>
      <?php
		}, 'smde_network_meta_edu_properties', 'smde_network_meta_class_properties');
	}

	if (get_blog_option(1, 'smde_net_for_lang')){
		add_settings_field ('smde_net_class_shares[eduLang]', __('Studying content', 'simple-metadata-annotation'), function () use ($key, $shares_class, $freezes_class){
			$checked_class_share = isset($shares_class['eduLang']) ? true : false;
			$checked_class_freeze = isset($freezes_class['eduLang']) ? true : false;
      $key = 'eduLang';
      $shares_class[$key] = !empty($shares_class[$key]) ? $shares_class[$key] : '0';

			?>
      <label for="smde_net_class_disable[<?=$key?>]">
        <?php esc_html_e('Disable', 'simple-metadata-education'); ?>
        <input type="radio"  name="smde_net_class_[<?=$key?>]" value="1" id="smde_net_class_disable[<?=$key?>]" <?php if ($shares_class[$key]=='1') { echo "checked='checked'"; } ?> <?php checked('disable', get_option('smde_net_class_'.$key)); ?> >
      </label>
      <label for="smde_net_class_local_value[<?=$key?>]">
        <?php esc_html_e('Local value', 'simple-metadata-education'); ?>
        <input type="radio"  name="smde_net_class_[<?=$key?>]" value="0" id="smde_net_class_local_value[<?=$key?>]" <?php if ($shares_class[$key]=='0') { echo "checked='checked'"; } ?>  <?php checked('0', get_option('smde_net_class_'.$key)); ?> >
      </label>
      <label  for="smde_net_class_share[<?=$key?>]">
        <?php esc_html_e('Share', 'simple-metadata-education'); ?>
        <input type="radio"  name="smde_net_class_[<?=$key?>]" value="2" id="smde_net_class_share[<?=$key?>]" <?php if ($shares_class[$key]=='2') { echo "checked='checked'"; }?> <?php checked('share', get_option($shares_class[$key])); ?>>
      </label>
      <label for="smde_net_class_freeze[<?=$key?>]">
        <?php esc_html_e('Freeze', 'simple-metadata-education'); ?>
        <input type="radio"  name="smde_net_class_[<?=$key?>]" value="3" id="smde_net_class_freeze[<?=$key?>]"  <?php if ($shares_class[$key]=='3') { echo "checked='checked'"; }?>  <?php checked('freeze', get_option('smde_net_class_'.$key)); ?>>
      </label>
				<br>
        <span class="description"><?php esc_html_e('Language which content is about', 'simple-metadata-education'); ?></span>
			<?php
		}, 'smde_network_meta_edu_properties', 'smde_network_meta_class_properties');
	}

	//adding setting for languages education
	add_settings_field ('smde_net_for_lang', __('Content is for languages education', 'simple-metdata-education'), function () use ($is_for_lang){
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
				<p><strong><?php esc_html_e('Settings saved.', 'simple-metadata-education'); ?></strong></p>
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
		<span class="description">
      <?php esc_html_e('Description for educational network locations metabox', 'simple-metadata-education'); ?>
    </span>
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
		<span class="description">
      <?php esc_html_e('Description for educational network properties metabox', 'simple-metadata-education'); ?>
    </span>
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
		<span class="description">
      <?php esc_html_e('Description for language education metabox', 'simple-metadata-education'); ?>
    </span>
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

	 //collecting locations of general meta accumulative option from POST request
	$locations_general = get_blog_option(1, 'smd_net_locations') ?: array();

	$locations_general = array_merge($locations_general, $locations);

	if (isset($locations_general['metadata'])){
		unset($locations_general['metadata']);
	}
	if (isset($locations_general['site-meta'])){
		unset($locations_general['site-meta']);
	}

	//updating network locations option
	update_blog_option(1, 'smde_net_locations', $locations);
	update_blog_option(1, 'smd_net_locations', $locations_general);

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
    	$locations_local_general = get_option('smd_locations') ?: array();

    	//we merge active locations of blog with active locations from network settings
    	$locations_local = array_merge($locations_local, $locations);
    	$locations_local_general = array_merge($locations_local_general, $locations_general);

    	update_option('smde_locations', $locations_local);
    	update_option('smd_locations', $locations_local_general);

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
    $shares_edu = isset($_POST['smde_net_edu_']) ? $_POST['smde_net_edu_'] : array();
    //if property is frozen, it's automatically shared
    $shares_class = isset($_POST['smde_net_class_']) ? $_POST['smde_net_class_'] : array();

    //updating network options
	update_blog_option(1, 'smde_net_edu_', $shares_edu);
	update_blog_option(1, 'smde_net_class_', $shares_class);

	//Grabbing all the site IDs
    $siteids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

    //Going through the sites
    foreach ($siteids as $site_id) {

    	if (1 == $site_id){
    		continue;
    	}

    	switch_to_blog($site_id);

    	//collecting local blog options values and merge them with ones from network settings

    	$shares_local = get_option('smde_edu_') ?: array();
    	$shares_local = array_merge($shares_local, $shares_edu);



    	$shares_local_class = get_option('smde_class_') ?: array();
    	$shares_local_class = array_merge($shares_local_class, $shares_class);

    	//updating local options
    	update_option('smde_edu_', $shares_local);
    	update_option('smde_class_', $shares_local_class);

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
