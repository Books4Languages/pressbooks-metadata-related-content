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
				''										=> '--Select--',
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
		'additionalClass' => array( 'Additional Classification', 'More specified subject of current educational level. For ex. \'Grammar\' part of B1 English Course, \'Thermodynamics\' for Grade 7 of Physics Course'),
		'specificClass'	  => array('Specific Classification', 'Narrow definition of subject field. For ex. \'Verbs\' in \'Grammar\' materials, \'Thermodynamics Laws\' in Thermodynamics', 'multiple')
	);

	public function __construct($typeLevelInput) {

		$this->groupId = 'class_vocab';
		$this->type_level = $typeLevelInput;

		if (is_multisite() && get_blog_option(1, 'smde_net_for_lang')){
			unset(self::$classification_properties_main['eduFrame']);
			unset(self::$classification_properties_main['iscedField']);

			self::$classification_properties_main['eduLevel'] = array( 'Educational Level','The level of this subject.', 
				array( '' 	=> '--Select--',
					   'A1' => 'A1',
					   'A2' => 'A2',
					   'B1' => 'B1',
					   'B2' => 'B2',
					   'C1' => 'C1',
					   'C2' => 'C2'
				));

			self::$classification_properties_main['additionalClass'] = array( 'Additional Classification','More specified subject of current educational level.', 
				array( '' 			 => '--Select--',
					   'Culture' 	 => 'Culture',
					   'Grammar'  	 => 'Grammar',
					   'Orthography' => 'Orthography',
					   'Vocabulary'  => 'Vocabulary'
				));

			self::$classification_properties_main['iscedLevel'] = array( 'ISCED level of education','Level of education according to ISCED-P 2011'.'<br><a target="_blank" href="http://www.uis.unesco.org/Education/Documents/isced-2011-en.pdf">Click Here for more information</a>',
			array(
				'9'  => 'Not elsewhere classified',
				'10' => 'Early Childhood Education',
				'1'  => 'Primary education',
				'2'  => 'Lower secondary education',
				'3'  => 'Upper secondary education',
				'4'  => 'Post-secondary non-tertiary education',
				'5'  => 'Short-cycle tertiary education',
				'6'  => 'Bachelor’s or equivalent level',
				'7'  => 'Master’s or equivalent level',
				'8'  => 'Doctoral or equivalent level'));

			self::$classification_properties_main['eduLang'] = array('Studying content', 'Language which content is about', 
				array ( '' 					=> '--Select--',
						'aa'     			=> 'Afar',
						'ab'     			=> 'Abkhazian',
						'ae'     			=> 'Avestan',
						'af'     			=> 'Afrikaans',
						'ak'     			=> 'Akan',
						'am'     			=> 'Amharic',
						'an'     			=> 'Aragonese',
						'ar'     			=> 'Arabic',
						'as'     			=> 'Assamese',
						'av'     			=> 'Avaric',
						'ay'     			=> 'Aymara',
						'az'     			=> 'Azerbaijani',
						'ba'     			=> 'Bashkir',
						'be'     			=> 'Belarusian',
						'bg'     			=> 'Bulgarian',
						'bh'     			=> 'Bihari languages',
						'bm'     			=> 'Bambara',
						'bi'     			=> 'Bislama',
						'bn'     			=> 'Bengali',
						'bo'     			=> 'Tibetan',
						'br'     			=> 'Breton',
						'bs'     			=> 'Bosnian',
						'ce'     			=> 'Chechen',
						'ch'     			=> 'Chamorro',
						'co'     			=> 'Corsican',
						'cr'     			=> 'Cree',
						'cs'     			=> 'Czech',
						'cv'     			=> 'Chuvash',
						'cy'     			=> 'Welsh',
						'da'     			=> 'Danish',
						'de'     			=> 'German',
						'dv'     			=> 'Maldivian',
						'dz'     			=> 'Dzongkha',
						'ee'     			=> 'Ewe',
						'el'     			=> 'Greek',
						'en'     			=> 'English',
						'eo'     			=> 'Esperanto',
						'es'     			=> 'Spanish',
						'et'     			=> 'Estonian',
						'eu'     			=> 'Basque',
						'fa'     			=> 'Persian',
						'ff'     			=> 'Fulah',
						'fi'     			=> 'Finnish',
						'fj'     			=> 'Fijian',
						'fo'     			=> 'Faroese',
						'fr'     			=> 'French',
						'fy'     			=> 'Western Frisian',
						'ga'     			=> 'Irish',
						'gd'     			=> 'Gaelic',
						'gl'     			=> 'Galician',
						'gn'     			=> 'Guarani',
						'gu'     			=> 'Gujarati',
						'gv'     			=> 'Manx',
						'ha'     			=> 'Hausa',
						'he'     			=> 'Hebrew',
						'hi'     			=> 'Hindi',
						'ho'     			=> 'Hiri Motu',
						'hr'     			=> 'Croatian',
						'ht'     			=> 'Haitian',
						'hu'     			=> 'Hungarian',
						'hy'     			=> 'Armenian',
						'hz'     			=> 'Herero',
						'ia'     			=> 'Interlingua',
						'id'     			=> 'Indonesian',
						'ie'     			=> 'Interlingue',
						'ig'     			=> 'Igbo',
						'ii'     			=> 'Sichuan Yi',
						'ik'     			=> 'Inupiaq',
						'io'     			=> 'Ido',
						'is'     			=> 'Icelandic',
						'it'     			=> 'Italian',
						'iu'     			=> 'Inuktitut',
						'ja'     			=> 'Japanese',
						'jv'     			=> 'Javanese',
						'ka'     			=> 'Georgian',
						'kg'     			=> 'Kongo',
						'ki'     			=> 'Kikuyu; Gikuyu',
						'kj'     			=> 'Kuanyama; Kwanyama',
						'kk'     			=> 'Kazakh',
						'kl'     			=> 'Kalaallisut; Greenlandic',
						'km'     			=> 'Central Khmer',
						'kn'     			=> 'Kannada',
						'ko'     			=> 'Korean',
						'kr'     			=> 'Kanuri',
						'ks'     			=> 'Kashmiri',
						'ku'     			=> 'Kurdish',
						'kv'     			=> 'Komi',
						'kw'     			=> 'Cornish',
						'ky'     			=> 'Kirghiz; Kyrgyz',
						'la'     			=> 'Latin',
						'lb'     			=> 'Luxembourgish; Letzeburgesch',
						'lg'     			=> 'Ganda',
						'li'     			=> 'Limburgan; Limburger; Limburgish',
						'ln'     			=> 'Lingala',
						'lo'     			=> 'Lao',
						'lt'     			=> 'Lithuanian',
						'lu'     			=> 'Luba-Katanga',
						'lv'     			=> 'Latvian',
						'mg'     			=> 'Malagasy',
						'mh'     			=> 'Marshallese',
						'mi'     			=> 'Maori',
						'mk'     			=> 'Macedonian',
						'ml'     			=> 'Malayalam',
						'mn'     			=> 'Mongolian',
						'mr'     			=> 'Marathi',
						'ms'     			=> 'Malay',
						'mt'     			=> 'Maltese',
						'my'     			=> 'Burmese',
						'na'     			=> 'Nauru',
						'nb'     			=> 'Bokmål, Norwegian; Norwegian Bokmål',
						'nd'     			=> 'Ndebele, North; North Ndebele',
						'ne'     			=> 'Nepali',
						'ng'     			=> 'Ndonga',
						'nl'     			=> 'Dutch; Flemish',
						'nn'     			=> 'Norwegian Nynorsk; Nynorsk, Norwegian',
						'no'     			=> 'Norwegian',
						'nr'     			=> 'Ndebele, South; South Ndebele',
						'nv'     			=> 'Navajo; Navaho',
						'ny'     			=> 'Chichewa; Chewa; Nyanja',
						'oc'     			=> 'Occitan; Provençal',
						'oj'     			=> 'Ojibwa',
						'om'     			=> 'Oromo',
						'or'     			=> 'Oriya',
						'os'     			=> 'Ossetian; Ossetic',
						'pa'     			=> 'Panjabi; Punjabi',
						'pi'     			=> 'Pali',
						'pl'     			=> 'Polish',
						'ps'     			=> 'Pushto; Pashto',
						'pt'     			=> 'Portuguese',
						'qu'     			=> 'Quechua',
						'rm'     			=> 'Romansh',
						'rn'     			=> 'Rundi',
						'ro'     			=> 'Romanian; Moldavian; Moldovan',
						'ru'     			=> 'Russian',
						'rw'     			=> 'Kinyarwanda',
						'sa'     			=> 'Sanskrit',
						'sc'     			=> 'Sardinian',
						'sd'     			=> 'Sindhi',
						'se'     			=> 'Northern Sami',
						'sg'     			=> 'Sango',
						'si'     			=> 'Sinhala; Sinhalese',
						'sk'     			=> 'Slovak',
						'sl'     			=> 'Slovenian',
						'sm'     			=> 'Samoan',
						'sn'     			=> 'Shona',
						'so'     			=> 'Somali',
						'sq'     			=> 'Albanian',
						'sr'     			=> 'Serbian',
						'ss'     			=> 'Swati',
						'st'     			=> 'Sotho, Southern',
						'su'     			=> 'Sundanese',
						'sv'     			=> 'Swedish',
						'sw'     			=> 'Swahili',
						'ta'     			=> 'Tamil',
						'te'     			=> 'Telugu',
						'tg'     			=> 'Tajik',
						'th'     			=> 'Thai',
						'ti'     			=> 'Tigrinya',
						'tk'     			=> 'Turkmen',
						'tl'     			=> 'Tagalog',
						'tn'     			=> 'Tswana',
						'to'     			=> 'Tonga',
						'tr'     			=> 'Turkish',
						'ts'     			=> 'Tsonga',
						'tt'     			=> 'Tatar',
						'tw'     			=> 'Twi',
						'ty'     			=> 'Tahitian',
						'ug'     			=> 'Uighur; Uyghur',
						'uk'     			=> 'Ukrainian',
						'ur'     			=> 'Urdu',
						'uz'     			=> 'Uzbek',
						'vl'     			=> 'Valencian',
						've'     			=> 'Venda',
						'vi'     			=> 'Vietnamese',
						'vo'     			=> 'Volapük',
						'wa'     			=> 'Walloon',
						'wo'     			=> 'Wolof',
						'xh'     			=> 'Xhosa',
						'yi'     			=> 'Yiddish',
						'yo'     			=> 'Yoruba',
						'za'     			=> 'Zhuang; Chuang',
						'zh'     			=> 'Chinese',
						'zu'     			=> 'Zulu'));
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
        <hr />
        <p><strong><?=$property?></strong> is overwritten by <?=$dataFrom?>. The value is"<?=$label?>"</p>
        <input type="hidden" name="<?=$field_slug?>" value="<?=$meta_value?>" />
        <hr />
        <?php
	}

	/**
	 * Function to render fields, which are frozen by admin/network admin in languages education (empty string)
	 */
	public function render_frozen_field_lang ($field_slug, $field, $value) {
		echo '';
	}

	/**
	 * The function which produces the metaboxes for the vocabulary
	 *
	 * @param string Accepting a string so we can distinguish on witch place each metabox is created
	 *
	 * @since 0.x
	 */
	public function smde_add_metabox( $meta_position ) {

		//adding metabox for calssification properties
		x_add_metadata_group( $this->groupId,$meta_position, array(
			'label' 		=>	'Classification Metadata',
			'priority' 		=>	'high'
		) );

		//adiing metafields for exery property of this class
		foreach ( self::$classification_properties_main as $property => $details ) {

			$callback = null;

			//retreiving list of frozen properties 
			$freezes_class = get_option('smde_class_freezes');

			//if this property is frozen, we render its metafield correspondingly
			if ($meta_position != 'site-meta' && $meta_position!= 'metadata' && isset($freezes_class[$property]) && $freezes_class[$property]){
				if (is_multisite() && get_blog_option(1, 'smde_net_for_lang')){
					$callback = 'render_frozen_field_lang';
				} else {
					$callback = 'render_frozen_field';
				}
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

			//creating URL and description fields for all levels, except Specific Classification
			if ($property != 'specificClass' && ((is_multisite() && !get_blog_option(1, 'smde_net_for_lang')) || !is_multisite())) {

			    $fieldId = strtolower('smde_' . $property . '_desc_' .$this->groupId. '_' .$meta_position);
				x_add_metadata_field( $fieldId, $meta_position, array(
								'field_type'			   => 'textarea',
								'group'            => $this->groupId,
								'label'            => $details[0].' Description',
								'description'      => 'The description of a node in an established educational framework. <a target="_blank" href="https://ceds.ed.gov/element/001408">Find more here</a>',
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
	 * @since    1.0
	 * @access   public
	 */
	public function smde_get_metatags() {

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

		$html = "\n<!--CLASSIFICATION METATAGS-->\n";

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
			$html .= "	<meta itemprop = 'targetName' content = '" .$cleanCollect['additionalClass']['val']. "'>\n";
			if (array_key_exists('specificClass', $cleanCollect)){
				foreach($cleanCollect['specificClass']['val'] as $specificClass){
					if (!empty($specificClass)){
			    		$html .="	<meta itemprop = 'targetName' content = '" .$specificClass. "'>\n";
			    	}
				}
			}
			if (isset($cleanCollect['additionalClass']['desc'])){
			    $html .="	<link itemprop='targetDescription' content ='".$cleanCollect['additionalClass']['desc']."' />\n";
			}
			if (isset($cleanCollect['additionalClass']['url'])){
				$html .="	<link itemprop='targetUrl' href='".$cleanCollect['additionalClass']['url']."' />\n";
			}
			$html .= "</span>\n";
		}

		$html .= "<!--END OF CLASSIFICATION METATAGS-->\n";

		return $html;
	}

	/**
	 * Function that creates the vocabulary metatags
	 *
	 * @since    0.x
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

		$html = "\n<!--CLASSIFICATION METATAGS-->\n";

		//Starting point of classification schema
		if ( array_key_exists('iscedLevel', $cleanCollect) ) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalLevel'/>\n"
			         ."	<meta itemprop = 'educationalFramework' content = 'ISCED-2011'/>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$this->get_isced_level($cleanCollect['iscedLevel']['val']). "'>\n"
			         ."	<meta itemprop = 'alternateName' content = 'ISCED 2011, Level  " .$cleanCollect['iscedLevel']['val']. "' />";

			switch ($cleanCollect['iscedLevel']['val']) {

				case '9':
						
					$cleanCollect['iscedLevel']['desc'] = 'smth';
					break;

				case '10':
						
					$cleanCollect['iscedLevel']['desc'] = 'smth';
					break;

				case '1':
						
					$cleanCollect['iscedLevel']['desc'] = 'smth';
					break;

				case '2':
						
					$cleanCollect['iscedLevel']['desc'] = 'smth';
					break;

				case '3':
						
					$cleanCollect['iscedLevel']['desc'] = 'smth';
					break;

				case '4':
						
					$cleanCollect['iscedLevel']['desc'] = 'smth';
					break;

				case '5':
						
					$cleanCollect['iscedLevel']['desc'] = 'smth';
					break;

				case '6':
						
					$cleanCollect['iscedLevel']['desc'] = 'smth';
					break;

				case '7':
						
					$cleanCollect['iscedLevel']['desc'] = 'smth';
					break;

				case '8':
						
					$cleanCollect['iscedLevel']['desc'] = 'smth';
					break;

					
				default:
					$cleanCollect['iscedLevel']['desc'] = 'smth';
					break;
				}

			$cleanCollect['iscedLevel']['url'] = 'url';
			
			$html .= "</span>\n";
		}

		$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n"
			         ."	<meta itemprop = 'educationalFramework' content = 'ISCED-2013'/>\n"
			         ."	<meta itemprop = 'targetName' content = 'Arts and Humanities'>\n"
			         ."	<meta itemprop = 'targetName' content = 'Languages'>\n"
			         ."	<meta itemprop = 'targetName' content = 'Language Acquisition'>\n"
			         ."		<link itemprop='targetDescription' content ='smth' />\n"
			         ."		<link itemprop='targetUrl' content ='url' />\n"
			         ."</span>\n";

		if (array_key_exists('eduLang', $cleanCollect)){
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n"
			         ."	<meta itemprop = 'targetName' content = '".$cleanCollect['eduLang']['val']."'>\n";
			
			$cleanCollect['eduLang']['desc'] = 'smth';
			$cleanCollect['eduLang']['url'] = 'url';

			$html .="	<link itemprop='targetDescription' content ='".$cleanCollect['eduLang']['desc']."' />\n";
			$html .="	<link itemprop='targetUrl' href='".$cleanCollect['eduLang']['url']."' />\n";

			$html .= "</span>\n";
		}

		if ( array_key_exists( 'eduLevel', $cleanCollect )) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n"
			         ."	<meta itemprop = 'educationalFramework' content = 'CEFR'>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$cleanCollect['eduLevel']['val']. "'>\n";

			switch ($cleanCollect['eduLevel']['val']) {

				case 'A1':

					$cleanCollect['eduLevel']['desc'] = 'smth';
					break;

				case 'A2':

					$cleanCollect['eduLevel']['desc'] = 'smth';
					break;

				case 'B1':

					$cleanCollect['eduLevel']['desc'] = 'smth';
					break;

				case 'B2':

					$cleanCollect['eduLevel']['desc'] = 'smth';
					break;

				case 'C1':

					$cleanCollect['eduLevel']['desc'] = 'smth';
					break;

				case 'C2':

					$cleanCollect['eduLevel']['desc'] = 'smth';
					break;
				
				default:

					$cleanCollect['eduLevel']['desc'] = 'smth';
					break;

			}
			
			$cleanCollect['eduLevel']['url'] = 'url';

			$html .="	<link itemprop='targetDescription' content ='".$cleanCollect['eduLevel']['desc']."' />\n";
			$html .="	<link itemprop='targetUrl' href='".$cleanCollect['eduLevel']['url']."' />\n";

			$html .= "</span>\n";

		} 

		if (array_key_exists('additionalClass', $cleanCollect)){

			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n";
			$html .= "	<meta itemprop = 'targetName' content = '" .$cleanCollect['additionalClass']['val']. "'>\n";
			if (array_key_exists('specificClass', $cleanCollect)){
				foreach($cleanCollect['specificClass']['val'] as $specificClass){
					if (!empty($specificClass)){
			    		$html .="	<meta itemprop = 'targetName' content = '" .$specificClass. "'>\n";
			    	}
				}
			}
			
			switch ($cleanCollect['additionalClass']['val']) {

				case 'Culture':
					
					$cleanCollect['additionalClass']['desc'] = 'smth';
					break;

				case 'Grammar':
					
					$cleanCollect['additionalClass']['desc'] = 'smth';
					break;

				case 'Orthography':
					
					$cleanCollect['additionalClass']['desc'] = 'smth';
					break;

				case 'Vocabulary':
					
					$cleanCollect['additionalClass']['desc'] = 'smth';
					break;
				
				default:
					
					$cleanCollect['additionalClass']['desc'] = 'smth';
					break;
			}

			$cleanCollect['additionalClass']['url'] = 'url';

			$html .="	<link itemprop='targetDescription' content ='".$cleanCollect['additionalClass']['desc']."' />\n";
			$html .="	<link itemprop='targetUrl' href='".$cleanCollect['additionalClass']['url']."' />\n";

			$html .= "</span>\n";
		}

		$html .= "<!--END OF CLASSIFICATION METATAGS-->\n";

		return $html;
	}
}