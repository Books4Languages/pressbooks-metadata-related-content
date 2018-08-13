<?php

namespace educa;
use schemaFunctions\Pressbooks_Metadata_General_Functions as genFunc;

/**
 * The class for the dublin vocabulary including operations and metaboxes
 *
 * @link       https://github.com/Books4Languages/pressbooks-metadata
 * @since      0.10
 *
 * @package    Pressbooks_Metadata
 * @subpackage Pressbooks_Metadata/admin/vocabularyFunctions
 * @author     Christos Amyrotos <christosv2@hotmail.com>
 * @author     Nicole Acuña      <@nicoleacuna>
 */

class Pressbooks_Metadata_Dublin {

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
		//For all the properties on external vocabularies we use the true paramenter
		//We do this because we dont select properties for other vocabularies except from schema
		//Without the true parameter the fields will not render
		'dublin_title' => array(true, 'Title', ''),
		'dublin_contributor' => array( true, 'Contributor', '' ),
		'dublin_creator' => array(true, 'Creator', ''),
		'dublin_publisher' => array( true, 'Publisher', '' ),
		'dublin_date' => array(true, 'Creation Date', '', 'datepicker'),
		'dublin_description' => array(true, 'Description', '', 'textarea'),
		'dublin_language' => array(true, 'Language', 'Language of the content in ISO639-1 standard'),
		'dublin_source' => array(true, 'Source', 'Source material URL'),
		'dublin_subject' => array(true, 'Subject', 'Subject of the material'),
		'dublin_type' => array(true, 'Type', '', array(
			'Collection'            => 'Collection',
			'Dataset'               => 'Dataset',
			'Event'                 => 'Event',
			'Image'                 => 'Image',
			'InteractiveResource'   => 'Interactive Resource',
			'MovingImage'           => 'Moving Image',
			'PhysicalObject'        => 'Physical Object',
			'Service'               => 'Service',
			'Software'              => 'Software',
			'Sound'                 => 'Sound',
			'StillImage'            => 'Still Image',
			'Text'                  => 'Text'
		)),
		'dublin_learning_resource' => array( true, 'Learning Resource', '"relation" property of DC', array(
			'course'	=> 	'Course',
			'exam'		=> 	'Examination',
			'exercise'	=> 	'Exercise'
		)),
		'dublin_interactivity_type' => array( true, 'Interactivity Type', '"relation" property of DC', array(
			'expositive'=> 	'Expositive',
			'mixed' 	=> 	'Mixed',
			'active' 	=> 	'Active'
		)),
		'dublin_time_required' => array( true, 'Required Time', '', 'number' ),
		'dublin_bibliography_url' => array( true, 'Bibliography Url', '"identifier" property of DC' ),
		'dublin_coverage' => array( true, 'Coverage', '' ),
		'dublin_questions_answers' => array( true, 'Questions and Answers', 'Link to Q&A forum ("identifier" property of DC)' )
	);

	static $type_extended_properties = array(
		'dublin_abstract' => array(true, 'Abstract', 'Summary of the resource'),
		'dublin_accessRights' => array(true, 'Access Rights', 'Information about who can access the resource or an indication of its security status'),
		'dublin_accrualMethod' => array(true, 'Accrual Method', 'The method by which items are added to a collection.'),
		'dublin_accrualPeriodicity' => array(true, 'Accrual Peridiocity', 'The frequency with which items are added to a collection.'),
		'dublin_accrualPolicy' => array(true, 'Accrual Policy', '	The policy governing the addition of items to a collection'),
		'dublin_alternative' => array(true, 'Alternative Title', ''),
		'dublin_ageRange' => array( true, 'Audience Age Range', 'property of /terms/ namespace of Dublin Core', array(
			'18-' 		=> 	'Adults',
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
			'3-5'	  	=> 	  '3-5 years'
		)),
		'dublin_available' => array(true, 'Date Available', '', 'datepicker'),
		'dublin_bibliographicCitation' => array(true, 'Bibliographic Citation', 'A bibliographic reference for the resource'),
		'dublin_conformsTo' => array(true, 'Conforms To', 'An established standard to which the described resource conforms'),
		'dublin_dateAccepted' => array(true, 'Date Accepted', '	Date of acceptance of the resource', 'datepicker'),
		'dublin_dateCopyrighted' => array (true, 'Date Copyrighted', '', 'datepicker'),
		'dublin_dateSubmitted' => array(true, 'Date Submitted', '', 'datepicker'),
		'dublin_educationLevel' => array(true, 'Education Level', ''),
		'dublin_extent' => array(true, 'Extent', 'The size or duration of the resource'),
		'dublin_hasFormat' => array(true, 'Has Format', 'Other formats which current resource exists'),
		'dublin_hasPart' => array(true, 'Has Part', 'A related resource that is included either physically or logically in the described resource'),
		'dublin_hasVersion' => array(true, 'Has Version', 'A related resource that is a version, edition, or adaptation of the described resource'),
		'dublin_instructionalMethod' => array(true, 'Instructional Method', 'A process, used to engender knowledge, attitudes and skills, that the described resource is designed to support.'),
		'dublin_isFormatOf' => array(true, 'Is Format Of', 'A related resource that is substantially the same as the described resource, but in another format'),
		'dublin_isPartOf' => array(true, 'Is Part Of', 'A related resource in which the described resource is physically or logically included'),
		'dublin_isReferencedBy' => array(true, 'Is Referenced By', ''),
		'dublin_isReplacedBy' => array(true, 'Is Replaced By', ''),
		'dublin_isRequiredBy' => array(true, 'Is Required By', ''),
		'dublin_issued' => array(true, 'Issued', '', 'datepicker'),
		'dubin_isVersionOf' => array(true, 'Is Version Of', ''),
		'dublin_license' => array( true, 'License Url', '' ),
		'dublin_mediator' => array(true, 'Mediator' , 'An entity that mediates access to the resource and for whom the resource is intended or useful.'),
		'dublin_medium' => array(true, 'Medium', 'The material or physical carrier of the resource'),
		'dublin_modified' => array(true, 'Date Modified', '', 'datepicker'),
		'dublin_provenance' => array(true, 'Provenance', 'A statement of any changes in ownership and custody of the resource since its creation that are significant for its authenticity, integrity, and interpretation', 'textarea'),
		'dublin_references' => array(true, 'References', ''),
		'dublin_relation' => array(true, 'Relation', ''),
		'dublin_replaces' => array(true, 'Replaces', ''),
		'dublin_requires' => array(true, 'Requires', ''),
		'dublin_tableOfContents' => array(true, 'Table Of Contents', '')
	);

	public function __construct($level) {
		$this->groupId = 'dublin_vocab';
		$this->type_level = $level;
		$this->pmdt_add_metabox( $this->type_level );
	}

	/**
	 * The function which produces the metaboxes for the vocabulary
	 *
	 * @param string Accepting a string so we can distinguish on witch place each metabox is created
	 *
	 * @since 0.10
	 */
	public function pmdt_add_metabox( $meta_position ) {

		x_add_metadata_group( 	$this->groupId,$meta_position, array(
			'label' 		=>	'Dublin Core Metadata',
			'priority' 		=>	'high'
		) );

		x_add_metadata_group( 	$this->groupId.'_extend',$meta_position, array(
			'label' 		=>	'Dublin Core Extended Metadata',
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
				} elseif($details[3] == 'datepicker') {
					x_add_metadata_field( $fieldId, $meta_position, array(
						'group'            => $this->groupId,
						'field_type'       => 'datepicker',
						'label'            => $details[1],
						'description'      => $details[2],
						'display_callback' => null
					) );
				} elseif($details[3] == 'textarea') {
					x_add_metadata_field( $fieldId, $meta_position, array(
						'group'            => $this->groupId,
						'field_type'       => 'textarea',
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

		foreach ( self::$type_extended_properties as $property => $details ) {

			$fieldId = strtolower('pb_' . $property . '_' .$this->groupId. '_extend_' .$meta_position);
			//Checking if we need a dropdown field
			if(!isset($details[3])){
				x_add_metadata_field( $fieldId, $meta_position, array(
					'group'       => $this->groupId.'_extend',
					'label'       => $details[1],
					'description' => $details[2],
					'display_callback' => null
				) );

			}else {
				if ( $details[3] == 'number' ) {
					x_add_metadata_field( $fieldId, $meta_position, array(
						'group'            => $this->groupId.'_extend',
						'field_type'       => 'number',
						'label'            => $details[1],
						'description'      => $details[2],
						'display_callback' => null
					) );
				} elseif($details[3] == 'datepicker') {
					x_add_metadata_field( $fieldId, $meta_position, array(
						'group'            => $this->groupId.'_extend',
						'field_type'       => 'datepicker',
						'label'            => $details[1],
						'description'      => $details[2],
						'display_callback' => null
					) );
				} elseif($details[3] == 'textarea') {
					x_add_metadata_field( $fieldId, $meta_position, array(
						'group'            => $this->groupId.'_extend',
						'field_type'       => 'textarea',
						'label'            => $details[1],
						'description'      => $details[2],
						'display_callback' => null
					) );
				} else {
					x_add_metadata_field( $fieldId, $meta_position, array(
						'group'            => $this->groupId.'_extend',
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
	private function pmdt_get_first( $my_array ) {
		if ( $my_array == '' ) {
			return '';
		} else {
			return $my_array[0];
		}
	}

	/**
	 * Gets the value for the microtags from $this->metadata.
	 *
	 * @since    0.10
	 * @access   public
	 */
	private function pmdt_get_value( $propName ) {
		$array = isset( $this->metadata[ $propName ] ) ? $this->metadata[ $propName ] : '';
		if ( $this->type_level == 'site-meta' ) {
			$value = $this->pmdt_get_first( $array );
		} else {//We always use the get_first function except if our level is metadata coming from pressbooks
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
	public function pmdt_get_metatags() {
		//Getting the information from the database
		$this->metadata = genFunc::get_metadata();
		// title
		$html = "<!-- Dublin Core metatags -->\n";
		// link to DC schema
		$html .= "<link rel='schema.DC' href='http://purl.org/dc/elements/1.1/' />";
		$html .= "<link rel='schema.DC' href='http://purl.org/dc/terms/' />";
		//We walk the array and for each element we see if it matches the fields that we want to visualize
		foreach ( self::$type_properties as $key => $desc ) {
			//Constructing the key for the data
			$dataKey = 'pb_' . $key . '_' . $this->groupId .'_'. $this->type_level;
			//Getting the data
			$val = $this->pmdt_get_value($dataKey);
			//Checking if the value exists
			if(!isset($val) || empty($val)){
				continue;
			}
			//title
			if ( $key == 'dublin_title' ) {
				$html .= "<meta name='DC.title' content='" . $val . "'/>";
			}
			//contributor
			if ( $key == 'dublin_contributor' ) {
				$html .= "<meta name='DC.contributor' content='" . $val . "'/>";
			}
			//coverage
			if ( $key == 'dublin_coverage' ) {
				$html .= "<meta name='DC.coverage' content='" . $val . "'/>";
			}
			//provider
			if ( $key == 'dublin_publisher' ) {
				$html .= "<meta name='DC.publisher' content='" . $val . "' />";
			}
			//audience
			if ( $key == 'dublin_age_range' ) {
				$html .= "<meta name='DC.audience' content='" . $val . "'/>";
			}
			//relation
			if ( $key == 'dublin_learning_resource' ) {
				$html .= "<meta name='DC.relation' content='" . $val . "'/>";
			}
			//relation
			if ( $key == 'dublin_interactivity_type' ) {
				$html .= "<meta name='DC.relation' content='" . $val . "'/>";
			}
			//coverage
			if ( $key == 'dublin_time_required' ) {
				$html .= "<meta name='DC.coverage' content='" . $val . "'/>";
			}
			//rights
			if ( $key == 'dublin_license_url' ) {
				$html .= "<meta name='DC.rights' content='" . $val . "' />";
			}
			//identifier
			if ( $key == 'dublin_bibliography_url' ) {
				$html .= "<meta name='DC.identifier' content='" . $val . "' />";
			}
			//identifier
			if ( $key == 'dublin_questions_answers' ) {
				$html .= "<meta name='DC.identifier' content='" . $val . "' />";
			}
			//creator
			if ( $key == 'dublin_creator' ) {
				$html .= "<meta name='DC.creator' content='" . $val . "' />";
			}
			//date
			if ( $key == 'dublin_date' ) {
				$html .= "<meta name='DC.created' scheme='ISO8601' content='" . date('c', $val) . "' />";
			}
			//description
			if ( $key == 'dublin_description' ) {
				$html .= "<meta name='DC.description' content='" . $val . "' />";
			}

			//format
			$html .= "<meta name='DC.format' content='html' />";

			//language
			if ( $key == 'dublin_language' ) {
				$html .= "<meta name='DC.language' scheme='ISO639-1' content='" . $val . "' />";
			}
			//source
			if ( $key == 'dublin_source' ) {
				$html .= "<meta name='DC.source' content='" . $val . "' />";
			}
			//subject
			if ( $key == 'dublin_subject' ) {
				$html .= "<meta name='DC.subject' content='" . $val . "' />";
			}
			//type
			if ( $key == 'dublin_type' ) {
				$html .= "<meta name='DC.type' scheme='DCMITYPE' content='http://purl.org/dc/dcmitype/" . $val . "' />";
			}
		}
		foreach (self::$type_extended_properties as $key => $desc){
			//Constructing the key for the data
			$dataKey = 'pb_' . $key . '_' . $this->groupId .'_extend_'. $this->type_level;
			//Getting the data
			$val = $this->pmdt_get_value($dataKey);
			$prop = explode('_', $key)[1];
			//Checking if the value exists
			if(!isset($val) || empty($val)){
				continue;
			}
			$html.= "<meta name='DCTERMS.".$prop."'  content=' . $val . ' />";
		}
		return $html;
	}
}