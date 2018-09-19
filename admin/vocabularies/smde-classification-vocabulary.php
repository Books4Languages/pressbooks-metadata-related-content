<?php
namespace vocabularies;

/**
 * The class for the educational custom vocabulary including operations and metaboxes
 *
 */
class SMDE_Metadata_Classification{

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
	public static $classification_properties_main = array(
		//For all the properties on external vocabularies we use the true paramenter
		//We do this because we dont select properties for other vocabularies except from schema
		//Without the true parameter the fields will not render
        
        'iscedLevel'=>array( 'ISCED level of education','Level of education according to ISCED-P 2011'.'<br><a target="_blank" href="http://www.uis.unesco.org/Education/Documents/isced-2011-en.pdf">Click Here for more information</a>',
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
        'eduFrame'=>array( 'Educational Framework','The Framework that the educational level belongs to. Example: CEFR, Common Core, European Baccalaureate'),
		'iscedField' => array( 'ISCED field of education','Broad field of education according to ISCED-F 2013.'. '<br><a target="_blank" href="http://alliance4universities.eu/wp-content/uploads/2017/03/ISCED-2013-Fields-of-education.pdf">Click Here for more information</a>',
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
		'eduLevel'=>array( 'Educational Level','The level of this subject. For ex. B1 for an English Course, or Grade 2 for a Physics Course.'),
		'additionalClass' => array( 'Additional Classification', 'More specified subject of current educational level. For ex. \'Grammar\' part of B1 English Course, \'Thermodynamics\' for Grade 7 of Physics Course', 'multiple')
	);

	public function __construct($typeLevelInput) {

		$this->groupId = 'class_vocab';
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

        $property = explode('_', $field_slug)[1];

        if ($property == 'iscedlevel' && !stripos($field_slug, 'url') && !stripos($field_slug, 'desc')){
        	$label = $this->get_isced_level($meta_value);
        } 

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
			'label' 		=>	'Classification Metadata',
			'priority' 		=>	'high'
		) );

		foreach ( self::$classification_properties_main as $property => $details ) {

			$callback = null;

			$freezes_class = get_option('smde_class_freezes');
			if ($meta_position != 'site-meta' && $meta_position!= 'metadata' && isset($freezes_class[$property]) && $freezes_class[$property]){
				$callback = 'render_frozen_field';
			}


			$fieldId = strtolower('smde_' . $property . '_' .$this->groupId. '_' .$meta_position);
			//Checking if we need a dropdown field
			if(!isset($details[2])){
					x_add_metadata_field( $fieldId, $meta_position, array(
						'group'       => $this->groupId,
						'label'       => $details[0],
						'description' => $details[1],
						'display_callback' => array($this, $callback)
					) );

			}else {
				if ( $details[2] == 'number' ) {
						x_add_metadata_field( $fieldId, $meta_position, array(
							'group'            => $this->groupId,
							'field_type'       => 'number',
							'label'            => $details[0],
							'description'      => $details[1],
							'display_callback' => array($this, $callback)
						) );
				}elseif ( $details[2] == 'multiple' ){
						x_add_metadata_field( $fieldId, $meta_position, array(
							'group'            => $this->groupId,
							'multiple'         => true,
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

			$fieldId = strtolower('smde_' . $property . '_desc_' .$this->groupId. '_' .$meta_position);
			x_add_metadata_field( $fieldId, $meta_position, array(
							'group'            => $this->groupId,
							'label'            => $details[0].' Description',
							'description'      => 'The description of a node in an established educational framework. <a href="https://ceds.ed.gov/element/001408">Find more here</a>',
							'display_callback' => array($this, $callback)
						) );

			$fieldId = strtolower('smde_' . $property . '_url_' .$this->groupId. '_' .$meta_position);
			x_add_metadata_field( $fieldId, $meta_position, array(
							'group'            => $this->groupId,
							'label'            => $details[0].' URL',
							'description'      => 'The URL of a node in an established educational framework. http://example.com',
							'display_callback' => array($this, $callback)
						) );

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
		if ( $this->type_level != 'metadata' && (!stripos($propName, 'additionalClass'))) {
			$value = $this->smde_get_first( $array );
		} elseif ($this->type_level != 'metadata' && (stripos($propName, 'url') || stripos($propName, 'desc'))) {
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


		$cleanCollect = null;

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

		$html = '';

		//Starting point of classification schema
		if ( array_key_exists('iscedLevel', $cleanCollect) ) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalLevel'/>\n"
			         ."	<meta itemprop = 'educationalFramework' content = 'ISCED-2011'/>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$this->get_isced_level($cleanCollect['iscedLevel']['val']). "'>\n"
			         ."	<meta itemprop = 'alternateName' content = 'ISCED 2011, Level  " .$cleanCollect['iscedLevel']['val']. "' />";
			if (isset($cleanCollect['iscedLevel']['desc'])){
			    $html .="	<link itemprop='targetDescription' content ='".$cleanCollect['iscedLevel']['desc']."' />\n";
			}
			if (isset($cleanCollect['iscedLevel']['url'])){
				$html .="	<link itemprop='targetUrl' href='".$cleanCollect['iscedLevel']['url']."' />\n";
			}
			$html .= "</span>\n";
		}

		if ( array_key_exists('iscedField', $cleanCollect) ) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n"
			         ."	<meta itemprop = 'educationalFramework' content = 'ISCED-2013'/>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$cleanCollect['iscedField']['val']. "'>\n";
			if (isset($cleanCollect['iscedField']['desc'])){
			    $html .="	<link itemprop='targetDescription' content ='".$cleanCollect['iscedField']['desc']."' />\n";
			}
			if (isset($cleanCollect['iscedField']['url'])){
				$html .="	<link itemprop='targetUrl' href='".$cleanCollect['iscedField']['url']."' />\n";
			}
			$html .= "</span>\n";
		}

		if ( array_key_exists( 'eduLevel', $cleanCollect ) && array_key_exists( 'eduFrame', $cleanCollect )) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n"
			         ."	<meta itemprop = 'educationalFramework' content = '" .$cleanCollect['eduFrame']['val']. "'>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$cleanCollect['eduLevel']['val']. "'>\n";
			if (isset($cleanCollect['eduLevel']['desc'])){
			    $html .="	<link itemprop='targetDescription' content ='".$cleanCollect['eduLevel']['desc']."' />\n";
			}
			if (isset($cleanCollect['eduLevel']['url'])){
				$html .="	<link itemprop='targetUrl' href='".$cleanCollect['eduLevel']['url']."' />\n";
			}
			$html .= "</span>\n";

		} elseif ( array_key_exists( 'eduLevel', $cleanCollect ) && !array_key_exists( 'eduFrame', $cleanCollect )) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalLevel'/>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$cleanCollect['eduLevel']['val']. "'>\n";
			if (isset($cleanCollect['eduLevel']['desc'])){
			    $html .="	<link itemprop='targetDescription' content ='".$cleanCollect['eduLevel']['desc']."' />\n";
			}
			if (isset($cleanCollect['eduLevel']['url'])){
				$html .="	<link itemprop='targetUrl' href='".$cleanCollect['eduLevel']['url']."' />\n";
			}
			$html .="</span>\n";
		}

		if (array_key_exists('additionalClass', $cleanCollect)){
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n";
			foreach($cleanCollect['additionalClass']['val'] as $additionalClass){
			    $html .="	<meta itemprop = 'targetName' content = '" .$additionalClass. "'>\n";
			}
			if (isset($cleanCollect['additionalClass']['desc'])){
			    $html .="	<link itemprop='targetDescription' content ='".$cleanCollect['additionalClass']['desc']."' />\n";
			}
			if (isset($cleanCollect['additionalClass']['url'])){
				$html .="	<link itemprop='targetUrl' href='".$cleanCollect['additionalClass']['url']."' />\n";
			}
			$html .= "</span>\n";
		}

		return $html;
	}
}