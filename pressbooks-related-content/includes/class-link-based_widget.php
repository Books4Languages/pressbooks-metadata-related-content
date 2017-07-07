<?php
// Register and load the widget
function link_load_widget() {
	register_widget( 'link_based_widget' );
}
//add the widget action
add_action( 'widgets_init', 'link_load_widget' );

// Creating the widget 
class link_based_widget extends WP_Widget {
	/*
	* Constructor of the class, initializes the ID,
	* name and widget description
	*
	*/
	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'link_based_widget', 
		// Widget name will appear in UI
		__('Link based Widget', 'wpb_widget_domain'), 
		// Widget description
		array( 'description' => __( 'this is link based widget', 'wpb_widget_domain' ), ) 
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
		
		echo "<h1>". "LINK OF BOOK BASED" . "</h1>";
		//the shortcode would go here 
	    echo do_shortcode('[related_based]');
		echo $args['after_widget'];
	}
			
	
} // Class widget ends here
