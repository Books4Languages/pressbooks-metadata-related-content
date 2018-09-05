<?php

//Creating settings subpage for Simple Metadata

defined ("ABSPATH") or die ("No script assholes!");

function smde_add_education_settings() {

	add_submenu_page('smd_set_page','Educational Metadata', 'Educational Metadata', 'manage_options', 'smde_set_page', 'smde_render_settings');

	add_meta_box('smde-metadata-location', 'Location Of Metadata', 'smde_render_metabox_schema_locations', 'smde_set_page', 'normal', 'core');

	add_settings_section( 'smde_meta_locations', '', '', 'smde_meta_locations' );

	register_setting('smde_meta_locations', 'smde_locations');

	$post_types = smde_get_all_post_types();
	$locations = get_option('smde_locations');

	foreach ($post_types as $post_type) {
		add_settings_field ('smde_locations['.$post_type.']', ucfirst($post_type), function () use ($post_type, $locations){
			$checked = isset($locations[$post_type]) ? true : false;
			?>
				<input type="checkbox" name="smde_locations[<?=$post_type?>]" id="smde_locations[<?=$post_type?>]" value="1" <?php checked(1, $checked);?>>
			<?php
		}, 'smde_meta_locations', 'smde_meta_locations');
	}
}


function smde_render_settings() {

	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	?>
        <div class="wrap">
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

add_action('admin_menu', 'smde_add_education_settings', 100);
