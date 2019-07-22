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
 * @since x.x.x (when the file was introduced)
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
		'eduLevel'				=> array( 'Educational Level','The level of this subject. For ex. B1 for an English Course, or Grade 2 for a Physics Course.'),
		'additionalClass' => array( 'Additional Classification', 'More specified subject of current educational level. For ex. \'Grammar\' part of B1 English Course, \'Thermodynamics\' for Grade 7 of Physics Course'),
		'specificClass'	  => array(	'Specific Classification', 'Narrow definition of subject field. For ex. \'Verbs\' in \'Grammar\' materials, \'Thermodynamics Laws\' in Thermodynamics', 'multiple')
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
					'9'  => __('Not elsewhere classified', 'simple-metadata-education'),
					'10' => __('Early Childhood Education', 'simple-metadata-education'),
					'1'  => __('Primary education', 'simple-metadata-education'),
					'2'  => __('Lower secondary education', 'simple-metadata-education'),
					'3'  => __('Upper secondary education', 'simple-metadata-education'),
					'4'  => __('Post-secondary non-tertiary education', 'simple-metadata-education'),
					'5'  => __('Short-cycle tertiary education', 'simple-metadata-education'),
					'6'  => __('Bachelor’s or equivalent level', 'simple-metadata-education'),
					'7'  => __('Master’s or equivalent level', 'simple-metadata-education'),
					'8'  => __('Doctoral or equivalent level', 'simple-metadata-education')));

			self::$classification_properties_main['eduLang'] =
			array(__('Studying content', 'simple-metadata-education'),
						__('Language which content is about', 'simple-metadata-education'),
				array ( '' 				=> __('--Select--', 'simple-metadata-education'),
						'ab'     			=> __('Abkhazian', 'simple-metadata-education'),
						'aa'     			=> __('Afar', 'simple-metadata-education'),
						'af'     			=> __('Afrikaans', 'simple-metadata-education'),
						'ak'     			=> __('Akan', 'simple-metadata-education'),
						'sq'     			=> __('Albanian', 'simple-metadata-education'),
						'am'     			=> __('Amharic', 'simple-metadata-education'),
						'ar'     			=> __('Arabic', 'simple-metadata-education'),
						'an'     			=> __('Aragonese', 'simple-metadata-education'),
						'hy'     			=> __('Armenian', 'simple-metadata-education'),
						'as'     			=> __('Assamese', 'simple-metadata-education'),
						'av'     			=> __('Avaric', 'simple-metadata-education'),
						'ae'     			=> __('Avestan', 'simple-metadata-education'),
						'ay'     			=> __('Aymara', 'simple-metadata-education'),
						'az'     			=> __('Azerbaijani', 'simple-metadata-education'),
						'bm'     			=> __('Bambara', 'simple-metadata-education'),
						'ba'     			=> __('Bashkir', 'simple-metadata-education'),
						'eu'     			=> __('Basque', 'simple-metadata-education'),
						'bn'     			=> __('Bengali', 'simple-metadata-education'),
						'be'     			=> __('Belarusian', 'simple-metadata-education'),
						'bh'     			=> __('Bihari languages', 'simple-metadata-education'),
						'bi'     			=> __('Bislama', 'simple-metadata-education'),
						'nb'     			=> __('Bokmål, Norwegian; Norwegian Bokmål', 'simple-metadata-education'),
						'bs'     			=> __('Bosnian', 'simple-metadata-education'),
						'br'					=> __('Breton', 'simple-metadata-education'),
						'bg'     			=> __('Bulgarian', 'simple-metadata-education'),
						'my'     			=> __('Burmese', 'simple-metadata-education'),
						'km'     			=> __('Central Khmer', 'simple-metadata-education'),
						'ch'     			=> __('Chamorro', 'simple-metadata-education'),
						'ce'     			=> __('Chechen', 'simple-metadata-education'),
						'ny'     			=> __('Chichewa; Chewa; Nyanja', 'simple-metadata-education'),
						'zh'     			=> __('Chinese', 'simple-metadata-education'),
						'cv'     			=> __('Chuvash', 'simple-metadata-education'),
						'kw'     			=> __('Cornish', 'simple-metadata-education'),
						'co'     			=> __('Corsican', 'simple-metadata-education'),
						'cr'     			=> __('Cree', 'simple-metadata-education'),
						'hr'     			=> __('Croatian', 'simple-metadata-education'),
						'cs'     			=> __('Czech', 'simple-metadata-education'),
						'da'     			=> __('Danish', 'simple-metadata-education'),
						'dz'     			=> __('Dzongkha', 'simple-metadata-education'),
						'nl'     			=> __('Dutch; Flemish', 'simple-metadata-education'),
						'en'     			=> __('English', 'simple-metadata-education'),
						'eo'     			=> __('Esperanto', 'simple-metadata-education'),
						'et'     			=> __('Estonian', 'simple-metadata-education'),
						'ee'     			=> __('Ewe', 'simple-metadata-education'),
						'fo'     			=> __('Faroese', 'simple-metadata-education'),
						'fj'     			=> __('Fijian', 'simple-metadata-education'),
						'fi'     			=> __('Finnish', 'simple-metadata-education'),
						'fr'     			=> __('French', 'simple-metadata-education'),
						'ff'     			=> __('Fulah', 'simple-metadata-education'),
						'gd'     			=> __('Gaelic', 'simple-metadata-education'),
						'gl'     			=> __('Galician', 'simple-metadata-education'),
						'lg'     			=> __('Ganda', 'simple-metadata-education'),
						'ka'     			=> __('Georgian', 'simple-metadata-education'),
						'de'     			=> __('German', 'simple-metadata-education'),
						'el'     			=> __('Greek', 'simple-metadata-education'),
						'gn'     			=> __('Guarani', 'simple-metadata-education'),
						'gu'     			=> __('Gujarati', 'simple-metadata-education'),
						'ht'     			=> __('Haitian', 'simple-metadata-education'),
						'ha'     			=> __('Hausa', 'simple-metadata-education'),
						'he'     			=> __('Hebrew', 'simple-metadata-education'),
						'hz'     			=> __('Herero', 'simple-metadata-education'),
						'hi'     			=> __('Hindi', 'simple-metadata-education'),
						'ho'     			=> __('Hiri Motu', 'simple-metadata-education'),
						'hu'     			=> __('Hungarian', 'simple-metadata-education'),
						'is'     			=> __('Icelandic', 'simple-metadata-education'),
						'io'     			=> __('Ido', 'simple-metadata-education'),
						'ig'     			=> __('Igbo', 'simple-metadata-education'),
						'id'     			=> __('Indonesian', 'simple-metadata-education'),
						'ia'     			=> __('Interlingua', 'simple-metadata-education'),
						'ie'     			=> __('Interlingue', 'simple-metadata-education'),
						'iu'     			=> __('Inuktitut', 'simple-metadata-education'),
						'ik'     			=> __('Inupiaq', 'simple-metadata-education'),
						'ga'     			=> __('Irish', 'simple-metadata-education'),
						'it'     			=> __('Italian', 'simple-metadata-education'),
						'ja'     			=> __('Japanese', 'simple-metadata-education'),
						'jv'     			=> __('Javanese', 'simple-metadata-education'),
						'kl'     			=> __('Kalaallisut; Greenlandic', 'simple-metadata-education'),
						'kn'     			=> __('Kannada', 'simple-metadata-education'),
						'kr'     			=> __('Kanuri', 'simple-metadata-education'),
						'ks'     			=> __('Kashmiri', 'simple-metadata-education'),
						'kk'     			=> __('Kazakh', 'simple-metadata-education'),
						'ki'     			=> __('Kikuyu; Gikuyu', 'simple-metadata-education'),
						'rw'     			=> __('Kinyarwanda', 'simple-metadata-education'),
						'kv'     			=> __('Komi', 'simple-metadata-education'),
						'kg'     			=> __('Kongo', 'simple-metadata-education'),
						'ko'     			=> __('Korean', 'simple-metadata-education'),
						'kj'     			=> __('Kuanyama; Kwanyama', 'simple-metadata-education'),
						'ku'     			=> __('Kurdish', 'simple-metadata-education'),
						'ky'     			=> __('Kirghiz; Kyrgyz', 'simple-metadata-education'),
						'lo'     			=> __('Lao', 'simple-metadata-education'),
						'la'     			=> __('Latin', 'simple-metadata-education'),
						'lv'     			=> __('Latvian', 'simple-metadata-education'),
						'li'     			=> __('Limburgan; Limburger; Limburgish', 'simple-metadata-education'),
						'ln'     			=> __('Lingala', 'simple-metadata-education'),
						'lt'     			=> __('Lithuanian', 'simple-metadata-education'),
						'lu'     			=> __('Luba-Katanga', 'simple-metadata-education'),
						'lb'     			=> __('Luxembourgish; Letzeburgesch', 'simple-metadata-education'),
						'mk'     			=> __('Macedonian', 'simple-metadata-education'),
						'mg'     			=> __('Malagasy', 'simple-metadata-education'),
						'ml'     			=> __('Malayalam', 'simple-metadata-education'),
						'dv'     			=> __('Maldivian', 'simple-metadata-education'),
						'gv'     			=> __('Manx', 'simple-metadata-education'),
						'mi'     			=> __('Maori', 'simple-metadata-education'),
						'ms'     			=> __('Malay', 'simple-metadata-education'),
						'mt'     			=> __('Maltese', 'simple-metadata-education'),
						'mr'     			=> __('Marathi', 'simple-metadata-education'),
						'mh'     			=> __('Marshallese', 'simple-metadata-education'),
						'mn'     			=> __('Mongolian', 'simple-metadata-education'),
						'na'     			=> __('Nauru', 'simple-metadata-education'),
						'nv'     			=> __('Navajo; Navaho', 'simple-metadata-education'),
						'nd'     			=> __('Ndebele, North; North Ndebele', 'simple-metadata-education'),
						'nr'     			=> __('Ndebele, South; South Ndebele', 'simple-metadata-education'),
						'ng'     			=> __('Ndonga', 'simple-metadata-education'),
						'ne'     			=> __('Nepali', 'simple-metadata-education'),
						'se'     			=> __('Northern Sami', 'simple-metadata-education'),
						'nn'     			=> __('Norwegian Nynorsk; Nynorsk, Norwegian', 'simple-metadata-education'),
						'no'     			=> __('Norwegian', 'simple-metadata-education'),
						'oc'     			=> __('Occitan; Provençal', 'simple-metadata-education'),
						'oj'     			=> __('Ojibwa', 'simple-metadata-education'),
						'om'     			=> __('Oromo', 'simple-metadata-education'),
						'or'     			=> __('Oriya', 'simple-metadata-education'),
						'os'     			=> __('Ossetian; Ossetic', 'simple-metadata-education'),
						'pa'     			=> __('Panjabi; Punjabi', 'simple-metadata-education'),
						'pi'     			=> __('Pali', 'simple-metadata-education'),
						'fa'     			=> __('Persian', 'simple-metadata-education'),
						'pl'     			=> __('Polish', 'simple-metadata-education'),
						'pt'     			=> __('Portuguese', 'simple-metadata-education'),
						'ps'     			=> __('Pushto; Pashto', 'simple-metadata-education'),
						'qu'     			=> __('Quechua', 'simple-metadata-education'),
						'ro'     			=> __('Romanian; Moldavian; Moldovan', 'simple-metadata-education'),
						'rm'     			=> __('Romansh', 'simple-metadata-education'),
						'rn'     			=> __('Rundi', 'simple-metadata-education'),
						'ru'     			=> __('Russian', 'simple-metadata-education'),
						'sm'     			=> __('Samoan', 'simple-metadata-education'),
						'sg'     			=> __('Sango', 'simple-metadata-education'),
						'sa'     			=> __('Sanskrit', 'simple-metadata-education'),
						'sc'     			=> __('Sardinian', 'simple-metadata-education'),
						'sr'     			=> __('Serbian', 'simple-metadata-education'),
						'sn'     			=> __('Shona', 'simple-metadata-education'),
						'ii'     			=> __('Sichuan Yi', 'simple-metadata-education'),
						'sd'     			=> __('Sindhi', 'simple-metadata-education'),
						'si'     			=> __('Sinhala; Sinhalese', 'simple-metadata-education'),
						'sk'     			=> __('Slovak', 'simple-metadata-education'),
						'sl'     			=> __('Slovenian', 'simple-metadata-education'),
						'so'     			=> __('Somali', 'simple-metadata-education'),
						'st'     			=> __('Sotho, Southern', 'simple-metadata-education'),
						'es'     			=> __('Spanish', 'simple-metadata-education'),
						'su'     			=> __('Sundanese', 'simple-metadata-education'),
						'ss'     			=> __('Swati', 'simple-metadata-education'),
						'sv'     			=> __('Swedish', 'simple-metadata-education'),
						'sw'     			=> __('Swahili', 'simple-metadata-education'),
						'tl'     			=> __('Tagalog', 'simple-metadata-education'),
						'ty'     			=> __('Tahitian', 'simple-metadata-education'),
						'tg'     			=> __('Tajik', 'simple-metadata-education'),
						'ta'     			=> __('Tamil', 'simple-metadata-education'),
						'tt'     			=> __('Tatar', 'simple-metadata-education'),
						'te'     			=> __('Telugu', 'simple-metadata-education'),
						'th'     			=> __('Thai', 'simple-metadata-education'),
						'bo'     			=> __('Tibetan', 'simple-metadata-education'),
						'ti'     			=> __('Tigrinya', 'simple-metadata-education'),
						'to'     			=> __('Tonga', 'simple-metadata-education'),
						'ts'     			=> __('Tsonga', 'simple-metadata-education'),
						'tn'     			=> __('Tswana', 'simple-metadata-education'),
						'tr'     			=> __('Turkish', 'simple-metadata-education'),
						'tk'     			=> __('Turkmen', 'simple-metadata-education'),
						'tw'     			=> __('Twi', 'simple-metadata-education'),
						'ug'     			=> __('Uighur; Uyghur', 'simple-metadata-education'),
						'uk'     			=> __('Ukrainian', 'simple-metadata-education'),
						'ur'     			=> __('Urdu', 'simple-metadata-education'),
						'uz'     			=> __('Uzbek', 'simple-metadata-education'),
						'vl'     			=> __('Valencian', 'simple-metadata-education'),
						've'     			=> __('Venda', 'simple-metadata-education'),
						'vi'     			=> __('Vietnamese', 'simple-metadata-education'),
						'vo'     			=> __('Volapük', 'simple-metadata-education'),
						'wa'     			=> __('Walloon', 'simple-metadata-education'),
						'cy'     			=> __('Welsh', 'simple-metadata-education'),
						'fy'     			=> __('Western Frisian', 'simple-metadata-education'),
						'wo'     			=> __('Wolof', 'simple-metadata-education'),
						'xh'     			=> __('Xhosa', 'simple-metadata-education'),
						'yi'     			=> __('Yiddish', 'simple-metadata-education'),
						'yo'     			=> __('Yoruba', 'simple-metadata-education'),
						'za'     			=> __('Zhuang; Chuang', 'simple-metadata-education'),
						'zu'     		  => __('Zulu', 'simple-metadata-education')));
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
					<strong><?=$property?></strong><?php printf(esc_html__( 'is overwritten by %s. The value is "%s"', 'simple-metadata-annotation'), $dataFrom, $label);?>
				</p>
        <input type="hidden" name="<?=$field_slug?>" value="<?=$meta_value?>" />
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
			'label' 		=>	__('Classification Metadata', 'simple-metadata-education'),
			'priority' 		=>	'high'
		) );

		//adiing metafields for exery property of this class
		foreach ( self::$classification_properties_main as $property => $details ) {

			$callback = null;

			//retreiving list of frozen properties
			$freezes_class = get_option('smde_class_freezes');

			//if this property is frozen, we render its metafield correspondingly
			if ($meta_position != 'site-meta' && $meta_position!= 'metadata' && isset($freezes_class[$property]) && $freezes_class[$property]){
				if (is_multisite() && get_site_option('smde_net_for_lang')){
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
			if ($property != 'specificClass' && ((is_multisite() && !get_site_option('smde_net_for_lang')) || !is_multisite())) {

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
			'9' => __('Not elsewhere classified', 'simple-metadata-education'),);
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

					$cleanCollect['iscedLevel']['desc'] = 'Programmes at ISCED level 9 are Not elsewhere classified.';
					break;

				case '10':

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


				default:
					$cleanCollect['iscedLevel']['desc'] = 'The International Standard Classification of Education (ISCED) belongs to the United Nations International Family of Economic and Social Classifications, which are applied in statistics worldwide with the purpose of assembling, compiling and analysing cross-nationally comparable data. ISCED is the reference classification for organizing education programmes and related qualifications by education levels and fields. ISCED is a product of international agreement and adopted formally by the General Conference of UNESCO Member States. ISCED is designed to serve as a framework to classify educational activities as defined in programmes and the resulting qualifications into internationally agreed categories. The basic concepts and definitions of ISCED are therefore intended to be internationally valid and comprehensive of the full range of education systems.';
					break;
				}

			$cleanCollect['iscedLevel']['url'] = 'http://uis.unesco.org/en/topic/international-standard-classification-education-isced';

			$html .= "</span>\n";
		}

		$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n"
			         ."	<meta itemprop = 'educationalFramework' content = 'ISCED-2013'/>\n"
			         ."	<meta itemprop = 'targetName' content = 'Arts and Humanities'>\n"
			         ."	<meta itemprop = 'targetName' content = 'Languages'>\n"
			         ."	<meta itemprop = 'targetName' content = 'Language Acquisition'>\n"
			         ."		<link itemprop='targetDescription' content ='Language acquisition is the  study  of  the  structure  and  composition  of  languages taught as second or foreign languages (i.e. that are intended for non-native or non-fluent speakers of the language). It includes the study of related cultures, literature, linguistics and phonetics if related to the specific language being acquired and forms part of the same programme or qualification. Classical or dead languages are included here as it is assumed there are no native speakers of the  language  and  hence  the  manner  of  teaching  and  the  content  of  the  curriculum are more similar to the teaching of foreign languages.' />\n"
			         ."		<link itemprop='targetUrl' content ='http://uis.unesco.org/en/topic/international-standard-classification-education-isced' />\n"
			         ."</span>\n";

		if (array_key_exists('eduLang', $cleanCollect)){
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalSubject'/>\n"
			         ."	<meta itemprop = 'targetName' content = '".$cleanCollect['eduLang']['val']."'>\n";

			$cleanCollect['eduLang']['desc'] = 'Second language.';
			$cleanCollect['eduLang']['url'] = 'http://uis.unesco.org/en/topic/international-standard-classification-education-isced';

			$html .="	<link itemprop='targetDescription' content ='".$cleanCollect['eduLang']['desc']."' />\n";
			$html .="	<link itemprop='targetUrl' href='".$cleanCollect['eduLang']['url']."' />\n";

			$html .= "</span>\n";
		}

		if ( array_key_exists( 'eduLevel', $cleanCollect )) {
			$html .= "<span itemprop = 'educationalAlignment' itemscope itemtype = 'http://schema.org/AlignmentObject'>\n"
			         ."	<meta itemprop = 'alignmentType' content = 'educationalLevel'/>\n"
			         ."	<meta itemprop = 'educationalFramework' content = 'CEFR'>\n"
			         ."	<meta itemprop = 'targetName' content = '" .$cleanCollect['eduLevel']['val']. "'>\n";

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

			$html .="	<link itemprop='targetDescription' content ='".$cleanCollect['additionalClass']['desc']."' />\n";
			$html .="	<link itemprop='targetUrl' href='".$cleanCollect['additionalClass']['url']."' />\n";

			$html .= "</span>\n";
		}

		$html .= "<!--END OF CLASSIFICATION METATAGS-->\n";

		return $html;
	}
}
