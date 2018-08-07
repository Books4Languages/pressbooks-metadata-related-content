<?php
// Register and load the widget
function related_load_widget() {
	register_widget( 'related_widget' );
}
// add action of widget
add_action( 'widgets_init', 'related_load_widget' );

// Creating the widget 
class related_widget extends WP_Widget {
	/*
	* Constructor of the class, initializes the ID,
	* name and widget description
	*
	*/
	function __construct() {
		parent::__construct(

		// Base ID of your widget
		'related_widget', 

		// Widget name will appear in UI
		__('Related Widget', 'wpb_widget_domain'), 

		// Widget description
		array( 'description' => __( 'this is related books widget', 'wpb_widget_domain' ), ) 
		);
	}

	/*
	* Creating widget front-end
	* In this function let's show the information 
	* we want to see in the interface
	*
	*/
	public function widget() {
		
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		
		echo "<h1>". "RELATED BOOK" . "</h1>";
		//the shortcode would go here 
		//echo do_shortcode('[related_books ]');
		echo $args['after_widget'];
	}
			
	
} // Class widget ends here
