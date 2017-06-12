## Presbooks-related-content 

Contributors: @colomet,  @nicoleacuna

Tags: pressbooks, links

Tested up to: [![WordPress](https://img.shields.io/wordpress/v/akismet.svg)](https://wordpress.org/download/)


Stable tag: [![Current Release](https://img.shields.io/github/release/Books4Languages/pressbooks-metadata.svg)](https://github.com/Books4Languages/pressbooks-metadata/releases/latest/)

License:  [![License](https://img.shields.io/badge/license-GPL--2.0%2B-red.svg)](https://github.com/Books4Languages/pressbooks-metadata/blob/master/license.txt)

License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Description  
With this plugin you can create new links in chapter posttype and show them in a frontend.

## Installation 
1. Clone (or copy) this repository to the /wp-content/plugins/ directory.
2. Activate the plugin through the  'Plugins' screen in WordPress.

## Frequently Asked Questions 
1. If i don't need to use all the fields of the plugin, can i leave them empty? Yes, you can leaves them empty. If one field is em`pty the link will not appear in the frontend.

## Requirements 
Plugin works with:

- ![PHP](https://img.shields.io/badge/PHP-5.6.X-blue.svg)

- [![Pressbooks](https://img.shields.io/badge/Pressbooks-V%203.9.9-red.svg)](https://github.com/pressbooks/pressbooks/releases/tag/3.9.9)

## Disclaimers 
The Pressbooks plugin is supplied "as is" and all use is at your own risk.

## Screenshots 
You can see all of the screenshots of the plugin here

## Roadmap


## Changelogs 
### 0.2
* **ADDITONS**
 
 	* New custom metabox called **Resources** with links fields. This fields contains video, audio, exercises, activities and bibliography links that teachers insert.

		* New field: **video**: Video link
		* New field: **audio**: Audio link
		* New field: **exercises**: Exercises link
		* New field: **activities**: Activities link
		* New field: **bibliography**: Bibliography link
		* New class: **Pb_Rc_Chapter** that contains the functions **add_metadata**, **print_chapter_r_fields** and **get_instance**. This class is in includes/class-external-content.php.
		* New function: **add_metadata** that produce the resources links to Resource metabox in custom post Chapter.
		* New function: **print_chapter_r_fields** that create a table that contains the chapter links and print this in frontend. This function is called in functions.php that is in pressbooks-books4languages-child(theme).
		* New function: **get_instance** that return the instance of Pb_Rc_Chapter class. This function is called in pressbooks-related-content.php and functions.php that is in pressbooks-books4languages-child(theme).
		* New function:  **define_metadata_changes** that create a instance of Pb_Rc_Chapter and defines all the metaboxes and their fields. This function is in include/pressbooks-related-content.php.
		* New action : **custom_metadata_manager_init_metadata** that call add_metadata function.

* **List of files revised**

	* includes/class-external-content.php
	* includes/class-pressbooks-related-content.php


### 0.1
* **REQUERIRED**
	* Plugin Borilerplate. 

## Upgrade Notice 
### 0.2
To use the version 2.0 of the plugin.
###0.1
To begin with the plugin boilerplate.

## Credits 
Here's a link to [WordPress Plugin Boilerplate](http://wppb.io/).

Here's a link to [WordPress](https://wordpress.org/)

Here's a llink to [PressBooks](https://pressbooks.org/get-involved/)

Here's a link to [Dilinger](http://dillinger.io/)

Here's a link to [Markdown's Syntax Documentation](https://daringfireball.net/projects/markdown/syntax)



