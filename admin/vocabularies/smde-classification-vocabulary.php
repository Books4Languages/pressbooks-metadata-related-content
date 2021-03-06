<?php

/**
 * Summary (no period for file headers)
 *
 * Description. (use period)
 *
 * @link URL
 *
 * @package simple-metadata-education
 * @subpackage classes
 * @since 1.0
 */

namespace vocabularies;

/**
 * The class for the educational custom vocabulary including operations and metaboxes
 *
 */
class SMDE_Metadata_Classification{

	/**
	 * The type level that identifies where these metaboxes will be created
	 *
	 * @since    1.0
	 * @access   public
	 */
	public $type_level;

	/**
	 * The variable that holds the values from the database for the vocabulary output
	 *
	 * @since    1.0
	 * @access   public
	 */
	public $metadata;

	/**
	 * The variable that holds the group id of the metabox
	 *
	 * @since    1.0
	 * @access   public
	 */
	public $groupId;

	/**
	 * Holds all the classification properties
	 *
	 * @since    1.0
	 * @access   public
	 */
	public static $classification_properties_main = array(

        'iscedLevel'=>array( 'ISCED level of education','Level of education according to ISCED-P 2011'.'<br><a target="_blank" href="http://uis.unesco.org/en/topic/international-standard-classification-education-isced">Click Here for more information</a>',
			array(
				'' => '--Select--',
				'10' => 'Early Childhood Education',
			 	'1'  => 'Primary education',
				'2'  => 'Lower secondary education',
				'3'  => 'Upper secondary education',
				'4'  => 'Post-secondary non-tertiary education',
				'5'  => 'Short-cycle tertiary education',
				'6'  => 'Bachelor’s or equivalent level',
				'7'  => 'Master’s or equivalent level',
				'8'  => 'Doctoral or equivalent level',
				'9'  => 'Not elsewhere classified')),
		'eduLevel'				=> array( 'Educational Level','The level of this subject. For ex. B1 for an English Course, or Grade 2 for a Physics Course.'),
    'eduFrame'=>array( 'Educational Framework','The Framework that the educational level belongs to. Example: CEFR, Common Core, European Baccalaureate'),
		'iscedField' => array( 'ISCED field of education','Broad field of education according to ISCED-F 2013.'. '<br><a target="_blank" href="http://uis.unesco.org/en/topic/international-standard-classification-education-isced">Click Here for more information</a>',
			array(
				'' => '--Select--',
				'Generic programmes and qualifications'     			=>	'Generic programmes and qualifications',
				'Education' 																			=>	'Education',
				'Arts and humanities' 														=> 	'Arts and humanities',
				'Social sciences, journalism and information' 		=> 	'Social sciences, journalism and information',
				'Business, administration and law' 								=> 	'Business, administration and law',
				'Natural sciences, mathematics and statistics'		=> 	'Natural sciences, mathematics and statistics',
				'Information and Communication Technologies' 			=> 	'Information and Communication Technologies',
				'Engineering, manufacturing and construction' 		=> 	'Engineering, manufacturing and construction',
				'Agriculture, forestry, fisheries and veterinary' => 	'Agriculture, forestry, fisheries and veterinary',
				'Health and welfare' 															=> 	'Health and welfare',
				'Services' 																				=> 	'Services',)),
		'additionalClass' => array( 'Additional Classification', 'More specified subject of current educational level. For ex. \'Grammar\' part of B1 English Course, \'Thermodynamics\' for Grade 7 of Physics Course'),
		'specificClass'	  => array(	'Specific Classification', 'Narrow definition of subject field. For ex. \'Verbs\' in \'Grammar\' materials, \'Thermodynamics Laws\' in Thermodynamics', 'multiple'),
		'eduLang'				=> array( 'Studying content', 'Language which content is about'),
		'complexityLev' => array( 'Complexity Level', 'Defines a level or range that measures the difficulty or challenge presented by the learning resource being described.',
			array(
				'' 					=> '--Select--',
				'Create'  	=> 'Create',
				'Evaluate'  => 'Evaluate',
				'Analyze' 	=> 'Analyze',
				'Apply'  		=> 'Apply',
				'Understand'=> 'Understand',
				'Remember'  => 'Remember')),
		'prerequisite' => array( 'Prerequisite', 'The prerequisite of this content'),
		'eduLevelPrerequisite' => array( 'Educational Level','The level of this subject. For ex. B1 for an English Course, or Grade 2 for a Physics Course.'),
		'additionalClassPrerequisite' => array( 'Additional Classification','More specified subject of current educational level. For ex. \'Grammar\' part of B1 English Course, \'Thermodynamics\' for Grade 7 of Physics Course')
	);

	public function __construct($typeLevelInput) {

		$this->groupId = 'class_vocab';
		$this->type_level = $typeLevelInput;

		if (is_multisite() && get_site_option('smde_net_for_lang')){
			unset(self::$classification_properties_main['eduFrame']);
			unset(self::$classification_properties_main['iscedField']);

			self::$classification_properties_main['eduLevel'] = array( __('Educational Level', 'simple-metadata-education'),__('The level of this subject.', 'simple-metadata-education'),
				array( '' 	=> __('--Select--', 'simple-metadata-education'),
					   'A1' 	=> __('A1', 'simple-metadata-education'),
					   'A2' 	=> __('A2', 'simple-metadata-education'),
					   'B1' 	=> __('B1', 'simple-metadata-education'),
					   'B2' 	=> __('B2', 'simple-metadata-education'),
					   'C1' 	=> __('C1', 'simple-metadata-education'),
					   'C2' 	=> __('C2', 'simple-metadata-education')
				));

			self::$classification_properties_main['additionalClass'] = array( __('Additional Classification', 'simple-metadata-education'),__('More specified subject of current educational level.', 'simple-metadata-education'),
				array( '' 		  	 => __('--Select--', 'simple-metadata-education'),
					   'Culture' 	   => __('Culture', 'simple-metadata-education'),
					   'Grammar'  	 => __('Grammar', 'simple-metadata-education'),
					   'Orthography' => __('Orthography', 'simple-metadata-education'),
					   'Vocabulary'  => __('Vocabulary', 'simple-metadata-education')
				));

			self::$classification_properties_main['iscedLevel'] = array( __('ISCED level of education', 'simple-metadata-education'),__('Level of education according to ISCED-P 2011', 'simple-metadata-education') .'<br><a target="_blank" href="http://www.uis.unesco.org/Education/Documents/isced-2011-en.pdf">' . __('Click Here for more information', 'simple-metadata-education'). '</a>',
				array(
					'10' => __('Early Childhood Education', 'simple-metadata-education'),
					'1'  => __('Primary education', 'simple-metadata-education'),
					'2'  => __('Lower secondary education', 'simple-metadata-education'),
					'3'  => __('Upper secondary education', 'simple-metadata-education'),
					'4'  => __('Post-secondary non-tertiary education', 'simple-metadata-education'),
					'5'  => __('Short-cycle tertiary education', 'simple-metadata-education'),
					'6'  => __('Bachelor’s or equivalent level', 'simple-metadata-education'),
					'7'  => __('Master’s or equivalent level', 'simple-metadata-education'),
					'8'  => __('Doctoral or equivalent level', 'simple-metadata-education'),
					'9'  => __('Not elsewhere classified', 'simple-metadata-education')));

			self::$classification_properties_main['eduLang'] =
			array(__('Studying content', 'simple-metadata-education'),
						__('Language which content is about', 'simple-metadata-education'),
						smd_supported_languages());
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

        //getting property name from name of field
        $property = explode('_', $field_slug)[1];

        //for isced level we obtain readable name corresponding to set numeric value
        if ($property == 'iscedlevel' && !stripos($field_slug, 'url') && !stripos($field_slug, 'desc')){
        	$label = $this->get_isced_level($meta_value);
        }

        //getting label for property
        foreach (self::$classification_properties_main as $key => $value) {

        	if (strtolower($key) == $property && stripos($field_slug, 'desc')){
        		$property = $value[0].' Description';
        		continue;
        	}

        	if (strtolower($key) == $property && stripos($field_slug, 'url')){
        		$property = $value[0].' Url';
        		continue;
        	}

        	if (strtolower($key) == $property){
        		$property = $value[0];
        	}
        }

		?>
        <p>
					<strong><?=$property?></strong><?php printf(esc_html__( ' is overwritten by %s. The value is "%s"', 'simple-metadata-annotation'), $dataFrom, $label);?>
				</p>
        <input type="hidden" name="<?=$field_slug?>" value="<?=$meta_value?>" />
        <?php
	}

	/**
	 * Function to render fields, which are frozen by admin/network admin in languages education (empty string)
	 *
	 * @since	1.0
	 */
	public function render_frozen_field_lang ($field_slug, $field, $value) {
		echo '';
	}


	/**
	 * Function to render fields, which are disabled by admin/network admin
	 *
	 * @since	1.0
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
				foreach (self::$classification_properties_main as $key => $value) {
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
	 * @param string Accepting a string so we can distinguish on witch place each metabox is created
	 *
	 * @since 1.0
	 */
	public function smde_add_metabox( $meta_position ) {

		//adding metabox for calssification properties
		x_add_metadata_group( $this->groupId,$meta_position, array(
			'label' 		=>	__('Classification Metadata', 'simple-metadata-education'),
			'priority' 		=>	'high'
		) );



		//adiing metafields for exery property of this class
		foreach ( self::$classification_properties_main as $property => $details ) {

			$callback = null;
			$freezes_class = [];
			$disable_class = [];
			//retreiving list of frozen properties
			$class_values = get_option('smde_class_');

			foreach ( (array) $class_values as $key => $value) {
				if ($value=='3') {
					$freezes_class[$key] = '1';
				}
				if ($value=='1') {
					$disable_class[$key] = '1';
				}
			}

			//if this property is frozen, we render its metafield correspondingly
			if (isset($freezes_class[$property]) && $freezes_class[$property] && $meta_position != 'site-meta' && $meta_position!= 'metadata' ) {
				if (is_multisite() && get_site_option('smde_net_for_lang')){
					$callback = 'render_frozen_field_lang';
				} else {
					$callback = 'render_frozen_field';
				}
			}

			if (isset($disable_class[$property]) && $disable_class[$property] && $meta_position != 'site-meta' && $meta_position!= 'metadata'){
					$callback = 'render_disable_field';
			}


			//constructing field name
			$fieldId = strtolower('smde_' . $property . '_' .$this->groupId. '_' .$meta_position);

			//Checking if we need a dropdown field or number selector, or if field should have multiple values
			if(!isset($details[2])){
					x_add_metadata_field( $fieldId, $meta_position, array(
						'group'       => $this->groupId,
						'label'       => $details[0],
						'description' => $details[1],
						'display_callback' => array($this, $callback)
					) );
			}else if($property != 'prerequisite') {
				if ( $details[2] == 'number' ) {
						x_add_metadata_field( $fieldId, $meta_position, array(
							'group'            => $this->groupId,
							'field_type'       => 'number',
							'label'            => $details[0],
							'description'      => $details[1],
							'display_callback' => array($this, $callback)
						) );
				}elseif ( $details[2] == 'multiple' ){
					if ('site-meta' != $meta_position && 'metadata' != $meta_position){
						x_add_metadata_field( $fieldId, $meta_position, array(
							'group'            => $this->groupId,
							'multiple'         => true,
							'label'            => $details[0],
							'description'      => $details[1],
							'display_callback' => array($this, $callback)
						) );
					}
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

			$properties_to_skip = ['eduFrame', 'additionalClass', 'specificClass', 'complexityLev', 'prerequisite', 'eduLevelPrerequisite', 'additionalClassPrerequisite'];
			//creating URL and description fields for all levels, except the ones in $propeties_to_skip
			if ( !in_array($property, $properties_to_skip) && ((is_multisite() && !get_site_option('smde_net_for_lang')) || !is_multisite())) {

			  $fieldId = strtolower('smde_' . $property . '_desc_' .$this->groupId. '_' .$meta_position);
				x_add_metadata_field( $fieldId, $meta_position, array(
								'field_type'			   => 'textarea',
								'group'            => $this->groupId,
								'label'            => $details[0].' Description',
								'description'      => 'The description of a node in an established educational framework. <a target="_blank" href="https://ceds.ed.gov/element/001408"> Find more here </a>',
								'display_callback' => array($this, $callback)
							) );

				$fieldId = strtolower('smde_' . $property . '_url_' .$this->groupId. '_' .$meta_position);
				x_add_metadata_field( $fieldId, $meta_position, array(
								'group'            => $this->groupId,
								'label'            => $details[0].' URL',
								'description'      => 'The URL of a node in an established educational framework. http://example.com',
								'placeholder'	   => 'https://www.example.com',
								'display_callback' => array($this, $callback)
							) );
			}

			if( $property == 'prerequisite' ){
				x_add_metadata_field( $fieldId, $meta_position, array(
					'group'            => $this->groupId,
					'display_callback' => array($this, 'smde_render_prerequisite_field')
				) );
			}
		}
	}

	function smde_render_prerequisite_field(){
		?>
		<div class="custom-metadata-field text">
			<hr />
			<label style="font-size:20px;padding:10px 0px"> Prerequisite </label>
		</div>
		<?php
	}

	/**
	 * A function needed for the array of metadata that comes from each post site-meta cpt or chapter
	 * It automatically returns the first item in the array.
	 * @since 1.0
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
	 * @since    1.0
	 * @access   public
	 */
	private function smde_get_value( $propName ) {
		$array = isset( $this->metadata[ $propName ] ) ? $this->metadata[ $propName ] : '';
		//as all properties are singular, except Specific Classification, unwrap their value from array
		if ( !stripos($propName, 'specificClass')) {
			$value = $this->smde_get_first( $array );
		} else {
			//We always use the get_first function except if property is Specific Classification
			$value = $array;
		}

		return $value;
	}

	/**
	 * Gets the value from isced using the level.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function get_isced_level($level){
		$isced_level_data = array(
			''  => __('--Select--', 'simple-metadata-education'),
			'10' => __('Early Childhood Education', 'simple-metadata-education'),
			'1' => __('Primary education', 'simple-metadata-education'),
			'2' => __('Lower secondary education', 'simple-metadata-education'),
			'3' => __('Upper secondary education', 'simple-metadata-education'),
			'4' => __('Post-secondary non-tertiary education', 'simple-metadata-education'),
			'5' => __('Short-cycle tertiary education', 'simple-metadata-education'),
			'6' => __('Bachelor’s or equivalent level', 'simple-metadata-education'),
			'7' => __('Master’s or equivalent level', 'simple-metadata-education'),
			'8' => __('Doctoral or equivalent level', 'simple-metadata-education'),
			'9' => __('Not elsewhere classified', 'simple-metadata-education'));
		return $isced_level_data[$level];
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
			'post_type' => $post_type,
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
	 * Function that creates the vocabulary metatags with language education
	 *
	 * @since		1.0
	 * @since		1.2 metatags to json-ld
	 * @access	public
	 */
public function smde_get_metatags(){
		//Getting post meta of metadata (Book Info) or site-meta post
		if($this->type_level == 'metadata' || $this->type_level == 'site-meta'){
				$this->metadata = self::get_site_meta_metadata();
		} else {
				$this->metadata = get_post_meta( get_the_ID() );
		}

		$cleanCollect = [];

		//going thorugh all properties of this class and putting them into multidimensional array (with url and description)
		foreach ( self::$classification_properties_main as $key => $desc ) {
			//Constructing the key for the data
			//Add strtolower in all vocabs remember
			$dataKey = strtolower('smde_' . $key . '_' . $this->groupId .'_'. $this->type_level);
			$dataKeyDesc = strtolower('smde_' . $key . '_desc_' . $this->groupId .'_'. $this->type_level);
			$dataKeyUrl = strtolower('smde_' . $key . '_url_' . $this->groupId .'_'. $this->type_level);
			//Getting the data
			$val = $this->smde_get_value($dataKey);
			$valDesc = $this->smde_get_value($dataKeyDesc);
			$valUrl = $this->smde_get_value($dataKeyUrl);
			//Checking if the value exists and that the key is in the array for the schema
			if(empty($val) || $val == '--Select--'){
				continue;
			} else {
				$cleanCollect[$key]['val'] = $val;
				if(!empty($valDesc)){
					$cleanCollect[$key]['desc'] = $valDesc;
				}
				if(!empty($valDesc)){
					$cleanCollect[$key]['url'] = $valUrl;
				}
			}
		}

		$metadata = [];
		$alignment_objects = [];

		//ISCED level
		if ( array_key_exists('iscedLevel', $cleanCollect) ){
			$alignment_object = [[
				'@type'									=>  'AlignmentObject',
				'alignmentType'					=>	'educationalLevel',
				'educationalFramework'	=> 	'ISCED-2011',
				'targetName'					 	=> 	$this->get_isced_level($cleanCollect['iscedLevel']['val']),
				'alternateName'					=> 	'ISCED 2011, Level ' . $cleanCollect['iscedLevel']['val'],
				'targetDescription'			=> 	isset($cleanCollect['iscedLevel']['desc'])	? $cleanCollect['iscedLevel']['desc'] : "",
				'targetUrl'							=> 	isset($cleanCollect['iscedLevel']['url'])	?	$cleanCollect['iscedLevel']['url']	: ""
			]];
			$alignment_objects = array_merge($alignment_objects, $alignment_object);
		}

		//Educational level
		if ( array_key_exists( 'eduLevel', $cleanCollect ) && !array_key_exists( 'eduFrame', $cleanCollect )) {
			$alignment_object = [[
				'@type'								=>  'AlignmentObject',
				'alignmentType' 			=>	'educationalLevel',
				'targetName'					=> 	$cleanCollect['eduLevel']['val'],
				'targetDescription' 	=> 	isset($cleanCollect['eduLevel']['desc']) ? $cleanCollect['eduLevel']['desc'] : '',
				'targetUrl'						=> 	isset($cleanCollect['eduLevel']['url'])	?	$cleanCollect['eduLevel']['url']	: ''
			]];
			$alignment_objects = array_merge($alignment_objects, $alignment_object);
		}

		//Educational Framework
		if ( array_key_exists('eduLevel', $cleanCollect) && array_key_exists( 'eduFrame', $cleanCollect ) ){
			$alignment_object = [[
				'@type'									=>  'AlignmentObject',
				'alignmentType' 				=> 	"educationalLevel",
				'educationalFramework' 	=> 	$cleanCollect['eduFrame']['val'],
				'targetName'						=> 	$cleanCollect['eduLevel']['val'],
				'targetDescription' 		=> 	isset($cleanCollect['eduLevel']['desc']) ? $cleanCollect['eduLevel']['desc'] : "",
				'targetUrl'							=> 	isset($cleanCollect['eduLevel']['url'])	?	$cleanCollect['eduLevel']['url']	: ""
			]];
			$alignment_objects = array_merge($alignment_objects, $alignment_object);
		}

		//ISCED Field
		if ( array_key_exists('iscedField', $cleanCollect) ){
			$alignment_object = [[
				'@type'									=>  'AlignmentObject',
				'alignmentType'					=> 	'educationalSubject',
				'educationalFramework'	=> 	'ISCED-2013',
				'targetName' 						=> 	$cleanCollect['iscedField']['val'],
				'targetDescription'			=> 	isset($cleanCollect['iscedField']['desc']) ? $cleanCollect['iscedField']['desc'] : '',
				'targetUrl' 						=> 	isset($cleanCollect['iscedField']['url'])	?	$cleanCollect['iscedField']['url']	: ''
			]];
			$alignment_objects = array_merge($alignment_objects, $alignment_object);
		}

		if (array_key_exists('complexityLev', $cleanCollect) ){
			$alignment_object = [[
				'@type'					=>  'AlignmentObject',
				'alignmentType' => 	'textComplexity',
				'targetName'		=> 	$cleanCollect['complexityLev']['val']
			]];
			$alignment_objects = array_merge($alignment_objects, $alignment_object);
		}

		//Prerequisite zone
		if (array_key_exists('eduLevelPrerequisite', $cleanCollect) ){
			$alignment_object = [[
				'@type'					=>  'AlignmentObject',
				'alignmentType' => 	'requires',
				'targetName'		=> 	$cleanCollect['eduLevelPrerequisite']['val']
			]];
			$alignment_objects = array_merge($alignment_objects, $alignment_object);
		}

		if (array_key_exists('additionalClassPrerequisite', $cleanCollect) ){
			$alignment_object = [[
				'@type'					=>  'AlignmentObject',
				'alignmentType' => 	'requires',
				'targetName'		=> 	$cleanCollect['additionalClassPrerequisite']['val']
			]];
			$alignment_objects = array_merge($alignment_objects, $alignment_object);
		}

		if(!empty($alignment_objects)){
			$metadata['educationalAlignment'] = $alignment_objects;
		}

		//Additional classification
		if (array_key_exists('additionalClass', $cleanCollect)){
			$add_class_metadata = [
				'about'	=>	[
					'@type'					=>	'AlignmentObject',
					'alignmentType'	=>	'educationalSubject',
					'targetName' => [
						$cleanCollect['additionalClass']['val']
					]
				]
			];

			// The Description and URl are disabled for now
			// "targetDescription":	"'. (isset($cleanCollect['additionalClass']['desc'])	? $cleanCollect['additionalClass']['desc'] :"").'",
			// "targetUrl":	"'. (isset($cleanCollect['additionalClass']['url'])	? $cleanCollect['additionalClass']['url'] :	"").'"';

			if (array_key_exists('specificClass', $cleanCollect)){
				$add_class_metadata['about']['targetName'] = array_merge($add_class_metadata['about']['targetName'], $cleanCollect['specificClass']['val']);
			}

			$metadata = array_merge($metadata, $add_class_metadata);
		}

		return $metadata;
}


	/**
	 * Function that creates the vocabulary metatags
	 *
	 * @since    1.0
	 * @access   public
	 */
	public function smde_get_metatags_lang() {

		//Getting post meta of metadata (Book Info) or site-meta post
    if($this->type_level == 'metadata' || $this->type_level == 'site-meta'){
        $this->metadata = self::get_site_meta_metadata();
    } else {
        $this->metadata = get_post_meta( get_the_ID() );
    }


		$cleanCollect = [];

		//going thorugh all properties of this class and putting them into multidimensional array (with url and description)
		foreach ( self::$classification_properties_main as $key => $desc ) {
			//Constructing the key for the data
			//Add strtolower in all vocabs remember
			$dataKey = strtolower('smde_' . $key . '_' . $this->groupId .'_'. $this->type_level);

			//Getting the data
			$val = $this->smde_get_value($dataKey);

			//Checking if the value exists and that the key is in the array for the schema
			if(empty($val) || $val == '--Select--'){
				continue;
			} else {
				$cleanCollect[$key]['val'] = $val;
			}
		}


		$metadata = [];
		$alignment_objects = [];

		//Starting point of classification schema

		// Isced Level
		if ( array_key_exists('iscedLevel', $cleanCollect) ) {
			switch ($cleanCollect['iscedLevel']['val']) {

				case '0':

					$cleanCollect['iscedLevel']['desc'] = 'Programmes at ISCED level 0, or early childhood education, are typically designed with a holistic approach to support children’s early cognitive, physical, social and emotional development and introduce young children to organized instruction outside of the family context. ISCED level 0 refers to early childhood programmes that have an intentional education component. These programmes aim to develop socio-emotional skills necessary for participation in school and society. They also develop some of the skills needed for academic readiness and prepare children for entry into primary education.';
					break;

				case '1':

					$cleanCollect['iscedLevel']['desc'] = 'Programmes at ISCED level 1, or primary education, are typically designed to provide students with fundamental skills in reading, writing and mathematics (i.e. literacy and numeracy) and establish a solid foundation for learning and understanding core areas of knowledge, personal and social development, in preparation for lower secondary education. It focuses on learning at a basic level of complexity with little, if any, specialisation.';
					break;

				case '2':

					$cleanCollect['iscedLevel']['desc'] = '  Programmes at ISCED level 2, or lower secondary education, are typically designed to build on the learning outcomes from ISCED level 1. Usually, the aim is to lay the foundation for lifelong learning and human development upon which education systems may then expand further educational opportunities. Some education systems may already offer vocational education programmes at ISCED level 2 to provide individuals with skills relevant to employment';
					break;

				case '3':

					$cleanCollect['iscedLevel']['desc'] = 'Programmes at ISCED level 3, or upper secondary education, are typically designed to complete secondary education in preparation for tertiary education or provide skills relevant to employment, or both.';
					break;

				case '4':

					$cleanCollect['iscedLevel']['desc'] = 'Post-secondary non-tertiary education provides learning experiences building on secondary education, preparing for labour market entry as well as tertiary education. It aims at the individual acquisition of knowledge, skills and competencies lower than the level of complexity characteristic of tertiary education. Programmes at ISCED level 4, or post-secondary non-tertiary education, are typically designed to provide individuals who completed ISCED level 3 with non-tertiary qualifications required for progression to tertiary education or for employment when their ISCED level 3 qualification does not grant such access. For example, graduates from general ISCED level 3 programmes may choose to complete a non-tertiary vocational qualification; or graduates from vocational ISCED level 3 programmes may choose to increase their level of qualifications or specialise further. The content of ISCED level 4 programmes is not sufficiently complex to be regarded as tertiary education, although it is clearly post-secondary.';
					break;

				case '5':

					$cleanCollect['iscedLevel']['desc'] = 'Programmes at ISCED level 5, or short-cycle tertiary education, are often designed to provide participants with professional knowledge, skills and competencies. Typically, they are practically-based, occupationally-specific and prepare students to enter the labour market. However, these programmes may also provide a pathway to other tertiary education programmes. Academic tertiary education programmes below the level of a Bachelor’s programme or equivalent are also classified as ISCED level 5.';
					break;

				case '6':

					$cleanCollect['iscedLevel']['desc'] = 'Programmes at ISCED level 6, or Bachelor’s or equivalent level, are often designed to provide participants with intermediate academic and/or professional knowledge, skills and competencies, leading to a first degree or equivalent qualification. Programmes at this level are typically theoretically-based but may include practical components and are informed by state of the art research and/or best professional practice. They are traditionally offered by universities and equivalent tertiary educational institutions.';
					break;

				case '7':

					$cleanCollect['iscedLevel']['desc'] = 'Programmes at ISCED level 7, or Master’s or equivalent level, are often designed to provide participants with advanced academic and/or professional knowledge, skills and competencies, leading to a second degree or equivalent qualification. Programmes at this level may have a substantial research component but do not yet lead to the award of a doctoral qualification. Typically, programmes at this level are theoretically-based but may include practical components and are informed by state of the art research and/or best professional practice. They are traditionally offered by universities and other tertiary educational institutions.';
					break;

				case '8':

					$cleanCollect['iscedLevel']['desc'] = 'Programmes at ISCED level 8, or doctoral or equivalent level, are designed primarily to lead to an advanced research qualification. Programmes at this ISCED level are devoted to advanced study and original research and are typically offered only by research-oriented tertiary educational institutions such as universities. Doctoral programmes exist in both academic and professional fields.';
					break;

				case '9':

					$cleanCollect['iscedLevel']['desc'] = 'Programmes at ISCED level 9 are Not elsewhere classified.';
					break;

				default:
					$cleanCollect['iscedLevel']['desc'] = 'The International Standard Classification of Education (ISCED) belongs to the United Nations International Family of Economic and Social Classifications, which are applied in statistics worldwide with the purpose of assembling, compiling and analysing cross-nationally comparable data. ISCED is the reference classification for organizing education programmes and related qualifications by education levels and fields. ISCED is a product of international agreement and adopted formally by the General Conference of UNESCO Member States. ISCED is designed to serve as a framework to classify educational activities as defined in programmes and the resulting qualifications into internationally agreed categories. The basic concepts and definitions of ISCED are therefore intended to be internationally valid and comprehensive of the full range of education systems.';
					break;
				}

			$cleanCollect['iscedLevel']['url'] = 'http://uis.unesco.org/en/topic/international-standard-classification-education-isced';

		$alignment_object = [[
			'@type'									=>  'AlignmentObject',
			'alignmentType' 				=>	'educationalLevel',
			'educationalFramework'	=> 	'ISCED-2011',
			'targetName'					 	=> 	$this->get_isced_level($cleanCollect['iscedLevel']['val']),
			'alternateName'					=> 	'ISCED 2011, Level ' . $cleanCollect['iscedLevel']['val'],
			'targetDescription' 		=> 	$cleanCollect['iscedLevel']['desc'],
			'targetUrl'							=> 	$cleanCollect['iscedLevel']['url']
		]];
		$alignment_objects = array_merge($alignment_objects, $alignment_object);
	}

	$alignment_object = [[
		'@type'									=>  'AlignmentObject',
		'alignmentType' 				=>	'educationalSubject',
		'educationalFramework'	=> 	'ISCED-2013',
		'targetName'					 	=> 	[
			'Arts and Humanities',
			'Languages',
			'Language Acquisition'
		],
		'targetDescription' 		=> 	'Language acquisition is the  study  of  the  structure  and  composition  of  languages taught as second or foreign languages (i.e. that are intended for non-native or non-fluent speakers of the language). It includes the study of related cultures, literature, linguistics and phonetics if related to the specific language being acquired and forms part of the same programme or qualification. Classical or dead languages are included here as it is assumed there are no 		native speakers of the  language  and  hence  the  manner  of  teaching  and  the  content  of  the  curriculum are more similar to the teaching of foreign languages.',
		'targetUrl'							=> 	'http://uis.unesco.org/en/topic/international-standard-classification-education-isced'
	]];
	$alignment_objects = array_merge($alignment_objects, $alignment_object);

	// Educational Languages
	if (array_key_exists('eduLang', $cleanCollect)){
		$cleanCollect['eduLang']['desc'] = 'Second language.';
		$cleanCollect['eduLang']['url'] = 'http://uis.unesco.org/en/topic/international-standard-classification-education-isced';
		$alignment_object = [[
			'@type'									=>  'AlignmentObject',
			'alignmentType' 				=>	'educationalSubject',
			'targetName'					 	=> 	$cleanCollect['eduLang']['val'],
			'targetDescription' 		=> 	$cleanCollect['eduLang']['desc'],
			'targetUrl'							=> 	$cleanCollect['eduLang']['url']
		]];
		$alignment_objects = array_merge($alignment_objects, $alignment_object);
	}

		// Educational Level
		if ( array_key_exists( 'eduLevel', $cleanCollect )) {

			switch ($cleanCollect['eduLevel']['val']) {

				case 'A1':

					$cleanCollect['eduLevel']['desc'] = 'Can understand and use familiar everyday expressions and very basic phrases aimed at the satisfaction of needs of a concrete type. Can introduce him/herself and others and can ask and answer questions about personal details such as where he/she lives, people he/she knows and things he/she has. Can interact in a simple way provided the other person talks slowly and clearly and is prepared to help.';
					break;

				case 'A2':

					$cleanCollect['eduLevel']['desc'] = 'Can understand sentences and frequently used expressions related to areas of most immediate relevance (e.g. very basic personal and family information, shopping, local geography, employment). Can communicate in simple and routine tasks requiring a simple and direct exchange of information on familiar and routine matters.  Can describe in simple terms aspects of his/her background, immediate environment and matters in areas of immediate need.';
					break;

				case 'B1':

					$cleanCollect['eduLevel']['desc'] = 'Can understand the main points of clear standard input on familiar matters regularly encountered in work, school, leisure, etc. Can deal with most situations likely to arise whilst travelling in an area where the language is spoken.  Can produce simple connected text on topics which are familiar or of personal interest. Can describe experiences and events, dreams, hopes & ambitions and briefly give reasons and explanations for opinions and plans.';
					break;

				case 'B2':

					$cleanCollect['eduLevel']['desc'] = 'Can understand the main ideas of complex text on both concrete and abstract topics, including technical discussions in his/her field of specialisation. Can interact with a degree of fluency and spontaneity that makes regular interaction with native speakers quite possible without strain for either party. Can produce clear, detailed text on a wide range of subjects and explain a viewpoint on a topical issue giving the advantages and disadvantages of various options.';
					break;

				case 'C1':

					$cleanCollect['eduLevel']['desc'] = 'Can understand a wide range of demanding, longer texts, and recognise implicit meaning. Can express him/herself fluently and spontaneously without much obvious searching for expressions. Can use language flexibly and effectively for social, academic and professional purposes. Can produce clear, well-structured, detailed text on complex subjects, showing controlled use of organisational patterns, connectors and cohesive devices.';
					break;

				case 'C2':

					$cleanCollect['eduLevel']['desc'] = 'Can understand with ease virtually everything heard or read. Can summarise information from different spoken and written sources, reconstructing arguments and accounts in a coherent presentation. Can express him/herself spontaneously, very fluently and precisely, differentiating finer shades of meaning even in more complex situations.';
					break;

				default:

					$cleanCollect['eduLevel']['desc'] = 'The CEFR organises language proficiency in six levels, A1 to C2, which can be regrouped into three broad levels: Basic User, Independent User and Proficient User, and that can be further subdivided according to the needs of the local context. The levels are defined through ‘can-do’ descriptors';
					break;

			}

			$cleanCollect['eduLevel']['url'] = 'https://www.coe.int/en/web/common-european-framework-reference-languages/level-descriptions';
			$alignment_object = [[
				'@type'									=>  'AlignmentObject',
				'alignmentType' 				=>	'educationalLevel',
				'educationalFramework'	=>	'CEFR',
				'targetName'					 	=> 	$cleanCollect['eduLevel']['val'],
				'targetDescription' 		=> 	$cleanCollect['eduLevel']['desc'],
				'targetUrl'							=> 	$cleanCollect['eduLevel']['url']
			]];
			$alignment_objects = array_merge($alignment_objects, $alignment_object);
		}

		// Additional Classification
		if (array_key_exists('additionalClass', $cleanCollect)){

			switch ($cleanCollect['additionalClass']['val']) {

				case 'Culture':

					$cleanCollect['additionalClass']['desc'] = 'Sociolinguistic  competences refer  to  the  sociocultural  conditions  of  language  use. Through its sensitivity to social conventions (rules of politeness, norms governing relations  between  generations,  sexes,  classes  and  social  groups,  linguistic  codification  of certain fundamental rituals in the functioning of a community), the sociolinguistic component strictly affects all language communication between representatives of different cultures, even though participants may often be unaware of its influence.';
					break;

				case 'Grammar':

					$cleanCollect['additionalClass']['desc'] = 'Grammatical competence may be defined as knowledge of, and ability to use, the grammatical resources of a language. Formally, the grammar of a language may be seen as the set of principles governing the  assembly  of  elements  into  meaningful  labelled  and  bracketed  strings  (sentences). Grammatical competence is the ability to understand and express meaning by producing and recognising well-formed phrases and sentences in accordance with these principles (as opposed to memorising and reproducing them as fixed formulae).';
					break;

				case 'Orthography':

					$cleanCollect['additionalClass']['desc'] = 'Orthographic competence involves a knowledge of and skill in the perception and production of the symbols of which written texts are composed. The writing systems of all European languages are based on the alphabetic principle, though those of some other languages follow an ideographic (logographic) principle (e.g. Chinese) or a consonantal principle (e.g. Arabic). For alphabetic systems, learners should know and be able to perceive and produce';
					break;

				case 'Vocabulary':

					$cleanCollect['additionalClass']['desc'] = 'Lexical  competence,  knowledge  of,  and  ability  to  use,  the  vocabulary  of  a  language, consists of lexical elements and grammatical elements. Lexical elements
include: Fixed expressions (consisting of several words, which are used and learnt as wholes), and Single word forms (a particular single word form may have several distinct meanings)';
					break;

				default:

					$cleanCollect['additionalClass']['desc'] = 'CEFR not only provides a scaling of overall language proficiency in a given language, but also a breakdown of language use and language competences which will make it easier for practitioners to specify objectives and describe achievements of the most diverse kinds in accordance with the varying needs, characteristics and resources of learners';
					break;
			}
			$cleanCollect['additionalClass']['url'] = 'https://www.coe.int/en/web/common-european-framework-reference-languages';

			$add_class_metadata = [
				'about'	=>	[
					'@type'					=>	'AlignmentObject',
					'alignmentType'	=>	'educationalSubject',
					'targetName' 		=> [
						$cleanCollect['additionalClass']['val']
					]
				]
			];

			// Specific Classification
			if (array_key_exists('specificClass', $cleanCollect)){
				$add_class_metadata['about']['targetName'] = array_merge($add_class_metadata['about']['targetName'], $cleanCollect['specificClass']['val']);
			}

			$add_class_metadata['about']['targetDescription']	=	$cleanCollect['additionalClass']['desc'];
			$add_class_metadata['about']['targetUrl']	=	$cleanCollect['additionalClass']['url'];

			$metadata = array_merge($metadata, $add_class_metadata);

		}

		// Complexity Level
		if (array_key_exists('complexityLev', $cleanCollect) ){
			$alignment_object = [[
				'@type'									=>  'AlignmentObject',
				'alignmentType' 				=>	'textComplexity',
				'targetName'					 	=> 	$cleanCollect['complexityLev']['val']
			]];
			$alignment_objects = array_merge($alignment_objects, $alignment_object);
		}

		//Educational Level Prerequisite
		if (array_key_exists('eduLevelPrerequisite', $cleanCollect) ){
			$alignment_object = [[
				'@type'									=>  'AlignmentObject',
				'alignmentType' 				=>	'requires',
				'targetName'					 	=> 	$cleanCollect['eduLevelPrerequisite']['val']
			]];
			$alignment_objects = array_merge($alignment_objects, $alignment_object);
		}

		// Additional Classfication Prerequisite
		if (array_key_exists('additionalClassPrerequisite', $cleanCollect) ){

			$alignment_object = [[
				'@type'									=>  'AlignmentObject',
				'alignmentType' 				=>	'requires',
				'targetName'					 	=> 	$cleanCollect['additionalClassPrerequisite']['val']
			]];
			$alignment_objects = array_merge($alignment_objects, $alignment_object);
		}

		if(!empty($alignment_objects)){
			$metadata['educationalAlignment'] = array_merge($metadata, $alignment_objects);
		}



		return $metadata;
	}

}
