<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       Nicole
 * @since      0.1
 *
 * @package    Pressbooks_Related_Content
 * @subpackage Pressbooks_Related_Content/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
     <?php
          
       
   		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'resources_op';

     ?>
         
    <h2 class="nav-tab-wrapper">
    		<a href="?page=pressbooks-related-content_options_page&tab=resources_op" class="nav-tab <?php echo $active_tab == 'resources_op' ? 'nav-tab-active' : ''; ?>"> PB Metadata</a>
            <a href="?page=pressbooks-related-content_options_page&tab=post_op" class="nav-tab <?php echo $active_tab == 'post_op' ? 'nav-tab-active' : ''; ?>">Post Type Options</a>
            <a href="?page=pressbooks-related-content_options_page&tab=isced_op" class="nav-tab <?php echo $active_tab == 'isced_op' ? 'nav-tab-active' : ''; ?>">Post Type Options</a>
   
  			
        </h2>
         
    <form action="options.php" method="post">
		<?php

		 if( $active_tab == 'resources_op' ) {
			
			settings_fields( 'pressbooks-related-content_options_page_post_op');
			do_settings_sections('pressbooks-related-content_options_page_post_op');
		}else if( $active_tab == 'post_op' ){
			settings_fields('pressbooks-metadata_options_page');
			do_settings_sections( 'pressbooks-metadata_options_page');
		}else if($active_tab == 'isced_op'){
			settings_fields('pressbooks-related-content_isced_options_page');
			do_settings_sections( 'pressbooks-related-content_isced_options_page');
		}

		submit_button();
		?>
    </form>
</div>