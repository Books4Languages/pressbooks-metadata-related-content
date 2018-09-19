<?php
namespace vocabularies;

use \vocabularies\SMDE_Metadata_Educational;
use \vocabularies\SMDE_Metadata_Classification as class_meta;

/**
 * The class for the educational custom vocabulary including operations and metaboxes
 *
 */
class SMDE_Metadata_Lrmi extends SMDE_Metadata_Educational {

	

	/**
	 * The variable that holds the relations between LRMI properties names and LOM
	 *
	 * @since    0.x
	 * @access   public
	 */
	public static $lrmi_properties = array(

      	'interactivityType'		=> 'interactivityType',
      	'learningResourceType'	=> 'learningResourceType',
		'educationalRole'		=> 'endUserRole',
		'educationalUse'		=> 'interactivityType',
		'typicalAgeRange' 		=> 'typicalAgeRange',
		'timeRequired'			=> 'typicalLearningTime'
	);
	

	/**
	 * Function that creates the vocabulary metatags
	 *
	 * @since    0.x
	 * @access   public
	 */
	public function smde_get_metatags() {
		//Getting the information from the database
        if($this->type_level == 'metadata' || $this->type_level == 'site-meta'){
        	if (!is_plugin_active ('pressbooks/pressbooks.php')){
            	$this->metadata = self::get_site_meta_metadata();
        	} else {
        		$this->metadata = \Pressbooks\Book::getBookInformation();
        	}
        }else{
            $this->metadata = get_post_meta( get_the_ID() );
        }

		//Keys for looping
		$loop_keys = array(
			'typicalAgeRange',
			'learningResourceType',
			'interactivityType',
			'timeRequired',
			'educationalUse'
		);

		//initializing variable for schema type string
		$val = '';

        //Starting point of educational schema part 1
        $html  = "<!-- LRMI Microtags -->\n";
      
        if($this->type_level != 'metadata' && $this->type_level != 'site-meta'){
        	//checking if type for this pages was selected from metabox
        	if ($this->type_level == 'post'){
        		$val = esc_attr(get_post_meta (get_the_ID(), 'smd_post_type', true));
        	} elseif ($this->type_level == 'page') {
        		$val = esc_attr(get_post_meta (get_the_ID(), 'smd_page_type', true));
        	}
        	//if nothing was set, select depending on type of website
        	if(!$val && $this->type_level != 'page'){
            	//Getting the data
            	//In case of pressbooks installation, always applied Book -> Chapter
            	if (!is_plugin_active('pressbooks/pressbooks.php')){
            		$val = get_option('smd_website_blog_type');
            	} else {
            		$val = 'Book';
            	}
            	switch ($val){
            	    case 'Blog':
            	    	if ($this->type_level == 'post'){
            	    		$val = 'BlogPosting';
            	    	}
            	    	break;
            	    case 'Course':
            	    	$val = 'Article';
            	    	break;
            	    case 'Book':
            	    	$val = 'Chapter';
            	        break;
            	    case 'WebSite':
            	        $val = 'WebPage';
            	        break;
 					default:
 						$val = 'WebPage';
 						break;
            	}
        	}
        } elseif($this->type_level == 'metadata') {
        	$val = 'Book';
        } else {
        	$val = get_option('smd_website_blog_type') ?: 'WebSite';
        }

        $html .= '<div itemscope itemtype="http://schema.org/'.$val.'">';
        $html .= smd_get_general_tags($val);

		$partTwoMetadata = null;

		foreach ( self::$lrmi_properties as $key => $desc ) {
			//Constructing the key for the data
			//Add strtolower in all vocabs remember
			$dataKey = strtolower('smde_' . $desc . '_' . $this->groupId .'_'. $this->type_level);
			//Getting the data
			$val = $this->smde_get_value($dataKey);
			//Checking if the value exists and that the key is in the array for the schema
			if(empty($val) || $val == '--Select--'){
				continue;
			}else{
				if(in_array($key,$loop_keys)){
					//if the schema is timeRequired, we are using a specific format to display it,
					//like the example here: https://schema.org/timeRequired
					if ( 'timeRequired' == $key ) {
						$val = 'PT'. $val.'H';
					}
					$html .= "<meta itemprop = '" . $key . "' content = '" . $val . "'>\n";
				}else{
					$partTwoMetadata[$key] = $val;
				}
			}
		}
		//Ending schema part 1

		//Starting point of educational schema part 2
		if ( isset( $this->metadata['pb_title'] ) ) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$this->metadata['pb_title']. "'>\n"
			         ."</span>\n";
		}

		if(isset( $partTwoMetadata['educationalRole'] )){
			$html .= "<span itemprop = 'audience' itemscope itemtype = 'http://schema.org/EducationalAudience'>\n"
			         ."	<meta itemprop = 'educationalRole' content = '$partTwoMetadata[educationalRole]'/>\n"
			         ."</span>\n";
		}

		$class_meta = new class_meta($this->type_level);
		$html .= $class_meta->smde_get_metatags();

        $html .= "</div>\n <!-- END OF EDUCATIONAL MICROTAGS-->";
		echo $html;
	}
}