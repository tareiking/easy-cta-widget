<?php
/**
 * Plugin Name: Easy Call to Action Widget
 * Plugin URI: http://www.sennza.com.au/
 * Description: Displays a call to action with a button positioned below text - Style with your own CSS
 * Version: 1.0
 * Author: Sennza Pty Ltd, Tarei King, Bronson Quick, Ryan McCue, Lachlan MacPherson
 * Author URI: http://www.sennza.com.au/
 */

class Easy_CTA_Widget extends WP_Widget {
	function Easy_CTA_Widget() {

		$widget_opts = array(
			'classname' => 'sz-easy-cta-widget',
			'description' => 'Displays a call to action with a button positioned below text.',
		);
			$control_ops = array( 'width' => 600, 'height' => 500 );
		$this->WP_Widget('sz-easy-cta-widget', 'Easy CTA Widget', $widget_opts, $control_ops );
	}

	// default styles, made to be overriden
	// @todo load styles
	function load_sz_styles(){
		return;
	}

	// widget outputs the widget content.
	function widget($args, $instance) {
		extract( $instance, EXTR_SKIP );

		if ( $sz_is_styled ){ $this->load_sz_styles(); }
		?>

		<section class="sz-easy-cta-widget">
			<div class="wrapper">
				<div class="inner">
					<h4 class="heading"><?php echo $cta_text; ?></h3>

					<p class="description">
						<a href="<?php echo $button_link; ?>" class="button sz-cta-button"><?php echo $button_text ?></a>
					</p>

				</div>
			</div>
		</section>

	<?php
	}

	// displays the form which shows on the Widgets management panel.
	function form($instance) {
		$defaults = array(
			'cta_text'		=> 'Enter Description Text',
			'button_text'	=> 'Button Text',
			'button_link'	=> '#',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		extract( $instance, EXTR_SKIP );
		?>
		<p>
		<label for="cta-text">CTA Description</label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'cta_text' ); ?>" name="<?php echo $this->get_field_name( 'cta_text' ); ?>" cols="12" rows="4"><?php echo ( $cta_text ); ?></textarea>
		</p>
		<p>
		<label for="button-text">Button Text:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>">
		</p>
		<label for="button-text">Button Link:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'button_link' ); ?>" name="<?php echo $this->get_field_name( 'button_link' ); ?>" type="text" value="<?php echo esc_attr( $button_link ); ?>">
		</p>
		<?php

	 }

	// updates the widget options when saved.
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['cta_text'] = strip_tags($new_instance['cta_text']);
		$instance['button_text'] = strip_tags($new_instance['button_text']);
		$instance['button_link'] = strip_tags($new_instance['button_link']);
		return $instance;
	}
}

// Load and Register the widget
add_action('widgets_init', 'sz_cta_widget_load');

function sz_cta_widget_load() {
	register_widget('Easy_CTA_Widget');
}