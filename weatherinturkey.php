<?php
/*
Plugin Name: Weather in Turkey
Plugin URI: http://lycie.com
Description: Displays weather infortmation for Turkish cities.
Author: Onur Kocatas
Version: 2.2
Author URI: http://lycie.com
*/

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'weather_in_turkey_load_widgets' );

/* Function that registers our widget. */
function weather_in_turkey_load_widgets() {
	register_widget( 'Weather_In_Turkey_Widget' );
}

class Weather_In_Turkey_Widget extends WP_Widget {
	function Weather_In_Turkey_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Weather_In_Turkey', 'description' => 'Displays weather infortmation for Turkish cities.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300,  'id_base' => 'weather-in-turkey-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'weather-in-turkey-widget', 'Weather in Turkey', $widget_ops, $control_ops );
	}
	
	
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$town = $instance['town'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		
		echo '<div align="center"><img src="http://www.dmi.gov.tr/sunum/imgdurumgor-a1-g-en.aspx?merkez='.$town.'&renkC=999&renkT=999&renkZ=fff"/><br/><a href="http://www.iwasinturkey.com/weather-in-turkey">Weather in Turkey</a></div>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['town'] = strip_tags( $new_instance['town'] );

		return $instance;
	}
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Weather in Turkey', 'town' => 'ISTANBUL');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'town' ); ?>">City name(Uppercase):</label>
			<input id="<?php echo $this->get_field_id( 'town' ); ?>" name="<?php echo $this->get_field_name( 'town' ); ?>" value="<?php echo $instance['town']; ?>" style="width:100%;" />
		</p>
		<?php
	}
}
?>