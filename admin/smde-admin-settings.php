<?php

/**
 * Summary (no period for file headers)
 *
 * Creates settings subpage for Simple Metadata
 *
 * @link URL
 *
 * @package simple-metadata-education
 * @subpackage admin/settings
 * @since x.x.x (when the file was introduced)
 */

use \vocabularies\SMDE_Metadata_Educational as edu_meta;
use \vocabularies\SMDE_Metadata_Classification as class_meta;


defined ("ABSPATH") or die ("No script assholes!");

/**
* Function to add plugin settings subpage and registering settings and their sections.
*
* @since
*
*/

function smde_add_education_settings() {
	//we don't create settings page in blog 1 (not necessary)
	if ((1 != get_current_blog_id() && is_multisite()) || !is_multisite()){

		//adding submenu page to main plugin settigns page
		add_submenu_page('smd_set_page',__('Educational Metadata', 'simple-metadata-education'), __('Educational Metadata', 'simple-metadata-education'), 'manage_options', 'smde_set_page', 'smde_render_settings');

		//adding active locations metabox and settings section
		add_meta_box('smde-metadata-location', __('Educational Metadata', 'simple-metadata-education'), 'smde_render_metabox_schema_locations', 'smd_set_page', 'normal', 'core');

		add_settings_section( 'smde_meta_locations', '', '', 'smde_meta_locations' );

		//adding properties metabox and sections for educational properties and classification properties
		add_meta_box('smde-metadata-edu-properties', __('Properties Management', 'simple-metadata-education'), 'smde_render_metabox_edu_properties', 'smde_set_page', 'normal', 'core');

		add_settings_section( 'smde_meta_edu_properties', __('Educational Properties', 'simple-metadata-education'), '', 'smde_meta_edu_properties' );
		add_settings_section( 'smde_meta_class_properties', __('Classification Properties', 'simple-metadata-education'), '', 'smde_meta_edu_properties' );

		//registering setings to corresponding sections
		register_setting('smde_meta_locations', 'smde_locations');

		register_setting ('smde_meta_edu_properties', 'smde_edu_');

		register_setting ('smde_meta_edu_properties', 'smde_class_');

		register_setting ('smde_meta_edu_properties', 'smde_edu_shares');


		register_setting ('smde_meta_edu_properties', 'smde_edu_freezes');

		register_setting ('smde_meta_edu_properties', 'smde_class_shares');

		register_setting ('smde_meta_edu_properties', 'smde_class_freezes');


		$post_types = smd_get_all_post_types();
		$locations = get_option('smde_locations');
		$shares_edu = get_option('smde_edu_');
		$shares_edu1 = get_site_option('smde_net_edu_shares');

		$freezes_edu = get_option('smde_edu_freezes');
		$shares_class = get_option('smde_class_');
		$freezes_class = get_option('smde_class_freezes');

		//initializing variables for network settings in case installation is not multisite to avoid notices and warnings
		$network_locations = [];
		$network_shares_edu = [];
		$network_freezes_edu = [];
		$network_shares_class = [];
		$network_freezes_class = [];

		//in case of multisite installation, we receive network options for locations and properties
		if (is_multisite()){
			$network_locations = get_site_option('smde_net_locations');
			$network_shares_edu = get_site_option('smde_net_edu_');
			$network_freezes_edu = get_site_option('smde_net_edu_freezes');
			$network_shares_class = get_site_option('smde_net_class_');
			$network_freezes_class = get_site_option('smde_net_class_freezes');
		}

		//adding options for locations
		foreach ($post_types as $post_type) {
			if ('metadata' == $post_type){
				$label = 'Book Info';
			}
			if ('site-meta' == $post_type){
				$label = 'Home Page';
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

			add_settings_field ('smde_edu_'.$key, ucfirst($data[0]), function () use ($key, $data, $shares_edu,$network_shares_edu){
				//in case share or freeze is network enabled, checkbox becomes disabled to prevent changes

		//		$shares_class[$key] = !empty($shares_class[$key]) ? $shares_class[$key] : '0';
		if (!empty($network_shares_edu)) {
			if ($network_shares_edu[$key] == '0') {
				$shares_edu = get_option('smde_edu_');
			// $shares_class[$key] == '0';
			 $valeur_key_edu = '4';

			}
			else {
				$shares_edu[$key] = $network_shares_edu[$key];
				 $valeur_key_edu = $shares_edu[$key];
			}
		}else
		 {
			$disabled_ca = '';
			$valeur_key_edu = '4';

		}
				?>
				<?php if ($shares_edu[$key]=='1') {

					if (isset($_GET['hello'])) {
					function runMyFunction122() {
						if (isset($_GET['field_name'])) {
							$locations2 = get_option('smde_locations');
							$key = $_GET['field_name'];
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
											 AND `meta_value` <>''",$meta_post_id,'%%smde_%%','%%edu_vocabs%%'.$meta_type.'%%')
													 ,ARRAY_A);

									//Array for storing metakey=>metavalue
									 $metaData = [];
									 //unwrapping data from subarrays
									 foreach($meta_post_meta as $meta){
											 $metaData[$meta['meta_key']] = $meta['meta_value'];
									 }
									 //if there are no fields of Life Cycle meta in site-meta/ book info, nothing to share or freeze, exit
									 if(count($metaData) == 0){
											 return;
									 }

									 foreach ($locations2 as $location => $val){
										 if ($location == $meta_type) {
											 continue;
										 }
												 //Getting all posts of $location type
												 $posts_ids = $wpdb->get_results($wpdb->prepare("
												 SELECT `ID` FROM `$postsTable` WHERE `post_type` = %s",$location),ARRAY_A);
												 $posts_ids_meta_type = $wpdb->get_results($wpdb->prepare("
												 SELECT `ID` FROM `$postsTable` WHERE `post_type` = %s",$meta_type),ARRAY_A);
												 //looping through all posts of type $locations
												 foreach ($posts_ids as $post_id) {
													 $post_id = $post_id['ID'];
														 $meta_key = 'smde_'.strtolower($key).'_edu_vocabs_'.$location;
														 $metadata_meta_key = 'smde_'.strtolower($key).'_edu_vocabs_'.$meta_type;
															 delete_post_meta($post_id, $meta_key);
															 delete_post_meta($post_id, $metadata_meta_key);

												 }
												 foreach ($posts_ids_meta_type as $post_id_meta_type) {
													 $post_id_meta_type = $post_id_meta_type['ID'];
														 $meta_key_meta_type = 'smde_'.strtolower($key).'_edu_vocabs_'.$location;
														 $metadata_meta_key_type = 'smde_'.strtolower($key).'_edu_vocabs_'.$meta_type;
															 delete_post_meta($post_id_meta_type, $meta_key_meta_type);
															 delete_post_meta($post_id_meta_type, $metadata_meta_key_type);

												 }
							}
						}
}
runMyFunction122();
//refresh the page
	?><meta http-equiv="refresh" content="0;URL=admin.php?page=smde_set_page"><?php
}
 if ($shares_edu[$key]=='1') {
echo '<a style="color:red; text-decoration: none; font-size: 14px;"href = "admin.php?page=smde_set_page&hello=true&field_name='.$key.'&sharekey='.$shares_edu[$key].'">X</a>';}

?>
				&nbsp;&nbsp;
			<?php } ?>
				<label for="smde_edu_disable[<?=$key?>]">
					<?php esc_html_e('Disable', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_edu_[<?=$key?>]" value="1" id="smde_edu_disable[<?=$key?>]" <?php if ($shares_edu[$key]=='1') { echo "checked='checked'"; }?>
					<?php  if ($valeur_key_edu == '1' || $valeur_key_edu == '4') {echo "";}else {echo "disabled";} ?>
					>
				</label>
				<label for="smde_edu_local_value[<?=$key?>]">
					<?php esc_html_e('Local value', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_edu_[<?=$key?>]" value="0" id="smde_edu_local_value[<?=$key?>]" <?php if ($shares_edu[$key]=='0' || empty($shares_edu[$key])) { echo "checked='checked'"; } ?>
					<?php  if ($valeur_key_edu == '0' || $valeur_key_edu == '4') {echo "";}else {echo "disabled";}  ?>>
				</label>
				<label  for="smde_edu_share[<?=$key?>]">
					<?php esc_html_e('Share', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_edu_[<?=$key?>]" value="2" id="smde_edu_share[<?=$key?>]" <?php if ($shares_edu[$key]=='2') { echo "checked='checked'"; }?>
					<?php  if ($valeur_key_edu == '2' || $valeur_key_edu == '4') {echo "";}else {echo "disabled";}  ?>>
				</label>
				<label for="smde_edu_freeze[<?=$key?>]">
					<?php esc_html_e('Freeze', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_edu_[<?=$key?>]" value="3" id="smde_edu_freeze[<?=$key?>]"  <?php if ($shares_edu[$key]=='3') { echo "checked='checked'"; }?>
					<?php  if ($valeur_key_edu == '3' || $valeur_key_edu == '4') {echo "";}else {echo "disabled";}  ?>>
				</label>
					<br><span class="description"><?=$data[1]?></span>
				<?php
				//if checkboxes are disabled, we add hidden field to store value of option
			}, 'smde_meta_edu_properties', 'smde_meta_edu_properties');
		}
		//adding settings for classification properties
		foreach (class_meta::$classification_properties_main as $key => $data) {
			if ('specificClass' == $key){
				continue;
			}

			if (is_multisite() && get_site_option('smde_net_for_lang') && ('eduFrame' == $key || 'iscedField' == $key)){
				continue;
			}
		  add_settings_field ('smde_class_'.$key, ucfirst($data[0]), function () use ($key, $data, $shares_class,$network_shares_class, $network_freezes_class){
		    $checked_class_share = isset($shares_class[$key]) ? true : false;
		    $checked_class_freeze = isset($freezes_class[$key]) ? true : false;

		if (!empty($network_shares_class)) {
			if ($network_shares_class[$key] == '0') {
				$shares_class = get_option('smde_class_');
			// $shares_class[$key] == '0';
			 $valeur_key = '4';

			}
			else {
				$shares_class[$key] = $network_shares_class[$key];
				 $valeur_key = $shares_class[$key];
			}
		}else
		 {
			$disabled_ca = '';
			$valeur_key = '4';
		}
		    ?>
				<?php if ($shares_class[$key]=='1') {

					if (isset($_GET['hello'])) {
					function runMyFunction1228() {
						if (isset($_GET['field_name'])) {
							$locations2 = get_option('smde_locations');
							$key = $_GET['field_name'];
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
											 AND `meta_value` <>''",$meta_post_id,'%%smde_%%','%%class_vocab%%'.$meta_type.'%%')
													 ,ARRAY_A);

									//Array for storing metakey=>metavalue
									 $metaData = [];
									 //unwrapping data from subarrays
									 foreach($meta_post_meta as $meta){
											 $metaData[$meta['meta_key']] = $meta['meta_value'];
									 }
									 //if there are no fields of Life Cycle meta in site-meta/ book info, nothing to share or freeze, exit
									 if(count($metaData) == 0){
											 return;
									 }

									 foreach ($locations2 as $location => $val){
										 if ($location == $meta_type) {
											 continue;
										 }
												 //Getting all posts of $location type
												 $posts_ids = $wpdb->get_results($wpdb->prepare("
												 SELECT `ID` FROM `$postsTable` WHERE `post_type` = %s",$location),ARRAY_A);
												 $posts_ids_meta_type = $wpdb->get_results($wpdb->prepare("
												 SELECT `ID` FROM `$postsTable` WHERE `post_type` = %s",$meta_type),ARRAY_A);
												 //looping through all posts of type $locations
												 foreach ($posts_ids as $post_id) {
													 $post_id = $post_id['ID'];
														 $meta_key = 'smde_'.strtolower($key).'_class_vocab_'.$location;
														 $metadata_meta_key = 'smde_'.strtolower($key).'_class_vocab_'.$meta_type;
															 delete_post_meta($post_id, $meta_key);
															 delete_post_meta($post_id, $metadata_meta_key);

												 }
												 foreach ($posts_ids_meta_type as $post_id_meta_type) {
													 $post_id_meta_type = $post_id_meta_type['ID'];
														 $meta_key_meta_type = 'smde_'.strtolower($key).'_class_vocab_'.$location;
														 $metadata_meta_key_type = 'smde_'.strtolower($key).'_class_vocab_'.$meta_type;
															 delete_post_meta($post_id_meta_type, $meta_key_meta_type);
															 delete_post_meta($post_id_meta_type, $metadata_meta_key_type);

												 }
							}
						}
}
runMyFunction1228();
//refresh the page
?><meta http-equiv="refresh" content="0;URL=admin.php?page=smde_set_page"><?php
}


 if ($shares_class[$key]=='1') {
echo '<a style="color:red; text-decoration: none; font-size: 14px;"href = "admin.php?page=smde_set_page&hello=true&field_name='.$key.'&sharekey='.$shares_class[$key].'">X</a>';}

?>
				&nbsp;&nbsp;
			<?php } ?>
				<label for="smde_class_disable[<?=$key?>]">
					<?php esc_html_e('Disable', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_class_[<?=$key?>]" value="1" id="smde_class_disable[<?=$key?>]"
						<?php if ($shares_class[$key]=='1') { echo "checked='checked'"; }?>
					 <?php  if ($valeur_key == '1' || $valeur_key == '4') {echo "";}else {echo "disabled";}?>
					>
				</label>
				<label for="smde_class_local_value[<?=$key?>]">
					<?php esc_html_e('Local value', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_class_[<?=$key?>]" value="0" id="smde_class_local_value[<?=$key?>]" <?php if ($shares_class[$key]=='0' || empty($shares_class[$key])) { echo "checked='checked'"; }?>

						<?php  if ($valeur_key == '0' || $valeur_key == '4') {echo "";}else {echo "disabled";}?>
					>
				</label>
				<label  for="smde_class_share[<?=$key?>]">
					<?php esc_html_e('Share', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_class_[<?=$key?>]" value="2" id="smde_class_share[<?=$key?>]" <?php if ($shares_class[$key]=='2') { echo "checked='checked'"; }?>
						<?php  if ($valeur_key == '2' || $valeur_key == '4') {echo "";}else {echo "disabled";}?>
					>
				</label>
				<label for="smde_class_freeze[<?=$key?>]">
					<?php esc_html_e('Freeze', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_class_[<?=$key?>]" value="3" id="smde_class_freeze[<?=$key?>]"
					<?php if ($shares_class[$key]=='3') { echo "checked='checked'"; }?>
					<?php  if ($valeur_key == '3' || $valeur_key == '4') {echo "";}else {echo "disabled";}?>
					>
				</label>
		      <br><span class="description"><?=$data[1]?></span>
		    <?php
		    //if checkboxes are disabled, we add hidden field to store value of option
		  }, 'smde_meta_edu_properties', 'smde_meta_class_properties');
		}

		if (is_multisite() && get_site_option('smde_net_for_lang')){
			add_settings_field ('smde_class_eduLang', 'Studying content', function () use ($key, $shares_class, $freezes_class, $network_shares_class, $network_freezes_class){

				//in case share or freeze is network enabled, checkbox becomes disabled to prevent changes
				$key = 'eduLang';
				if (!empty($network_shares_class)) {
					if ($network_shares_class[$key] == '0') {
						$shares_class = get_site_option('smde_net_for_lang');
					// $shares_class[$key] == '0';
					 $valeur_key_langue = '4';
					}
					else {
						$shares_class[$key] = $network_shares_class[$key];
						 $valeur_key_langue = $shares_class[$key];
					}
				}else
				 {
					$disabled_ca = '';
					$valeur_key_langue = '4';
				}
				?>
				<label for="smde_class_disable[<?=$key?>]">
					<?php esc_html_e('Disable', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_class_[<?=$key?>]" value="1" id="smde_class_disable[<?=$key?>]"
					<?php if ($shares_class[$key]=='1') { echo "checked='checked'"; }?>
					<?php  if ($valeur_key_langue == '1' || $valeur_key_langue == '4') {echo "";}else {echo "disabled";}?>
					>
				</label>
				<label for="smde_class_local_value[<?=$key?>]">
					<?php esc_html_e('Local value', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_class_[<?=$key?>]" value="0" id="smde_class_local_value[<?=$key?>]"
					<?php if ($shares_class[$key]=='0' || empty($shares_class[$key])) { echo "checked='checked'"; }?>
					<?php  if ($valeur_key_langue == '0' || $valeur_key_langue == '4') {echo "";}else {echo "disabled";}?>
					>
				</label>
				<label  for="smde_class_share[<?=$key?>]">
					<?php esc_html_e('Share', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_class_[<?=$key?>]" value="2" id="smde_class_share[<?=$key?>]"
					<?php if ($shares_class[$key]=='2') { echo "checked='checked'"; }?>
					<?php //Moved options to site meta check this code
					?>
					<?php  if ($valeur_key_langue == '2' || $valeur_key_langue == '4') {echo "";}else {echo "disabled";} ?>
					>
				</label>
				<label for="smde_class_freeze[<?=$key?>]">
					<?php esc_html_e('Freeze', 'simple-metadata-education'); ?>
					<input type="radio"  name="smde_class_[<?=$key?>]" value="3" id="smde_class_freeze[<?=$key?>]"
					<?php if ($shares_class[$key]=='3') { echo "checked='checked'"; }?>
					<?php  if ($valeur_key_langue == '3' || $valeur_key_langue == '4') {echo "";}else {echo "disabled";} ?>
					>
				</label>
					<br><span class="description"><?php esc_html_e('Language which content is about', 'simple-metadata-education'); ?></span>
				<?php
			}, 'smde_meta_edu_properties', 'smde_meta_class_properties');
		}

	}
}


/**
* Function for rendering settings subpage.
*
* @since
*
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
				<p><strong><?php esc_html_e('Settings saved.', 'simple-metadata-education'); ?></strong></p>
			</div>
			<?php smde_update_overwrites(); }?>
            <h2><?php esc_html_e('Simple Metadata Education Settings', 'simple-metadata-education'); ?></h2>
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
* Function for rendering 'Locations' metabox.
*
* @since
*
*/

function smde_render_metabox_schema_locations(){
	?>
	<div id="smde_meta_locations" class="smde_meta_locations">
		<span class="description">
			<?php esc_html_e('Description for educational locations metabox', 'simple-metadata-education'); ?>
		</span>
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
* Function for rendering 'edu properties' metabox.
*
* @since
*
*/

function smde_render_metabox_edu_properties(){
	$locations = get_option('smde_locations');
	$level = is_plugin_active('pressbooks/pressbooks.php') ? 'metadata' : 'site-meta';
	$label = $level == 'metadata' ? 'Book Info' : 'Site-Meta';
	if (isset($locations[$level]) && $locations[$level]){
	?>
	<div id="smde_meta_edu_properties" class="smde_meta_edu_properties">
		<span class="description">
			<?php esc_html_e('Description for educational properties metabox', 'simple-metadata-education'); ?>
		</span>
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
			<p style="color: red;">
				<?php printf(esc_html__('Activate %s location in order to manage properties.', 'simple-metadata-education'), $label); ?>
			</p>
		<?php
	}
}

/**
* Summary.
*
* @since
*
*/

function smde_update_overwrites(){

	//collecting options for locations, freezes and shares
	$locations = get_option('smde_locations');
	$shares_edu = get_option('smde_edu_');
	$shares_class = get_option('smde_class_');


	//if there is no freezes or shres at all, exit
	if(empty($shares_edu) && empty($shares_class)){
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
		//looping through all active location
						foreach ($shares_edu as $key => $value) {
							if ($value=='2') {
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
													if ($value=='2') {
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
							}
							if ($value=='3') {
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
														if ($value=='3') {
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
							}
        		}
        	}

					if(!empty($shares_class)){
						//looping through all active location
										foreach ($shares_class as $key => $value) {
											if ($value=='2') {
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
																	if ($value=='2') {
																		$meta_key = 'smde_'.strtolower($key).'_class_vocab_'.$location;
											        			$meta_key_desc = 'smde_'.strtolower($key).'_desc_class_vocab_'.$location;
											        			$meta_key_url = 'smde_'.strtolower($key).'_url_class_vocab_'.$location;
											        			$metadata_meta_key = 'smde_'.strtolower($key).'_class_vocab_'.$meta_type;
											        			$metadata_meta_key_desc = 'smde_'.strtolower($key).'_desc_class_vocab_'.$meta_type;
											        			$metadata_meta_key_url = 'smde_'.strtolower($key).'_url_class_vocab_'.$meta_type;
										        			//we share value only in case no value existed for this field before
																	if((!get_post_meta($post_id, $meta_key) || '' == get_post_meta($post_id, $meta_key)) && isset($metaData[$metadata_meta_key])){
										        				update_post_meta($post_id, $meta_key, $metaData[$metadata_meta_key]);
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
											if ($value=='3') {
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
																		if ($value=='3') {
																			$meta_key = 'smde_'.strtolower($key).'_class_vocab_'.$location;
												        			$meta_key_desc = 'smde_'.strtolower($key).'_desc_class_vocab_'.$location;
												        			$meta_key_url = 'smde_'.strtolower($key).'_url_class_vocab_'.$location;
												        			$metadata_meta_key = 'smde_'.strtolower($key).'_class_vocab_'.$meta_type;
												        			$metadata_meta_key_desc = 'smde_'.strtolower($key).'_desc_class_vocab_'.$meta_type;
												        			$metadata_meta_key_url = 'smde_'.strtolower($key).'_url_class_vocab_'.$meta_type;
										        			//we freeze values only exisitng in Book Info
										        			if(isset($metaData[$metadata_meta_key])){

										        				update_post_meta($post_id, $meta_key, $metaData[$metadata_meta_key]);
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
				        	}
}

add_action('admin_menu', 'smde_add_education_settings', 100);
add_action('updated_option', function( $option_name, $old_value, $value ){
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
