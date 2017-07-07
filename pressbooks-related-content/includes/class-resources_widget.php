<?php
// Register and load the widget
function resources_load_widget() {
	register_widget( 'resources_widget' );
}
add_action( 'widgets_init', 'resources_load_widget' );

// Creating the widget 
class resources_widget extends WP_Widget {
	/*
	* Constructor of the class, initializes the ID,
	* name and widget description
	*
	*/
	function __construct() {
		parent::__construct(

		// Base ID of your widget
		'resources_widget', 

		// Widget name will appear in UI
		__('Resources Widget', 'wpb_widget_domain'), 

		// Widget description
		array( 'description' => __( 'This is resources widget', 'wpb_widget_domain' ), ) 
		);
	}

	/*
	* Creating widget front-end
	* In this function let's show the information 
	* we want to see in the interface
	*
	*/
	public function widget( $args, $instance ) {
		extract( $args );
		//We see if the checkboxes have been selected
		$all = $instance[ 'all' ] ? 'true' : 'false';
		$videos = $instance[ 'videos' ] ? 'true' : 'false';
	    $audios = $instance[ 'audios' ] ? 'true' : 'false';
	    $activities = $instance[ 'activities' ] ? 'true' : 'false';
	    $exercises = $instance[ 'exercises' ] ? 'true' : 'false';
	    $biblio = $instance[ 'biblio' ] ? 'true' : 'false';
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		// title of this widget
		echo "<h1>". "RESOURCES" . "</h1>";
		//If the checkbox has been selected then we show the information of the checkbox( shortcodes)
		if( 'on' == $instance[ 'all' ] ) {
			//echo __('has seleccionado all', 'wpb_widget_domain' );
			//the shortcode would go here
			echo do_shortcode('[related_content type="all"]')
			echo "</br>";
		}if('on' == $instance[ 'videos' ]){
      		//echo __('has seleccionado videos', 'wpb_widget_domain' );
      		//the shortcode would go here
      		echo do_shortcode('[related_content type="rc_videos"]');
      		echo "</br>";
		}
	    if('on' == $instance[ 'audios' ]){
	     // echo __('has seleccionado audios', 'wpb_widget_domain' );
	    	//the shortcode would go here
	    	echo do_shortcode('[related_content type="rc_audios"]');
	        echo "</br>";
	    }
	    if('on' == $instance[ 'exercises' ]){
	      //echo __('has seleccionado exercises', 'wpb_widget_domain' );
	    	//the shortcode would go here
	    	echo do_shortcode('[related_content type="rc_exercises"]');
	      	echo "</br>";
	    }
	    if('on' == $instance[ 'activities' ]){
	      //echo __('has seleccionado activities', 'wpb_widget_domain' );
	    	//the shortcode would go here
	    	echo do_shortcode('[related_content type="rc_activities"]');
	     	echo "</br>";
	    }
	    if('on' == $instance[ 'biblio' ]){
	      //echo __('has seleccionado biblio', 'wpb_widget_domain' );
	    	//the shortcode would go here
	    	echo do_shortcode('[related_content type="rc_biblio"]');
	      	echo "</br>";
	    }
			
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	/*
	*
	*In this function we create the form that will be displayed in the backend.
	* When the user selects and drags the wdget to a zone will leave this form
	*
	*
	*/
	public function form( $instance ) {
		
		// Widget admin form
		?>
		<p>
		<!-- The label of this widget-->
		<label ><?php _e( 'Choose one option:' ); ?></label> 
		</br>
		</br>
		<!-- all the checkbox of this widget-->
		<input class="checkbox" type="checkbox" <?php checked( $instance[ 'all' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'all' ); ?>" name="<?php echo $this->get_field_name( 'all' ); ?>" /> All
		</br>
		<input class="checkbox" type="checkbox" <?php checked( $instance[ 'videos' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'videos' ); ?>" name="<?php echo $this->get_field_name( 'videos' ); ?>" /> Videos
		</br>
		<input class="checkbox" type="checkbox" <?php checked( $instance[ 'audios' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'aduios' ); ?>" name="<?php echo $this->get_field_name( 'audios' ); ?>" /> Audios
		</br>
		<input class="checkbox" type="checkbox" <?php checked( $instance[ 'activities' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'activities' ); ?>" name="<?php echo $this->get_field_name( 'activities' ); ?>" /> Activities
		</br>
		<input class="checkbox" type="checkbox" <?php checked( $instance[ 'exercises' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'exercises' ); ?>" name="<?php echo $this->get_field_name( 'exercises' ); ?>" /> Exercises
		</br>
		<input class="checkbox" type="checkbox" <?php checked( $instance[ 'biblio' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'biblio' ); ?>" name="<?php echo $this->get_field_name( 'biblio' ); ?>" /> Bibliography
		</br>
		</br>
		
		</p>
		<?php 
	}
		
	/*
	*
	* Updating widget replacing old instances with new
	* This function is responsible for updating the information in the checkboxes
	*
	*/
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['all'] = $new_instance['all'];
		$instance['videos'] = $new_instance['videos'];
		$instance['audios'] = $new_instance['audios'];
		$instance['activities'] = $new_instance['activities'];
		$instance['exercises'] = $new_instance['exercises'];
		$instance['biblio'] = $new_instance['biblio'];
		return $instance;
	}
} // Class widget ends here
