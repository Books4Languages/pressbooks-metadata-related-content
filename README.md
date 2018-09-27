## Simple Metadata Education

Contributors: @colomet, @danzhik

Tags: pressbooks, links, metadata, education

Tested up to: [![WordPress](https://img.shields.io/wordpress/v/akismet.svg)](https://wordpress.org/download/)


Stable tag: [![Current Release](https://img.shields.io/github/release/my-language-skills/simple-metadata-education.svg)](https://github.com/my-language-skills/simple-metadata-education/releases/latest/)

License:  [![License](https://img.shields.io/badge/license-GPL--3.0%2B-red.svg)](https://github.com/my-language-skills/simple-metadata-education/blob/master/license.txt)

License URI: http://www.gnu.org/licenses/gpl-3.0.html

## Description  
Simple Metadata Education plugin is add-on for (Simple Metadata)[https://github.com/my-language-skills/simple-metadata/] plugin, aimed for educational purposes. With use of this plugin you will be able to provide relevant information on your educational content, following commonly accepted standards of educational metadata, like LRMI, LOM (coming soon) and Dublin Core (coming soon). 

## Installation
1. Clone (or copy) this repository to the /wp-content/plugins/ directory.
2. Activate the plugin through the  'Plugins' screen in WordPress.

## Frequently Asked Questions
1. If i don't need to use all the fields of the plugin, can i leave them empty? Yes, you can leaves them empty. If one field is empty the link will not appear in the frontend.

## Requirements
Plugin works with:

- ![PHP](https://img.shields.io/badge/PHP-7.2.X-blue.svg)
- ![WordPress](https://img.shields.io/badge/WordPress-4.9.8-blue.svg)



http://www2.cs.arizona.edu/~collberg/Teaching/07.231/BibTeX/bibtex.html


## Disclaimers
The Simple Metadata Education plugin is supplied "as is" and all use is at your own risk.

## Screenshots

## Roadmap


## Changelog
### 1.0
* **Additions**
  * **Types**
   * Book type
   * Course type
  
  * **Properties**
    * **Education**
    
      * **LOM** (not functional yet, just information storage)
        * Interactivity Type
        * Learning Resource Type
        * Interactivity level
        * Intended End User Role
        * Context
        * Typical Age Range
        * Difficulty
        * Typical Learning Time (in hours)
        * Description (only in post types, which don't support excertps)
      * **LRMI** (data for metatags content is taken from LOM storage)
        * Interactivity Type
        * Learning Resource Type
        * Educational Audience
        * Educational Use
        * Typical Age Range
        * Time Required (in hours)
    
    * **Classification**
      * ISCED Level of Education
      * Educational Framework
      * ISCED Field of Education
      * Educational Level
      * Additional Classification
  
  * **Administration**
   * **Settings**
      * **Network settings** (uses Simple-Metadata network settings page)
        * Post types active for Educational Metadata and CLassification Metadata (show/not show metatags in web-pages code and metaboxes to fill in information)
        * Overwriting of properties (Freeze)
        * Seeding properties values (Share, affects only if desired field is empty in active post level)
        * Language Education Mode (on/off)
        
      *Network settings overwrite all site settings and block ability to change them!*
      * **Site Settings**
        * **Simple Metadata Settings Page**
          * Post types active for Educational Metadata and CLassification Metadata (show/not show metatags in web-pages code and metaboxes to fill in information)
        * **Educational Metadata Settings** (subpage under Simple Metadata Settings)  
          * Overwriting of properties (Freeze)
          * Seeding properties values (Share, affects only if desired field is empty in active post level)
          
      *If overwriting for some property is activated, seeding is also marked active in order to avoid misunderstanding for user*
        * **Site Meta**
          This is a place where you enter metadata infromation, which will be shown in front-page of a site.
          
      *Overwriting and seeding applies information, stored in Site-Meta/Book Info to all active post types*
      

## Upgrade Notice
### 0.2
To use the last version of the plugin.
### 0.1
To use the first version of the plugin.


## Credits
Here's a link to [WordPress Plugin Boilerplate](http://wppb.io/).

Here's a link to [WordPress](https://wordpress.org/)

Here's a llink to [PressBooks](https://pressbooks.org/get-involved/)

Here's a link to [Pandao](https://pandao.github.io/editor.md/en.html)

Here's a link to [Markdown's Syntax Documentation](https://daringfireball.net/projects/markdown/syntax)

---
[Up](/README.md)
