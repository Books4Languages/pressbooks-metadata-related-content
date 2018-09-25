<?php
namespace vocabularies;

/**
 * The base class for the educational custom vocabulary including operations and metaboxes. 
 * All specific vocabulary class should be extensions of this class.
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
	 * The variable that holds the properties of all vocabularies possbile
	 *
	 * @since    0.x
	 * @access   public
	 */
	public static $edu_properties = array(

		'interactivityType' 	 		=> array ( 'Interactivity Type','Predominant mode of learning supported by this learning object.',
			array ( '' 					=> '--Select--',
					'expositive' 		=> 'Expositive',
			        'mixed' 	 		=> 'Mixed',
			        'active' 	 		=> 'Active')),
		'learningResourceType'	 		=>	array ( 'Learning Resource Type','Specific kind of learning object. The most dominant kind shall be first.',
			array ( '' 					=> '--Select--',
					'course'	 		=> 'Course',
			        'exam'		 		=> 'Examination',
			        'exercise'	 		=> 'Exercise')),
		'interactivityLevel' 	 		=> array ( 'Interactivity Level', 'The degree of interactivity characterizing this learning object.',
			array ( '' 					=> '--Select--',
					'very low'	 		=> 'Very Low',
			        'low'		 		=> 'Low',
			        'medium'	 		=> 'Medium',
			   	    'high'		 		=>	'High',
			   	    'very high'	 		=>	'Very High')),
		'endUserRole'			 		=> array ( 'Intended End User Role', 'Principal user(s) for which this learning object was designed.',
			array ( '' 					=> '--Select--',
					'learner' 	 		=> 'Learner', 
					'author'	 		=> 'Author',
					'teacher'	 		=> 'Teacher', 
					'manager'	 		=> 'Manager')),
		'context'				 		=> array ( 'Context','The principal environment within which the learning and use of this learning object is intended to take place.',
			array ( '' 					=> '--Select--',
					'school'	 		=> 'School',
					'higher education'	=> 'Higher Education',
					'training'			=> 'Training',
					'other'				=> 'Other')),
		'typicalAgeRange' 				=> array ( 'Age Range','Age of the typical intended user.',
			array ( '' 					=> '--Select--',
					'18-' 				=> 'Adults',
			      	'17-18'				=> '17-18 years',
			      	'16-17' 			=> '16-17 years',
			      	'15-16' 			=> '15-16 years',
			      	'14-15' 			=> '14-15 years',
			      	'13-14' 			=> '13-14 years',
			      	'12-13' 			=> '12-13 years',
			      	'11-12' 			=> '11-12 years',
			      	'10-11' 			=> '10-11 years',
			      	'9-10'  			=> '9-10 years',
			      	'8-9'  				=> '8-9 years',
			      	'7-8'  				=> '7-8 years',
			      	'6-7'  				=> '6-7 years',
			      	'3-5'	  			=> '3-5 years')),
		'difficulty'					=> array ( 'Difficulty', 'How hard it is to work with or through this learning object for the typical intended target audience.',
			array ( '' 					=> '--Select--',
					'very easy'			=> 'Very Easy',
					'easy'				=> 'Easy',
					'medium'			=> 'Medium',
					'difficult'			=> 'Difficult',
					'very difficult'	=> 'Very Difficult')),
		'typicalLearningTime'			=> array ( 'Class Learning Time (hours)','Approximate or typical time it takes to work with or through this learning object for the typical intended target audience.', 'number'),
		'description' 					=> array ( 'Description', 'Comments on how this learning object is to be used.'),
		'language'						=> array ( 'Language', 'The human language used by the typical intended user of this learning object in ISO 639 standard',
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
					'zu'     			=> 'Zulu'))
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
		//adding metabox to desired location
		x_add_metadata_group( $this->groupId, $meta_position, array(
			'label' 		=>	'Educational Metadata',
			'priority' 		=>	'high'
		) );

		//adding metafields for every property in this class
		foreach ( self::$edu_properties as $property => $details ) {

			$callback = null;

			//retrieving names of prtoperties, which are frozen
			$freezes_edu = get_option('smde_edu_freezes');

			//if property is frozen, we render it as frozen
			if ($meta_position != 'site-meta' && $meta_position!= 'metadata' && isset($freezes_edu[$property]) && $freezes_edu[$property]){
				$callback = 'render_frozen_field';
			}

			//constructing name of field
			$fieldId = strtolower('smde_' . $property . '_' .$this->groupId. '_' .$meta_position);
			
			//Checking if we need a dropdown field, or number selector
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
}