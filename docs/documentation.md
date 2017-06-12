## HOW TO SHOW FIELDS IN TEMPLATE FILE

The first thing that you have to do is download the plugin and installed in your wordpress. Then you have to activated it. 

The second thing that you have to do  is copy this code in the part that you want in your theme. 
<code>
<?php  
	$resources= new Pb_Rc_Chapter('Pressbooks-related-content', '0.1' );
	$resources-> print_chapter_r_fields();
?>
</code>

You must take into account that this code print the fields that are in the Pb_Rc_Chapter class, so you can copy for example into one div.