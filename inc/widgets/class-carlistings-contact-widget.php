<?php
/**
 * Contact Widget
 *
 * @package CarListings
 */

/**
 * Class Contact Widget
 */
class Carlistings_Contact_Widget extends WP_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'carlistings-contact-info',
			'description' => __( 'Display your contact information.', 'carlistings' ),
		);
		parent::__construct(
			'carlistings-contact-info',
			esc_html__( 'Carlistings: Contact Info', 'carlistings' ),
			$widget_ops
		);
	}

	/**
	 * Return an associative array of default values
	 *
	 * These values are used in new widgets.
	 *
	 * @return array Array of default values for the Widget's options
	 */
	public function defaults() {
		return array(
			'time'  => __( '10:00 AM to 5:00 PM', 'carlistings' ),
			'email' => __( 'name@example.com ', 'carlistings' ),
		);
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array $args     An array of standard parameters for widgets in this theme.
	 * @param array $instance An array of settings for this widget instance.
	 *
	 * @return void Echoes it's output
	 **/
	public function widget( $args, $instance ) {
		$instance = wp_parse_args( $instance, $this->defaults() );

		echo $args['before_widget']; // WPCS: XSS OK.

		echo '<ul class="contact">';

		if ( '' !== $instance['time'] ) {

			echo '<li><i class="icofont icofont-clock-time"></i>' . esc_html( $instance['time'] ) . '</li>';
		}

		if ( is_email( trim( $instance['email'] ) ) ) {
			printf(
				'<li><a href="mailto:%1$s"><i class="icofont icofont-envelope"></i>%1$s</a></li>',
				esc_html( $instance['email'] )
			);
		}

		echo $args['after_widget']; // WPCS: XSS OK.
	}


	/**
	 * Update the widget settings.
	 *
	 * @param array $new_instance New configuration values.
	 * @param array $old_instance Old configuration values.
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['time']  = wp_strip_all_tags( $new_instance['time'] );
		$instance['email'] = wp_strip_all_tags( $new_instance['email'] );

		return $instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 *
	 * @param array $instance Instance configuration.
	 *
	 * @return void
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( $instance, $this->defaults() );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'time' ) ); ?>"><?php esc_html_e( 'Working Time:', 'carlistings' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'time' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'time' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['time'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Email:', 'carlistings' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['email'] ); ?>">
		</p>
		<?php
	}
}
