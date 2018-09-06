<?php

use \vocabularies\SMDE_Metadata_Educational as lrmi_meta;

//Creating settings subpage for Simple Metadata

defined ("ABSPATH") or die ("No script assholes!");

function smde_add_education_settings() {

	add_submenu_page('smd_set_page','Educational Metadata', 'Educational Metadata', 'manage_options', 'smde_set_page', 'smde_render_settings');

	add_meta_box('smde-metadata-location', 'Location Of Metadata', 'smde_render_metabox_schema_locations', 'smde_set_page', 'normal', 'core');

	add_settings_section( 'smde_meta_locations', '', '', 'smde_meta_locations' );

	add_meta_box('smde-metadata-lrmi-properties', 'LRMI Properties Management', 'smde_render_metabox_lrmi_properties', 'smde_set_page', 'normal', 'core');

	add_settings_section( 'smde_meta_lrmi_properties', '', '', 'smde_meta_lrmi_properties' );

	register_setting('smde_meta_locations', 'smde_locations');

	register_setting ('smde_meta_lrmi_properties', 'smde_lrmi_shares');

	register_setting ('smde_meta_lrmi_properties', 'smde_lrmi_freezes');

	$post_types = smde_get_all_post_types();
	$locations = get_option('smde_locations');
	$shares_lrmi = get_option('smde_lrmi_shares');
	$freezes_lrmi = get_option('smde_lrmi_freezes');


	foreach ($post_types as $post_type) {
		if ('metadata' == $post_type){
			$label = 'Book Info';
		} else {
			$label = ucfirst($post_type);
		}
		add_settings_field ('smde_locations['.$post_type.']', $label, function () use ($post_type, $locations){
			$checked = isset($locations[$post_type]) ? true : false;
			?>
				<input type="checkbox" name="smde_locations[<?=$post_type?>]" id="smde_locations[<?=$post_type?>]" value="1" <?php checked(1, $checked);?>>
			<?php
		}, 'smde_meta_locations', 'smde_meta_locations');
	}

	foreach (lrmi_meta::$lrmi_properties as $key => $data) {
		add_settings_field ('smde_lrmi_'.$key, ucfirst($data[1]), function () use ($key, $shares_lrmi, $freezes_lrmi){
			$checked_lrmi_share = isset($shares_lrmi[$key]) ? true : false;
			$checked_lrmi_freeze = isset($freezes_lrmi[$key]) ? true : false;
			?>
				<label for="smde_lrmi_shares[<?=$key?>]"><i>Share</i> <input type="checkbox" name="smde_lrmi_shares[<?=$key?>]" id="smde_lrmi_shares[<?=$key?>]" value="1" <?php checked(1, $checked_lrmi_share);?>></label>
				<label for="smde_lrmi_freezes[<?=$key?>]"><i>Freeze</i> <input type="checkbox" name="smde_lrmi_freezes[<?=$key?>]" id="smde_lrmi_freezes[<?=$key?>]" value="1" <?php checked(1, $checked_lrmi_freeze);?>></label>
			<?php
		}, 'smde_meta_lrmi_properties', 'smde_meta_lrmi_properties');
	}
}


function smde_render_settings() {

	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	?>
        <div class="wrap">
        	<?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) { ?>
        	<div class="notice notice-success is-dismissible"> 
				<p><strong>Settings saved.</strong></p>
			</div>
			<?php }?>
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

function smde_render_metabox_lrmi_properties(){
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
}

function smde_get_all_post_types(){
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	//Gathering the post types that are public including the wordpress ones if pressbooks is disabled
	if(!is_plugin_active('pressbooks/pressbooks.php')){
		$postTypes = array_keys( get_post_types( array( 'public' => true )) );
	}else{
		$postTypes = array_keys( get_post_types( array( 'public' => true,'_builtin' => false )) );
	}
	return $postTypes;
}

function smde_update_overwrites(){
	if(isset($_GET['settings-updated']) && $_GET['settings-updated']){
		;
	}
}

add_action('admin_menu', 'smde_add_education_settings', 100);
add_action('load-smde_set_page','smde_update_overwrites');
