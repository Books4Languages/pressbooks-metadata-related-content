# Developers Guide

## Creation of new classes for vocabularies

By architecture of the plugin, all vocabularies of Educational metadata should be based on a `SMDE_Metadata_Educational` class. This class belongs to `vocabularies` namespace. So, every class created for specific vocabulary should have `\vocabularies\SMDE_Metadata_Educational` included in their file and extend it, not to be stand-alone class.

`SMDE_Metadata_Educational` is the only class which is responsible for administrations area interactions. All other classes are supposed to only be responsible for printing metatags in front-end. All the information which is needed for creation of metatags should be taken from postmeta, created with `SMDE_Metadata_Educational`.

General structure of new vocabularies class should be following:
1. Public static class property, containing associative array with keys set to current vocabularies properties names and values set to names of properties in LOM (so, the ones created in `SMDE_Metadata_Educational` class).
1. Method for providing metatags markup, which echo's those metatags.

Example file of new class:

---
```
<?php
namespace vocabularies;

use \vocabularies\SMDE_Metadata_Educational;

class SMDE_Metadata_{name_of_vocabulary} extends SMDE_Metadata_Educational {

	

	/**
	 * The variable that holds the relations between {name_of_vocabulary} properties names and LOM
	 *
	 * @since    0.x
	 * @access   public
	 */
	public static ${name_of_vocabulary}_properties = array(

      	'{some_property_of_vocabulary}'		=> 'interactivityType',
      	'{another_property_of_vocabulary}'	=> 'learningResourceType',
	);
	

	/**
	 * Function that creates the vocabulary metatags
	 *
	 * @since    0.x
	 * @access   public
	 */
	public function smde_get_metatags() {
		//Getting post meta of site-meta of metadata (Book Info) post
        if($this->type_level == 'metadata' || $this->type_level == 'site-meta'){
            $this->metadata = self::get_site_meta_metadata();
        }else{
            $this->metadata = get_post_meta( get_the_ID() );
        }

		//Keys for looping
		$loop_keys = array(
			//put here all the properties of this vocavulary, which do not require specific markup like <meta itemprop="" content="">
		);

		//initializing variable for schema type string
		$val = '';

        //Starting point of educational schema part 1
        $html  = "\n<!-- {name_of_vocabulary} Microtags -->\n";

    //this variable will hold properties, which require specific markup
		$partTwoMetadata = null;

		//going through all properties of class and ones, which don't require specific markup
		foreach ( self::${name_of_vocabulary}_properties as $key => $desc ) {
			//Constructing the key for the data
			//Add strtolower in all vocabs remember
			$dataKey = strtolower('smde_' . $desc . '_' . $this->groupId .'_'. $this->type_level);
			//Getting the data
			$val = $this->smde_get_value($dataKey);
			
			//Checking if the value exists and that the key is in the array for the schema
			if(empty($val) || $val == '--Select--'){
				continue;
			}else{
				if(in_array($key,$loop_keys)){ // checking only for proerties which don't require specific markup
					$html .= "<meta itemprop = '" . $key . "' content = '" . $val . "'>\n";
				}else{ // adding properties, which require specific markup
					$partTwoMetadata[$key] = $val;
				}
			}
		}
		//Ending schema part 1

		//Starting point of educational schema part 2
		//here you create a code, which will provide markup for properties in $partTwoMetadata

        $html .= "<!-- END OF {name_of_vocabulary} MICROTAGS-->\n";
		echo $html;
	}
}
```
---

## Settings

With the creation of classes for new vocabularies, it will be required to add option either to use or not to use this vocabulary in front-end markup (by now LRMI was the only vocabulary, no option was created for it and no metabox to pick it up, so it also should be created in plugin settings page). In `smde-output.php` file it will be required to check which vocabularies are active and, basing on this, then call printing methods of corresponding classes. 
