<?php

namespace educa;
use schemaFunctions\Pressbooks_Metadata_Create_Metabox as create_metabox;
use schemaFunctions\Pressbooks_Metadata_General_Functions as genFunc;

/**
 * The class for the coins vocabulary including operations and metaboxes
 *
 * @link       https://github.com/Books4Languages/pressbooks-metadata
 * @since      0.10
 *
 * @package    Pressbooks_Metadata
 * @subpackage Pressbooks_Metadata/admin/vocabularyFunctions
 * @author     Christos Amyrotos <christosv2@hotmail.com>
 * @author     Nicole Acuña      <@nicoleacuna>
 */

class Pressbooks_Metadata_Coins {

	/**
	 * The type level that identifies where these metaboxes will be created
	 *
	 * @since    0.10
	 * @access   public
	 */
	public $type_level;

	/**
	 * The variable that holds the values from the database for the vocabulary output
	 *
	 * @since    0.10
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
	 * @since    0.10
	 * @access   public
	 */
	static $type_properties = array(
		'title' => array(true,'Title',''),
		'author' => array(true,'Author',''),
		'language' => array(true,'Language',''),
		'provider' => array(true,'Provider',''),
		'learning_resource' => array(true,'Learning Resource',''),
		'publication_date' => array(true,'Publication Date',''),
	);

	public function __construct($level) {
		$this->groupId = 'coins_vocab';
		$this->type_level = $level;
		$this->pmdt_add_metabox($this->type_level);
	}

	/**
	 * The function which produces the metaboxes for the vocabulary
	 * @param string Accepting a string so we can distinguish on witch place each metabox is created
	 * @since 0.10
	 */
	public function pmdt_add_metabox($meta_position) {
		x_add_metadata_group( 	$this->groupId,$meta_position, array(
			'label' 		=>	'COinS Metadata',
			'priority' 		=>	'high'
		) );

		foreach ( self::$type_properties as $property => $details ) {

			$fieldId = strtolower('pb_' . $property . '_' .$this->groupId. '_' .$meta_position);
			//Checking if we need a dropdown field
			if(!isset($details[3])){
				x_add_metadata_field( $fieldId, $meta_position, array(
					'group'       => $this->groupId,
					'label'       => $details[1],
					'description' => $details[2],
					'display_callback' => null
				) );

			}else {
				if ( $details[3] == 'number' ) {
					x_add_metadata_field( $fieldId, $meta_position, array(
						'group'            => $this->groupId,
						'field_type'       => 'number',
						'label'            => $details[1],
						'description'      => $details[2],
						'display_callback' => null
					) );
				} else {
					x_add_metadata_field( $fieldId, $meta_position, array(
						'group'            => $this->groupId,
						'field_type'       => 'select',
						'values'           => $details[3],
						'label'            => $details[1],
						'description'      => $details[2],
						'display_callback' => null
					) );
				}
			}
		}
	}

	/**
	 * A function needed for the array of metadata that comes from each post site-meta cpt or chapter
	 * It automatically returns the first item in the array.
	 * @since 0.10
	 *
	 */
	private function pmdt_get_first($my_array){
		if($my_array == ''){
			return '';
		}else {
			return $my_array[0];
		}
	}

	/**
	 * Gets the value for the microtags from $this->metadata.
	 *
	 * @since    0.10
	 * @access   public
	 */
	private function pmdt_get_value($propName){
		$array = isset($this->metadata[$propName])? $this->metadata[$propName] : '';
		if($this->type_level == 'site-meta'){
			$value = $this->pmdt_get_first($array);
		}else{//We always use the get_first function except if our level is metadata coming from pressbooks
			$value = $array;
		}
		return $value;
	}

	/**
	 * Function that creates the vocabulary metatags
	 *
	 * @since    0.10
	 * @access   public
	 */
	public function pmdt_get_metatags(){
		//Getting the information from the database
		$this->metadata = genFunc::get_metadata();
		//we take url of web site
		$URL = get_permalink();
		$content = "<!-- Coins metatags -->\n";
		//create a coinsTitle
		$coinsTitle = 'ctx_ver=Z39.88-2004'

		              . '&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Adc'
		              . '&amp;rfr_id=info:sid/en.wikipedia.org:'
		              . '&amp;rft.type='
		              . '&amp;rft.format=text';
		//We walk the array and for each element we see if it matches the fields that we want to visualize
		foreach ( self::$type_properties as $key => $description ) {
			//Constructing the key for the data
			$dataKey = 'pb_' . $key . '_' . $this->groupId .'_'. $this->type_level;
			//Getting the data
			$val = $this->pmdt_get_value($dataKey);
			//Checking if the value exists
			if(!isset($val) || empty($val)){
				continue;
			}
			// title and site title
			if($key == 'title'){
				$coinsTitle .= '&amp;rft.title='. urlencode($val) ;
				$coinsTitle .= '&amp;rft.source='. urlencode(get_the_title() . '|' . get_bloginfo( '  name' ));
			}
			//author
			if($key == 'author'){
				$coinsTitle .= '&amp;rft.au='. urlencode($val);
			}
			//language
			if($key== 'language'){
				$coinsTitle .= '&amp;rft.language='. urlencode($val);
			}
			//pending publisher
			if($key == 'provider'){
				$coinsTitle .= '&amp;rft.pub='. urlencode( $val);
			}
			//pending genre
			if($key == 'learning_resource'){
				$coinsTitle .= '&amp;rft.genre='. urlencode( $val );
			}
			//problems to visualizate date
			if($key == 'publication_date'){
				//TODO Needs fix
				//$v= CAST($val AS DATETIME);
				//$coinsTitle .= '&amp;rft.date='. the_time('Y-m-d');
			}
		}
		//URL web site
		$coinsTitle .= '&amp;rft.identifier='. urlencode( $URL);
		$content .= '<span class="Z3988" title="' . esc_html( $coinsTitle ) . '"></span>' ;
		return $content;
	}
}