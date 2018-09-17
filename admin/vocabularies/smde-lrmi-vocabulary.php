<?php
namespace vocabularies;

/**
 * The class for the educational custom vocabulary including operations and metaboxes
 *
 */
class SMDE_Metadata_Educational{

	/**
	 * The type level that identifies where these metaboxes will be created
	 *
	 * @since    0.x
	 * @access   public
	 */
	public $type_level;

	/**
	 * The variable that holds the values from the database for the vocabulary output
	 *
	 * @since    0.x
	 * @access   public
	 */
	public $metadata;

	/**
	 * The variable that holds the group id of the metabox
	 *
	 * @since    0.x
	 * @access   public
	 */
	public $groupId;

	/**
	 * The variable that holds the properties of this vocabulary
	 *
	 * @since    0.x
	 * @access   public
	 */
	public static $lrmi_properties = array(
		//For all the properties on external vocabularies we use the true paramenter
		//We do this because we dont select properties for other vocabularies except from schema
		//Without the true parameter the fields will not render
        /*'educationalType' => array(true,'Educational Metadata Type','Choose the type of data your educational data best describes',
        array('Default'=>'Default',
            'WebPage'=>'WebPage',
            'Article' =>'Article',
            'Chapter' => 'Chapter',
            
        	)),*/
		'iscedField' => array(true,'ISCED field of education','Broad field of education according to ISCED-F 2013.'. '<br><a target="_blank" href="http://alliance4universities.eu/wp-content/uploads/2017/03/ISCED-2013-Fields-of-education.pdf">Click Here for more information</a>',
			array(
				'--Select--'										=> '--Select--',
				'Generic programmes and qualifications' 			=>	'Generic programmes and qualifications',
				'Education' 										=>	'Education',
				'Arts and humanities' 							=> 	'Arts and humanities',
				'Social sciences, journalism and information' 	=> 	'Social sciences, journalism and information',
				'Business, administration and law' 				=> 	'Business, administration and law',
				'Natural sciences, mathematics and statistics' 	=> 	'Natural sciences, mathematics and statistics',
				'Information and Communication Technologies' 		=> 	'Information and Communication Technologies',
				'Engineering, manufacturing and construction' 	=> 	'Engineering, manufacturing and construction',
				'Agriculture, forestry, fisheries and veterinary' => 	'Agriculture, forestry, fisheries and veterinary',
				'Health and welfare' 								=> 	'Health and welfare',
				'Services' 										=> 	'Services',)),
		'iscedLevel'=>array(true,'ISCED level of education','Level of education according to ISCED-P 2011'.'<br><a target="_blank" href="http://www.uis.unesco.org/Education/Documents/isced-2011-en.pdf">Click Here for more information</a>',
			array(
				'' => '--Select--',
				'10' => 'Early Childhood Education',
				'1' => 'Primary education',
				'2' => 'Lower secondary education',
				'3' => 'Upper secondary education',
				'4' => 'Post-secondary non-tertiary education',
				'5' => 'Short-cycle tertiary education',
				'6' => 'Bachelor’s or equivalent level',
				'7' => 'Master’s or equivalent level',
				'8' => 'Doctoral or equivalent level',
				'9' => 'Not elsewhere classified')),
		'typicalAgeRange' => array(true,'Age Range','The target age of this book',
			array('18-' 		=> 	'Adults',
			      '17-18'		=> 	'17-18 years',
			      '16-17' 	=> 	'16-17 years',
			      '15-16' 	=> 	'15-16 years',
			      '14-15' 	=> 	'14-15 years',
			      '13-14' 	=> 	'13-14 years',
			      '12-13' 	=> 	'12-13 years',
			      '11-12' 	=> 	'11-12 years',
			      '10-11' 	=> 	'10-11 years',
			      '9-10'  	=> 	 '9-10 years',
			      '8-9'  		=> 	  '8-9 years',
			      '7-8'  		=> 	  '7-8 years',
			      '6-7'  		=> 	  '6-7 years',
			      '3-5'	  	=> 	  '3-5 years')),
		'eduLevel'=>array(true,'Educational Level','The level of this subject. For ex. B1 for an English Course, or Grade 2 for a Physics Course.'),
		'eduFrame'=>array(true,'Educational Framework','The Framework that the educational level belongs to. Example: CEFR, Common Core, European Baccalaureate'),
		'learningResourceType'=>array(true,'Learning Resource Type','The kind of resource this book represents',
			array('course'	=> 	'Course',
			      'exam'		=> 	'Examination',
			      'exercise'	=> 	'Exercise')),
		'interactivityType'=>array(true,'Interactivity Type','The interactivity type of this book',
			array('expositive'=> 	'Expositive',
			      'mixed' 	=> 	'Mixed',
			      'active' 	=> 	'Active')),
		'timeRequired'=>array(true,'Class Learning Time (hours)','The study time required for the book','number'),
		'eduRole'=>array(true,'Educational Role','An educationalRole of an EducationalAudience.',
			array('Students'	=> 	'Students',
			      'Teachers'  => 	'Teachers')),
		'educationalUse'=>array(true,'Educational Use','The purpose of a work in the context of education; for example, \'assignment\', \'group work\'.'),
		'trgDesc'=>array(true,'Target Description','The description of a node in an established educational framework. <a href="https://ceds.ed.gov/element/001408">Find more here</a>',
			array('General'	      =>'General',
			      'Mobility'      =>'Mobility',
			      'Communication' =>'Communication',
			      'Hearing'       =>'Hearing',
			      'Vision'        =>'Vision')),
		'trgUrl'=>array(true,'Target Url','The URL of a node in an established educational framework. http://example.com')
	);

	public function __construct($typeLevelInput) {

		$this->groupId = 'lrmi_vocab';
		$this->type_level = $typeLevelInput;
		//Removing the EducationalType dropdown form the array because Pressbooks Book Info is a Book By Default
		if($this->type_level == 'metadata'){
		    unset($this->type_properties['educationalType']);
        }
		$this->smde_add_metabox( $this->type_level );
	}

	/**
	 * Function to render fields, which are frozen by admin/network admin
	 */
	public function render_frozen_field ($field_slug, $field, $value) {
		global $post;

		//Getting the origin for overwritten data
        $dataFrom = is_plugin_active('pressbooks/pressbooks.php') ? 'Book-Info' : 'Site-Meta';
      
	    //getting value of post meta
        $meta_value = $label = get_post_meta($post->ID, $field_slug, true);

        $property = explode('_', $field_slug)[1];
        if ($property == 'iscedlevel'){
        	$label = $this->get_isced_level($meta_value);
        }

        foreach (self::$lrmi_properties as $key => $value) {
        	if (strtolower($key) == $property){
        		$property = $value[1];
        	}
        }
		?>
        <hr />
        <p><strong><?=$property?></strong> is overwritten by <?=$dataFrom?>. The value is"<?=$label?>"</p>
        <input type="hidden" name="<?=$field_slug?>" value="<?=$meta_value?>" />
        <hr />
        <?php
	}

	/**
	 * The function which produces the metaboxes for the vocabulary
	 *
	 * @param string Accepting a string so we can distinguish on witch place each metabox is created
	 *
	 * @since 0.x
	 */
	public function smde_add_metabox( $meta_position ) {
		x_add_metadata_group( $this->groupId,$meta_position, array(
			'label' 		=>	'LRMI Metadata',
			'priority' 		=>	'high'
		) );

		foreach ( self::$lrmi_properties as $property => $details ) {

			$callback = null;

			$freezes_lrmi = get_option('smde_lrmi_freezes');
			if ($meta_position != 'site-meta' && $meta_position!= 'metadata' && isset($freezes_lrmi[$property]) && $freezes_lrmi[$property]){
				$callback = 'render_frozen_field';
			}


			$fieldId = strtolower('smde_' . $property . '_' .$this->groupId. '_' .$meta_position);
			//Checking if we need a dropdown field
			if(!isset($details[3])){
					x_add_metadata_field( $fieldId, $meta_position, array(
						'group'       => $this->groupId,
						'label'       => $details[1],
						'description' => $details[2],
						'display_callback' => array($this, $callback)
					) );

			}else {
				if ( $details[3] == 'number' ) {
						x_add_metadata_field( $fieldId, $meta_position, array(
							'group'            => $this->groupId,
							'field_type'       => 'number',
							'label'            => $details[1],
							'description'      => $details[2],
							'display_callback' => array($this, $callback)
						) );
				} else {
						x_add_metadata_field( $fieldId, $meta_position, array(
							'group'            => $this->groupId,
							'field_type'       => 'select',
							'values'           => $details[3],
							'label'            => $details[1],
							'description'      => $details[2],
							'display_callback' => array($this, $callback)
						) );
				}
			}
		}
	}

	/**
	 * A function needed for the array of metadata that comes from each post site-meta cpt or chapter
	 * It automatically returns the first item in the array.
	 * @since 0.x
	 *
	 */
	private function smde_get_first( $my_array ) {
		if ( $my_array == '' ) {
			return '';
		} else {
			return $my_array[0];
		}
	}

	/**
	 * Gets the value for the microtags from $this->metadata.
	 *
	 * @since    0.x
	 * @access   public
	 */
	private function smde_get_value( $propName ) {
		$array = isset( $this->metadata[ $propName ] ) ? $this->metadata[ $propName ] : '';
		if ( $this->type_level != 'metadata' ) {
			$value = $this->smde_get_first( $array );
		} else {
			//We always use the get_first function except if our level is metadata coming from pressbooks
			$value = $array;
		}

		return $value;
	}

	/**
	 * Gets the value from isced using the level.
	 *
	 * @since    0.x
	 * @access   private
	 */
	private function get_isced_level($level){
		$isced_level_data = array(
			''  => '--Select--',
			'10' => 'Early Childhood Education',
			'1' => 'Primary education',
			'2' => 'Lower secondary education',
			'3' => 'Upper secondary education',
			'4' => 'Post-secondary non-tertiary education',
			'5' => 'Short-cycle tertiary education',
			'6' => 'Bachelor’s or equivalent level',
			'7' => 'Master’s or equivalent level',
			'8' => 'Doctoral or equivalent level',
			'9' => 'Not elsewhere classified');
		return $isced_level_data[$level];
	}


	/**
	 * A function that returns all the metadata from the site_meta cpt
	 * This is like when we use pressbooks to gather all data from Book Info
	 * We are always working on a single post -- automatic
	 * This function will be mostly used when the plugin is on wordpress mode and not on pressbooks mode.
	 */
	public static function get_site_meta_metadata(){
		$args = array(
			'post_type' => 'site-meta',
			'posts_per_page' => 1,
			'post_status' => 'publish',
			'orderby' => 'modified',
			'no_found_rows' => true,
			'cache_results' => true,
		);

		$q = new \WP_Query();
		$results = $q->query( $args );

		if ( empty( $results ) ) {
			return false;
		}

		return get_post_meta( $results[0]->ID );
	}

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
        $html  = "<!-- Educational Microtags -->\n";
      
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
        } elseif($this->type_level == 'page') {
        	$val = 'WebPage';
        } else {
        	$val = get_option('smd_website_blog_type') ?: 'WebSite';
        }

        $html .= '<div itemscope itemtype="http://schema.org/'.$val.'">';
        $html .= smd_get_general_tags($val);

		$partTwoMetadata = null;

		foreach ( self::$lrmi_properties as $key => $desc ) {
			//Constructing the key for the data
			//Add strtolower in all vocabs remember
			$dataKey = strtolower('smde_' . $key . '_' . $this->groupId .'_'. $this->type_level);
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
		if ( isset($partTwoMetadata['iscedField']) ) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n"
			         ."	<meta itemprop = 'educationalFramework' content = 'ISCED-2013'/>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$partTwoMetadata['iscedField']. "'>\n"
			         ."</span>\n";
		}
		if ( isset($partTwoMetadata['iscedLevel']) && !empty($partTwoMetadata['iscedLevel']) ) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalLevel'/>\n"
			         ."	<meta itemprop = 'educationalFramework' content = 'ISCED-2011'/>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$this->get_isced_level($partTwoMetadata['iscedLevel']). "'>\n"
			         ."	<meta itemprop = 'alternateName' content = 'ISCED 2011, Level  " .$partTwoMetadata['iscedLevel']. "' />"
			         ."</span>\n";
		}

		if ( isset( $partTwoMetadata['eduLevel'] ) && isset( $partTwoMetadata['eduFrame'] )) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n"
			         ."	<meta itemprop = 'educationalFramework' content = '" .$partTwoMetadata['eduFrame']. "'>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$partTwoMetadata['eduLevel']. "'>\n"
			         ."</span>\n";

		} elseif ( isset( $partTwoMetadata['eduLevel'] ) && !isset( $partTwoMetadata['eduFrame'] )) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalLevel'/>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$partTwoMetadata['eduLevel']. "'>\n"
			         ."</span>\n";
		}

		if(isset( $partTwoMetadata['trgUrl'] ) || isset( $partTwoMetadata['trgDesc'] )){
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalLevel'/>\n";
			if(isset( $partTwoMetadata['trgUrl'] )){
				$html .= "	<link itemprop='targetUrl' href='".$partTwoMetadata['trgUrl']."' />\n";
			}
			if(isset( $partTwoMetadata['trgDesc'] )){
				$html .= "	<link itemprop='targetDescription' content='".$partTwoMetadata['trgDesc']."' />\n";
			}
			$html .= "</span>\n";
		}

		if(isset( $partTwoMetadata['eduRole'] )){
			$html .= "<span itemprop = 'audience' itemscope itemtype = 'http://schema.org/EducationalAudience'>\n"
			         ."	<meta itemprop = 'educationalRole' content = '$partTwoMetadata[eduRole]'/>\n"
			         ."</span>\n";
		}

		if($this->type_level != 'metadata'){
            $html .= "</div>\n <!-- END OF EDUCATIONAL MICROTAGS-->";
        }
		echo $html;
	}
}