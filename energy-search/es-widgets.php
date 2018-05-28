<?php
	use Pokemon\Pokemon;
	
	// Register and load the widget
	function wpb_load_widget() {
		register_widget( 'es_search_widget' );
		register_widget( 'es_ebay_widget' );
	}
	
	add_action( 'widgets_init', 'wpb_load_widget' );
	
	class es_search_widget extends WP_Widget {
		
		function __construct() {
			parent::__construct(
			
			// Base ID of your widget
			'es_search_widget', 
			
			// Widget name will appear in UI
			__('Energy Search - Card Search', 'wpb_widget_domain'), 
			
			// Widget description
			array( 'description' => __( 'This widget contains a search box for searching cards. This only searchs by card name.', 'wpb_widget_domain' ), ) 
			);
		}
		
		// Creating widget front-end
		
		public function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
			
			// before and after widget arguments are defined by themes
			echo $args['before_widget'];
			if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
			
			// This is where you run the code and display the output
			//echo __( 'Hello, World!', 'wpb_widget_domain' );
			$es_searchpage_options = get_option( 'es_searchpage_options' );
		?>
		<!-- The form -->
		<form action="<?php echo get_permalink($es_searchpage_options['page_id']) ;?>">
			<input type="text" placeholder="Search..." name="cardname">
			<button type="submit" name="search" value="search"><i class="fa fa-search"></i></button>
		</form>
		<?php			
			echo $args['after_widget'];
		}
		
		// Widget Backend 
		public function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			}
			else {
				$title = __( 'Search', 'wpb_widget_domain' );
			}
			// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
		}
		
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			return $instance;
		}
	} // Class es_search_widget ends here
	
	
	class es_ebay_widget extends WP_Widget {
		
		function __construct() {
			parent::__construct(
			
			// Base ID of your widget
			'es_ebay_widget', 
			
			// Widget name will appear in UI
			__('Energy Search - Card Ebay Price', 'wpb_widget_domain'), 
			
			// Widget description
			array( 'description' => __( 'This widget displays the lowest Ebay price for a card. Only works on the card page.', 'wpb_widget_domain' ), ) 
			);
		}
		
		// Creating widget front-end
		
		public function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
			
			// before and after widget arguments are defined by themes
			echo $args['before_widget'];
			if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
			
			// This is where you run the code and display the output
			$es_ebay_AppID_key = get_option( 'es_ebay_AppID_key' );
			
			echo $es_ebay_AppID_key;
			
			echo $args['after_widget'];
		}
		
		// Widget Backend 
		public function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			}
			else {
				$title = __( 'Ebay Price', 'wpb_widget_domain' );
			}
			// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
		}
		
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			return $instance;
		}
	} // Class es_ebay_widget ends here
?>