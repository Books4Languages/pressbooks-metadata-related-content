## Presbooks-related-content 

Contributors: @colomet,  @nicoleacuna

Tags: pressbooks, links

Tested up to: [![WordPress](https://img.shields.io/wordpress/v/akismet.svg)](https://wordpress.org/download/)


Stable tag: [![Current Release](https://img.shields.io/github/release/Books4Languages/pressbooks-metadata-related_content.svg)](https://github.com/Books4Languages/pressbooks-metadata-related_content/releases/latest/)

License:  [![License](https://img.shields.io/badge/license-GPL--2.0%2B-red.svg)](https://github.com/Books4Languages/pressbooks-metadata-related_content/blob/master/license.txt)

License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Description  
With this plugin you can create new links in chapter posttype and show them in a frontend. You can also create relationships between books (using words or links) and will be displayed in the frontend. And finally, you can relate your book to the book on which it is based.  We use boilerplate 3.0 version to create this plugin.

## Installation 
1. Clone (or copy) this repository to the /wp-content/plugins/ directory.
2. Activate the plugin through the  'Plugins' screen in WordPress.

## Frequently Asked Questions 
1. If i don't need to use all the fields of the plugin, can i leave them empty? Yes, you can leaves them empty. If one field is em`pty the link will not appear in the frontend.

## Requirements 
Plugin works with:

- ![PHP](https://img.shields.io/badge/PHP-5.6.X-blue.svg)

- [![Pressbooks](https://img.shields.io/badge/Pressbooks-V%203.9.9-red.svg)](https://github.com/pressbooks/pressbooks/releases/tag/3.9.9)

- This plugin requires having the pressbooks-isced-fields plugin enabled.


## Disclaimers 
The Pressbooks plugin is supplied "as is" and all use is at your own risk.

## Screenshots 
You can see all of the screenshots of the plugin [here](https://github.com/Books4Languages/pressbooks-metadata-related_content/blob/master/pressbooks-related-content/screenshots/screenshots.md).
## Roadmap


## Changelogs 
### 0.2

* **ADDITIONS**
	* New custom metabox called **Related Books** with links/text field in Book Info.

		* New texts fields (You can put a link or a word)
			* **Vocabulary**
			* **Grammar**
			* **Phonetics and Spelling**
			* **Texts and functions**
			* **Cultural and Sociocultural**
			* **Extra content**
			* **Link of book based**
		* New class: **Pb_Rc_Books** that contains the functions **add_metadata**, **get_instance**, **print_link_based**, **are_related_books_enable** and **print_related_books_fields**. This class is in include/class-pressbooks-related-books-metadata.php
		* New function: **add_metadata** that produce the Related books metabox and the texts fields to Related Books metabox in Book Info. 
		* New function: **get_instance** that return the instance of Pb_Rc_Chapter class. This function is called in pressbooks-related-content.php and in class-presbooks-related-functions.php
		* New function: **print_link_based**. This function takes information from the **link_based** field and **languages** field (Field created in the **pressbooks-isced-fields** plugin). The function displays a link and the image of the language flag (epending on the language field value) in the footer of frontend. This function is called by a shortcode in **class-pressbooks-related-functions.php**.
		* New function: **print_related_books_fields** that prints the links (**HTML** code) to related books for the public part of the book.This fucntion is called by shortcode in **clas-pressbooks-related-functions.php**


	* New custom metabox called **Related Books** with checkbox field in Parts. This button enables or disables the functions of related books.


		* New php file: **class-presbooks-related-functions.php** that is in include/. This file contains the **shortcodes** of the plugin. Contains **print_related_content** function, **print_related_books** function and **print_links_based** function. And the shortcodes: **related_content**, **related_books**, and **related_based**.
		* New function: **are_related_books_enabled**. This function checks if the related book checkbox is enabled.Receive with parameter the post_id and returns true if the checkbox is enabled, false otherwise.
		* New function: **print_related_content($type)**.Shortcode that calls the function **print_chapter_r_fields** with a parameter. This parameter is the type. Depending on the type you pass one parameter or another.
		* New function: **print_related_books** is a shortcode that calls the **print_related_books_fields** function.
		* New function: **print_links_based** is a shortcode  that calls the **print_link_based** function.



	* In pressbooks related content class

		* New action:**custom_metadata_manager_init_metadata** that call add_metadata function of **Pb_Rc_Books** class.

* **ENHANCEMENTS**
	
	* We replace the call of **print_ in_chapter_r_field** function in functions theme with a shortcode called **are_related_books_enabled**.
	* The **print_chapter_r_fields($cont)** function now receives a parameter that serves to know what information to display. If receives "video" only display the video values in frontend. If receives "audio" only display the audio values in frontend. If receives "activities" only display the activities values in frontend. If receives "exercises" only display the exercises values in frontend. If receives "biblio" only display the biblio values in frontend. If receives "all"  display all values of all the fields in the frontend. 
	* Documentation 

* **List of files revised**

	* includes/class-pressbooks-related-functions.php
	* includes/class-external-content.php
	* includes/class-pressbooks-related-books-metadata.php
	* includes/class-pressbooks-related-functions.php
	* includes/class-pressbooks-related-content.php


### 0.1
* **ADDITIONS**
 
 	* New  custom metabox called **Resources** with links fields. 

		* New multiple field: **video**: Video link
		* New multiple field: **audio**: Audio link
		* New multiple field: **exercises**: Exercises link
		* New multiple field: **activities**: Activities link
		* New multiple field: **bibliography**: Bibliography link
		* New class: **Pb_Rc_Chapter** that contains the functions **add_metadata**, **print_chapter_r_fields** and **get_instance**. This class is in includes/class-external-content.php.
		* New function: **add_metadata** that produce the resources links to Resource metabox in custom post Chapter.
		* New function: **print_chapter_r_fields** that create a table that contains the chapter links and print this in frontend. This function is called in functions.php that is in pressbooks-books4languages-child(theme).
		* New function: **get_instance** that return the instance of Pb_Rc_Chapter class. This function is called in pressbooks-related-content.php and functions.php that is in pressbooks-books4languages-child(theme).

	* In pressbooks related content class	

		* New function:  **define_metadata_changes** that create a instance of Pb_Rc_Chapter and defines all the metaboxes and their fields. This function is in include/pressbooks-related-content.php.
		* New action : **custom_metadata_manager_init_metadata** that call add_metadata function of Pb_Rc_Chapter class.

* **List of files revised**

	* includes/class-external-content.php
	* includes/class-pressbooks-related-content.php



## Upgrade Notice 
### 0.2
To use the last version of the plugin.
### 0.1
To use the first version of the plugin.


## Credits 
Here's a link to [WordPress Plugin Boilerplate](http://wppb.io/).

Here's a link to [WordPress](https://wordpress.org/)

Here's a llink to [PressBooks](https://pressbooks.org/get-involved/)

Here's a link to [Dilinger](http://dillinger.io/)

Here's a link to [Markdown's Syntax Documentation](https://daringfireball.net/projects/markdown/syntax)



