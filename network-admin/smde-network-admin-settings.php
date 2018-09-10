<?php

//network settings functionality

use \vocabularies\SMDE_Metadata_Educational as lrmi_meta;

defined ("ABSPATH") or die ("No script assholes!");

function smde_add_network_settings() {
	// Create our options page.
    add_submenu_page( 'settings.php', 'Simple Metadata Network Settings',
    'Simple Metadata', 'manage_network_options',
    'smde_net_set_page', 'smde_render_network_settings');

    add_meta_box('smde-network-metadata-lrmi-properties', 'LRMI Properties Management', 'smde_network_render_metabox_lrmi_properties', 'smde_net_set_page', 'normal', 'core');

    add_settings_section( 'smde_network_meta_lrmi_properties', '', '', 'smde_network_meta_lrmi_properties' );
	register_setting ('smde_network_meta_lrmi_properties', 'smde_net_lrmi_shares');
	egister_setting ('smde_network_meta_lrmi_properties', 'smde_net_lrmi_freezes');
}

function smde_render_network_settings(){
	wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
	    ?>
	    <div class="wrap">
		    <div class="metabox-holder">
                <?php if (isset($_GET['updated'])): ?>
                <div id="message" class="updated notice is-dismissible"><p>Settings saved.</p></div>
                <?php endif; ?>
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

function smde_network_render_metabox_lrmi_properties(){
	?>
	<div id="smde_network_meta_lrmi_properties" class="smde_network_meta_lrmi_properties">
		<form method="post" action="edit.php?action=smde_update_network">
			<?php
			settings_fields( 'smde_network_meta_lrmi_properties' );
			do_settings_sections( 'smde_network_meta_lrmi_properties' );
			submit_button();
			?>
		</form>
		<p></p>
	</div>
	<?php
}

add_action( 'network_admin_menu', 'smde_add_network_settings');