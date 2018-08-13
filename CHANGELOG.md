
# Changelog

## 0.2

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
		* New class: **Pb_Rc_Books**.
			* New function: **get_instance** that return the instance of Pb_Rc_Chapter class.
			* New function: **print_link_based**. Displays a link and the image of the language flag in the footer.
			* New function: **print_related_books_field** prints the links to related books in the footer.

	* New custom metabox called **Related Books** create a checkbox that enables or disables the functions of related books.

	* New functionality: **shortcodes**

		* **related_content**
		* **related_books**
		* **related_based**
		* **show_metadata**
		* New functions for **shortcodes**
			* **are_related_books_enabled**. Checks if the related book checkbox is enabled.
			* **print_related_content($type)**. Depending on the type you pass one parameter or another, print related content.
			* **print_related_books** is a shortcode that print the information of related book.
			* **print_links_based** is a shortcode that print the information of the book on which it is based.
			* **info_field**.displaying all information of Educational Information metabox.

	* New pending Funcionality: **Widgets**

		* **link_based_widget**
		* **related_widget**
		* **resources_widget**
		* New class:
			* **link_based_widget**
				* New function: **__construct** Create a link based widget.
				* New funcion: **widget** show information widget in front-end.
			* **related_widget**
				* New function: **__construct** Create a related widget.
				* New funcion: **widget** show information widget in front-end.
			* **resources_widget**
				* New function: **__construct** Create a resources widget.
				* New funcion: **widget** show information widget in front-end.
				* New function: **form** create a form in backend.
				* New function: **update** replace old instance with the new information.

	* New sections of PB Metadata setting page:

		*  **resources options**
		*  **isced options**
		*  **related options**
		*  **button option**

	* New functions for new sections:

		* **option_checkbox** creates sections and registers all setting.
		* **RESOURCES_callback** creates the checkboxs in resources section.
		* **related_callback** creates the checkboxs in related section.
		* **button_callback** creates the checkboxs in button section.
		* **show_info_callback** creates the checkboxs in show info section.
		* **resources_in_post_type** knows that checkbox of show info section has ben selected and call **add_resources_metabox($posttype)**.
		* **add_resources_metabox($posttype)** Knows that checkbox of resources section  has been selected and create the metabox and fields in posttype.  
		* **add_related_metabox** knows that checkboxs of related and button section has been selected and create the metabox and fields in Book info and call **add_button_in($posttype)**.
		* **add_button_in($posttype)** creates metabox and fields in posttype.

	* In pressbooks related content class

		* New admin action:**custom_metadata_manager_init_metadata** that call **add_related_metabox**.
		* New admin action:**custom_metadata_manager_init_metadata** that call **resources_in_post_type**.
		* New admin action:**admin_init** calls **options_checkbox**.
		* New admin action:**admin_menu** calls **add_new_option**.

* **ENHANCEMENTS**

	* We replace the call of **print_ in_chapter_r_field** function by shortcode called **are_related_books_enabled**.
	* The **print_chapter_r_fields($cont)** function now receives a parameter that serves to know what information to display.
	* Replace the **add_metadata** functions by others functions in admin class.
	* Documentation

* **List of files revised**

	* includes/class-pressbooks-related-functions.php
	* includes/class-external-content.php
	* includes/class-pressbooks-related-books-metadata.php
	* includes/class-pressbooks-related-functions.php
	* includes/class-pressbooks-related-content.php
	* includes/class-resources_widget.php
	* include/class-related_widget.php
	* înclude/class-link-based_widget.php
	* admin/class-pressbooks-related-contnet-admin.php


## 0.1
* **ADDITIONS**

 	* New  custom metabox called **Resources** with links fields.

		* New multiple field: **video**: Video link
		* New multiple field: **audio**: Audio link
		* New multiple field: **exercises**: Exercises link
		* New multiple field: **activities**: Activities link
		* New multiple field: **bibliography**: Bibliography link
		* New class: **Pb_Rc_Chapter**
			* New function: **add_metadata** : add resources links to Resource metabox in custom post Chapter.
			* New function: **print_chapter_r_fields** creates a table that contains the chapter links and print this in frontend.
			* New function: **get_instance** that return the instance of Pb_Rc_Chapter class.

	* In pressbooks related content class

		* New function:  **define_metadata_changes** creates a instance of Pb_Rc_Chapter and defines all the metaboxes and their fields.
		* New action : **custom_metadata_manager_init_metadata** calls add_metadata function of Pb_Rc_Chapter class.

* **List of files revised**

	* includes/class-external-content.php
	* includes/class-pressbooks-related-content.php





---
[Up](/README.md)
