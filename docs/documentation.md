### 0.2

## HOW TO USE SHORTCODES 

A shortcode is a WordPress-specific code that lets you do nifty things with very little effort. 

To create a shortcode the first thing to do is to create a function with the functionality that you want. This function may or may not contain parameters.The function must contain parameters if it performs several functions depending on the parameter that is passed to it. If the shortcode only implements a function the function does not need any parameter. 

Once we have the function implemented. What we should do is add our shortcode to our plugin. This is done as follows:

add_shortcode('example', 'get_example');

Where example would be the name of the shortcode and get_example would be the function that would implement it.

<?php echo do_shortcode("[example_shortcode]"); ?>

Then to call the shortcode and perform its functionality simply put the next line where you want to be implemented.


## HOW TO SHOW FIELDS IN TEMPLATE FILE

The first thing that you have to do is download the plugin and installed in your wordpress. Then you have to activated it. 

The second thing that you have to do  is copy this code in the part that you want in your theme. 

Shortcode for resources. This shortcode have 1 parameter type. The types are: all, rc_videos, rc_audios, rc_biblio, rc_exercises, rc_activities.

![Resources](https://github.com/Books4Languages/pressbooks-metadata-related_content/blob/master/docs/resources.JPG)

Shortcode for Link based

![Link based](https://github.com/Books4Languages/pressbooks-metadata-related_content/blob/master/docs/related_based.JPG)

Shortcode for related books

![Related books](https://github.com/Books4Languages/pressbooks-metadata-related_content/blob/master/docs/related_books.JPG)


### 0.1

## HOW TO SHOW FIELDS IN TEMPLATE FILE

The first thing that you have to do is download the plugin and installed in your wordpress. Then you have to activated it. 

The second thing that you have to do  is copy this code in the part that you want in your theme. 

To see the code [click here](https://gist.githubusercontent.com/colomet/7d30eef2f7bd2ad81301b335d6e3c673/raw/c481692d7c013c4aa35602f9313c183a70de453b/PB_RC-show_in_template_files.php)
