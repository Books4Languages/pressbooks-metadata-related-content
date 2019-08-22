<?php

/**
 * EducationaL Metadata
 *
 * Educational related vocabularies:
 * Interactivity type;
 * Learning resource type;
 * Interactivity level; Semantic Density; Intended End User Role;
 * Context; Typical age range; dificulty; Typical learning time;
 * Description; Language.
 *
 * @link URL
 * @see documentation
 *
 * @package simple-metadata-education
 * @subpackage classes
 * @since x.x.x (when the file was introduced)
 */

namespace vocabularies;

// This class is used by LMRI functions
use \vocabularies\SMDE_Metadata_Classification as class_meta;

/**
 * The base class for the educational custom vocabulary including operations and metaboxes.
 * Include educational vocabulary and LMRI
 * LMRI uses some metadata from SMDE_Metadata_Classification too
 *
 */
class SMDE_Metadata_Educational{

  /**
	 * The type level that identifies where these metaboxes will be created
	 * It can be for example site_page, page, post ecc...
   *
	 * @since    0.x
	 * @access   public
   */
  public $type_level;

  /**
   * Holds the values from the database for the vocabulary output
   *
   * @since    0.x
   * @access   public
   */
  public $metadata;

  /**
   * Holds the group id of the metabox
   *
   * @since    0.x
   * @access   public
   */
  public $groupId;

  /**
   * Properties from LRMI
	 * The variable that holds the relations between LRMI properties names and LOM
	 *
	 * @since    0.x
	 * @access   public
	 */
  public static $lrmi_properties = array(
    'learningResourceType'=> 'learningResourceType',
    'educationalUse'	   	=> 'educationalUse',
    'educationalRole'		  => 'endUserRole',
    'typicalAgeRange' 		=> 'typicalAgeRange',
    'interactivityType'		=> 'interactivityType',
    'timeRequired'		   	=> 'typicalLearningTime'
	);

  /**
	 * The variable that holds all educational properties
	 *
	 * @since    0.x
	 * @access   public
	 */
  public static $edu_properties = array(

		'learningResourceType'	 		=>	array ( 'Learning Resource Type','Specific kind of learning object (Activities, Articles, Assignments, courses, examinations...). The most dominant kind shall be first.',
			array ( '' 			=> '--Select--',
        'activity'				  =>	'Activity',
        'assessment'			  =>	'Assessment',
        'audio'             =>	'Audio',
        'broadcast'			    =>	'Broadcast',
        'calculator'        =>	'Calculator',
        'discussion'        =>	'Discussion',
        'e-Mail'            =>	'E-Mail',
        'field Trip'        =>	'Field Trip',
        'hands-on'				  =>	'Hands-on',
        'in-Person/Speaker'	=>	'In-Person/Speaker',
        'kinesthetic'				=>	'Kinesthetic',
        'lab Material'			=>	'Lab Material',
        'lesson Plan'				=>	'Lesson Plan',
        'manipulative'			=>	'Manipulative',
        'mBL'				        =>	'MBL',
        'model'				      =>	'Model',
        'on-Line'				    =>	'On-Line',
        'podcast'   				=>	'Podcast',
        'presentation' 			=>	'Presentation',
        'printed'			    	=>	'Printed',
        'quiz'				      =>	'Quiz',
        'robotics'		   		=>	'Robotics',
        'still Image'				=>	'Still Image',
        'test'			       	=>	'Test',
        'video'			      	=>	'Video',
        'wiki'			       	=>	'Wiki',
        'worksheet'			  	=>	'Worksheet')
      ),
      'educationalUse'			=> array( 'Educational Use', 'The purpose of a work in the context of education.',
  			array(	'' 			=> '--Select--',
          'activity'				      =>	'Activity',
          'analogies'			      	=>	'Analogies',
          'assessment'		    		=>	'Assessment',
          'auditory'			       	=>	'Auditory',
          'brainstorming'	  			=>	'Brainstorming',
          'classifying'	    			=>	'Classifying',
          'comparing'		       		=>	'Comparing',
          'cooperative learning'	=>	'Cooperative Learning',
          'creative response'			=>	'Creative Response',
          'demonstration'				  =>	'Demonstration',
          'differentiation'				=>	'Differentiation',
          'discovery learning'		=>	'Discovery Learning',
          'discussion/debate'			=>	'Discussion/Debate',
          'drill & practice'			=>	'Drill & Practice',
          'experiential'			   	=>	'Experiential',
          'field trip'				    =>	'Field Trip',
          'game'				          =>	'Game',
          'generating hypotheses'	=>	'Generating hypotheses',
          'guided questions'			=>	'Guided questions',
          'hands-on'				      =>	'Hands-on',
          'homework'				      =>	'Homework',
          'identify similarities & differences'=>	'Identify similarities & differences',
          'inquiry'				        =>	'Inquiry',
          'interactive'				    =>	'Interactive',
          'interview/Survey'			=>	'Interview/Survey',
          'interviews'				    =>	'Interviews',
          'introduction'				  =>	'Introduction',
          'journaling'				    =>	'Journaling',
          'kinesthetic'				    =>	'Kinesthetic',
          'laboratory'				    =>	'Laboratory',
          'lecture'				        =>	'Lecture',
          'metaphors'				      =>	'Metaphors',
          'model & simulation'		=>	'Model & Simulation',
          'musical'				        =>	'Musical',
          'monlinguistic'				  =>	'Nonlinguistic',
          'mote taking'				    =>	'Note taking',
          'peer coaching'				  =>	'Peer Coaching',
          'peer response'				  =>	'Peer Response',
          'play'				          =>	'Play',
          'presentation'				  =>	'Presentation',
          'problem Solving'				=>	'Problem Solving',
          'problem-based'				  =>	'Problem-based',
          'project'				        =>	'Project',
          'questioning'				    =>	'Questioning',
          'reading'				        =>	'Reading',
          'reciprocal teaching'		=>	'Reciprocal teaching',
          'reflection'				    =>	'Reflection',
          'reinforcement'				  =>	'Reinforcement',
          'research'			        =>	'Research',
          'review'				        =>	'Review',
          'role Playing'				  =>	'Role Playing',
          'service learning'			=>	'Service learning',
          'simulations'				    =>	'Simulations',
          'summarizing'				    =>	'Summarizing',
          'technology'				    =>	'Technology',
          'testing hypotheses'		=>	'Testing hypotheses',
          'thematic instruction'	=>	'Thematic instruction',
          'visual/Spatial'				=>	'Visual/Spatial',
          'word association'			=>	'Word association',
          'writing'				        =>	'Writing'
        )),
  	 	'endUserRole'		 	    	=> array ( 'Intended End User Role', 'Principal user(s) for which this learning object was designed.',
  			array ( '' 			=> '--Select--',
          'administrator'		=>	'Administrator',
          'mentor'				  =>	'Mentor',
          'parent'				  =>	'Parent',
          'peer Tutor'			=>	'Peer Tutor',
          'specialist'			=>	'Specialist',
          'student'				  =>	'Student',
          'teacher'				  =>	'Teacher',
          'team'				    =>	'Team',
          'principal'			  =>	'Principal')),
      'typicalAgeRange'	=> array ( 'Age Range','Age of the typical intended user.',
  			array ( '' 		=> '--Select--',
          '0-2'				=>	'0-2 years',
          '2-5'				=>	'2-5 years',
          '5-8'				=>	'5-8 years',
          '8-10'			=>	'8-10 years',
          '10-12'			=>	'10-12 years',
          '12-14'			=>	'12-14 years',
          '14-16'			=>	'14-16 years',
          '16-18'			=>	'16-18 years',
          '18+'				=>	'18+ years')),
  		'interactivityType' 	 		=> array ( 'Interactivity Type','Predominant mode of learning supported by this learning object.',
  			array ( '' 			=> '--Select--',
          'active' 	   	=> 'Active',
  				'expositive' 	=> 'Expositive',
  			  'mixed'	 	   	=> 'Mixed')),
  		'interactivityLevel' 	 	=> array ( 'Interactivity Level', 'The degree of interactivity characterizing this learning object.',
  			array ( '' 		=> '--Select--',
  				'very low'	 	=> 'Very Low',
  			  'low'		    	=> 'Low',
  			  'medium'    	=> 'Medium',
  			 	'high'		  	=> 'High',
  		   	'very high'	 	=> 'Very High')),
    	'difficulty'	=> array ( 'Difficulty', 'How hard it is to work with or through this learning object for the typical intended target audience.',
  			array ( '' 		=> '--Select--',
  				'very easy'	      => 'Very Easy',
  				'easy'	      		=> 'Easy',
  				'medium'	      	=> 'Medium',
  				'difficult'		    => 'Difficult',
  				'very difficult'	=> 'Very Difficult')),
  		'typicalLearningTime' 	=> array ( 'Class Learning Time (hours)','Approximate or typical time it takes to work with or through this learning object for the typical intended target audience.', 'number'),
  		'description' 		=> array ( 'Description', 'Comments on how this learning object is to be used.')
  	);

/**
 * Constructing method, only defined here as all the vocabularies classes are only responsible for creation of tags
 */
  public function __construct($typeLevelInput) {
		$this->groupId = 'edu_vocabs';
		$this->type_level = $typeLevelInput;
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

    //gettign porperty name from field name
    $property = explode('_', $field_slug)[1];

    //getting label of this property
    foreach (self::$edu_properties as $key => $value) {
    	if (strtolower($key) == $property){
    		$property = $value[0];
    	}
    }
	?>
      <p><strong><?=$property?></strong> is overwritten by <?=$dataFrom?>. The value is"<?=$label?>"</p>
      <input type="hidden" name="<?=$field_slug?>" value="<?=$meta_value?>" />
      <?php
  }

  /**
   * Function to render fields, which are disabled by admin/network admin
   *
   * @since
   *
   */
  public function render_disable_field ($field_slug, $field, $value) {
    global $post;

    //Getting the origin for overwritten data
        $dataFrom = is_plugin_active('pressbooks/pressbooks.php') ? 'Book-Info' : 'Site-Meta';

      //getting value of post meta
        $meta_value = $label = get_post_meta($post->ID, $field_slug, true);

        //gettign porperty name from field name
        $property = explode('_', $field_slug)[1];

        //getting label of this property
        foreach (self::$edu_properties as $key => $value) {
          if (strtolower($key) == $property){
            $property = $value[0];
          }
        }
    ?>
        <p> </p>
        <?php
  }

  /**
   * The function which produces the metaboxes for the vocabulary
   *
   * @param string Accepting a string so we can distinguish on witch place each metabox is created (site_page, page, post...)
   *
   * @since 0.x
   */
  public function smde_add_metabox( $meta_position ) {
 		//adding metabox to desired location
 		x_add_metadata_group( $this->groupId, $meta_position, array(
 			'label'   	=>	'Educational Metadata',
 			'priority'  =>	'high'
 		) );

 		//adding metafields for every property in this class
 		foreach ( self::$edu_properties as $property => $details ) {

 			$callback = null;
      $freezes_edu = [];
      $disable_edu = [];
 			//retrieving names of prtoperties, which are frozen
 			$freezesS_edu = get_option('smde_edu_');
      foreach ((array) $freezesS_edu as $key => $value) {
				if ($value=='3') {
					$freezes_edu[$key] = '1';
				}
				if ($value=='1') {
					$disable_edu[$key] = '1';
				}
			}
 			//if property is frozen, we render it as frozen
 			if ($meta_position != 'site-meta' && $meta_position!= 'metadata' && isset($freezes_edu[$property]) && $freezes_edu[$property]){
 				$callback = 'render_frozen_field';
 			}

      if ($meta_position != 'site-meta' && $meta_position!= 'metadata' && isset($disable_edu[$property]) && $disable_edu[$property]){
        $callback = 'render_disable_field';
      }

 			//constructing name of field
 			$fieldId = strtolower('smde_' . $property . '_' .$this->groupId. '_' .$meta_position);

 			//Checking if we need a dropdown field, or number selector
 			if(!isset($details[2])){
 				if ('description' != $property){
 					x_add_metadata_field( $fieldId, $meta_position, array(
 						'group'       => $this->groupId,
 						'label'       => $details[0],
 						'description' => $details[1],
 						'display_callback' => array($this, $callback)
 					) );
 				} elseif (!post_type_supports($meta_position, 'excerpt')){
 					x_add_metadata_field( $fieldId, $meta_position, array(
 						'group'            => $this->groupId,
 						'field_type'       => 'textarea',
 						'label'            => $details[0],
 						'description'      => $details[1],
 						'display_callback' => array($this, $callback)
 					) );
 				}

 			}else {
 				if ( $details[2] == 'number' ) {
 						x_add_metadata_field( $fieldId, $meta_position, array(
 							'group'            => $this->groupId,
 							'field_type'       => 'number',
 							'label'            => $details[0],
 							'description'      => $details[1],
 							'display_callback' => array($this, $callback)
 						) );
 				} else {
 						x_add_metadata_field( $fieldId, $meta_position, array(
 							'group'            => $this->groupId,
 							'field_type'       => 'select',
 							'values'           => $details[2],
 							'label'            => $details[0],
 							'description'      => $details[1],
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
  protected function smde_get_first( $my_array ) {
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
  protected function smde_get_value( $propName ) {
		$array = isset( $this->metadata[ $propName ] ) ? $this->metadata[ $propName ] : '';

		$value = $this->smde_get_first( $array );


		return $value;
	}

  /**
	 * A function that returns all the metadata from the site_meta cpt
	 * This is like when we use pressbooks to gather all data from Book Info
	 * We are always working on a single post -- automatic
	 * This function will be mostly used when the plugin is on wordpress mode and not on pressbooks mode.
	 */
  public static function get_site_meta_metadata(){
		$post_type = is_plugin_active ('pressbooks/pressbooks.php') ? 'metadata' : 'site-meta';
		$args = array(
			'post_type'      => $post_type,
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'orderby'        => 'modified',
			'no_found_rows'  => true,
			'cache_results'  => true,
		);

		$q = new \WP_Query();
		$results = $q->query( $args );

		if ( empty( $results ) ) {
			return false;
		}

		return get_post_meta( $results[0]->ID );
	}

  /**------- LMRI ZONE -------- **/
  /**
   * Function that creates the vocabulary metatags
   * Prints the LMRI metatags in the html
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
      'learningResourceType',
      'educationalUse',
      'typicalAgeRange',
      'interactivityType',
      'timeRequired'
    );

    //initializing variable for schema type string
    $val = '';

        //Starting point of educational schema part 1

    $partTwoMetadata = null;
    $html = ",";
    //going through all properties of class and ones, which don't require specific markup
    foreach ( self::$lrmi_properties as $key => $desc ) {
      //Constructing the key for the data
      //Add strtolower in all vocabs remember
      $dataKey = strtolower('smde_' . $desc . '_' . $this->groupId .'_'. $this->type_level);
      //Getting the data from db
      $val = $this->smde_get_value($dataKey);

      //Checking if the value exists and that the key is in the array for the schema
      if(empty($val) || $val == '--Select--'){
        continue;
      }else{
        if(in_array($key,$loop_keys)){ // checking only for proerties which don't require specific markup
          //if the schema is timeRequired, we are using a specific format to display it,
          //like the example here: https://schema.org/timeRequired
          if ( 'timeRequired' == $key ) {
            $val = 'PT'. $val.'H';
          }
          $html .= ',' == $html[-1] ? "\n\t" : ",\n\t"; //adds identation and new paragraph
          $html .= '"'.$key.'": "'.$val.'"';
        }else{
          $partTwoMetadata[$key] = $val;
        }
      }
    }
    //Ending schema part 1

    //Starting point of educational schema part 2

    //Educational Use
    if(isset( $partTwoMetadata['educationalRole'] )){
      $html .= ',' == $html[-1] ? "\n\t" : ",\n\t";
      $html .='"audience":  {
        "@type":  "EducationalAudience",
        "educationalRole":  "'.$partTwoMetadata['educationalRole'].'"
      }';
    }

    $html = strcmp(",", $html) == 0 ?  "" : $html ;
    //initilizing instance of classification vocabulary class and calling its method for prinitng metatags
    $class_meta = new class_meta($this->type_level);
    if (is_multisite() && get_site_option('smde_net_for_lang')){
      //adds to the html to print the metatags_lang from class_meta
      $html .= $class_meta->smde_get_metatags_lang();
    } else {
      //adds to the html to print the metatags from class_meta
      $html .= $class_meta->smde_get_metatags();
    }


    echo $html;
  }

}

?>
