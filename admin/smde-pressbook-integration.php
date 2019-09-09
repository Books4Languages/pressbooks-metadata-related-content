<?php

/**
 * Pressbooks Integration
 *
 * All the pressbook metadata
 *
 * @package simple-metadata-education
 * @subpackage admin/pressbook-integration
 * @since 1.2.1
 */

 // Used for Pressbook integration
 use Pressbooks\Book;
 use Pressbooks\Metadata;
 use function Pressbooks\Metadata\get_section_information;
 use function Pressbooks\Metadata\section_information_to_schema;


 /**
  * Get from pressbook the metadata
  *
  * @since 1.2.1
  * @return string the html to print
  */
 function smde_get_pressbooks_metadata(){

  // Code from pressbook function add_json_ld_metadata
  $context = is_singular( [ 'front-matter', 'part', 'chapter', 'back-matter' ] ) ? 'section' : 'book';
  if ( $context === 'section' ) {
    // Front matter, part, chapter, back-matter
  	global $post;
  	$section_information = get_section_information( $post->ID );
  	$book_information = Book::getBookInformation();
  	$metadata = section_information_to_schema( $section_information, $book_information );
  } else {
    // Book
  	$metadataObj = new Metadata();
    $metadata = $metadataObj->jsonSerialize(); // get the array serializable
    // Delete the tag that we already use
    unset($metadata['name']);
  }

  // Delete tags that we already use
  unset($metadata['@context']);
  unset($metadata['@type']);
  unset($metadata['reviewedBy']);



  return $metadata;
 }
