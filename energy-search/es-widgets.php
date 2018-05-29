<?php
	use Pokemon\Pokemon;
	
	// Register and load the widget
	function wpb_load_widget() {
		register_widget( 'es_search_widget' );
		register_widget( 'es_ebay_widget' );
		register_widget( 'es_tcgplayer_widget' );
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
			
			if(isset($_GET['ID'])){
				
				$options = ['verify' => true];
				$response = Pokemon::Card($options)->find(sanitize_text_field($_GET['ID']));
				$card = $response->toArray();
				
				$es_ebay_AppID_key = get_option( 'es_ebay_AppID_key' );
				
				// API request variables
				
				$endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
				
				$version = '1.0.0';  // API version supported by your application
				
				$appid = $es_ebay_AppID_key;  // Replace with your own AppID
				
				$globalid = 'EBAY-US';  // Global ID of the eBay site you want to search (e.g., EBAY-DE)
				
				$query = "Pokemon " . $card['name'] . " " . $card['set'] . " " . $card['number']; // You may want to supply your own query
				
				$safequery = urlencode($query);  // Make the query URL-friendly
				
				// Construct the findItemsByKeywords HTTP GET call
				
				$apicall = "$endpoint?";
				
				$apicall .= "OPERATION-NAME=findItemsByKeywords";
				
				$apicall .= "&SERVICE-VERSION=$version";
				
				$apicall .= "&SECURITY-APPNAME=$appid";
				
				$apicall .= "&GLOBAL-ID=$globalid";
				
				$apicall .= "&keywords=$safequery";
				
				$apicall .= "&paginationInput.entriesPerPage=1";
				
				$apicall .= "&itemFilter(1).name=ListingType&itemFilter(1).value(0)=FixedPrice"; //I don't want auctions
				
				$apicall .= "&itemFilter(1).value(1)=FixedPrice"; //These have Buy it Now so include them
				
				$apicall .= "&sortOrder=PricePlusShippingLowest"; //I want to see the best deals
				
				// Load the call and capture the document returned by eBay API
				
				//$resp = simplexml_load_file($apicall);			
				
				$xml_file_content = wp_remote_fopen($apicall);
				
				/* Parse XML */
				
				$resp = new SimpleXMLElement($xml_file_content);
				
				if ($resp->ack == "Success") {
					
					$ebayresults = '';
					
					// If the response was loaded, parse it and build links
					
					foreach($resp->searchResult->item as $item) {
						
						$pic   = $item->galleryURL;
						
						$link  = $item->viewItemURL;
						
						$title = $item->title;			
						
						$price = $item->sellingStatus->currentPrice;
						
						// For each SearchResultItem node, build a link and append it to $results
						
						$ebayresults .= "<tr><td><a href=\"$link\"><img src=\"$pic\"></a></td><br><td><a href=\"$link\">Price: $price</a></td></tr>";
						
						$datareturnedcheck = 1;
						
					}					
				}
				
				// If the response does not indicate 'Success,' print an error
				
				else {
					
					$ebayresults  = "Ebay data unobtained. ";
					
					$ebayresults .= "Please refresh the page and try again.";
					
				}
				echo '<img src="' . plugin_dir_url( __FILE__ ). 'img/' . 'RightNow.gif" alt="Ebay:" height="35" width="85"><br>';		
				echo $ebayresults;
				
			}
			
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
	
	class es_tcgplayer_widget extends WP_Widget {
		
		function __construct() {
			parent::__construct(
			
			// Base ID of your widget
			'es_tcgplayer_widget', 
			
			// Widget name will appear in UI
			__('Energy Search - Card TCGPlayer Price', 'wpb_widget_domain'), 
			
			// Widget description
			array( 'description' => __( 'This widget displays the TCGPlayer prices for a card. Only works on the card page.', 'wpb_widget_domain' ), ) 
			);
		}
		
		// Creating widget front-end
		
		public function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
			
			// before and after widget arguments are defined by themes
			echo $args['before_widget'];
			if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
			
			if(isset($_GET['ID'])){
				
				$options = ['verify' => true];
				$response = Pokemon::Card($options)->find(sanitize_text_field($_GET['ID']));
				$card = $response->toArray();
				
				$es_tcgplayer_API_key = get_option( 'es_tcgplayer_API_key' );
				
				$query = "http://partner.tcgplayer.com/x3/pkphl.asmx/p?pk=" . $es_tcgplayer_API_key . "&s=" . $card['set'] . "&p=" . $card['name'];
				
				$xml_file_content = wp_remote_fopen(str_replace(" ","%20",$query));
				
				$parsed_xml = new SimpleXMLElement($xml_file_content);
				
				if($xml_file_content)
				
				{
					
					$results  = 
					
					'<style>
					
					.tab {border: none;}
					
					.tab .first {border: none;}
					
					</style>
					
					<table class="tab"><tr><td class="first">Low</td><td class="first">Avg</td><td class="first">High</td></tr>
					
					<tr>
					
					<td class="first"><a href="' . $parsed_xml->product->link . '" >' . $parsed_xml->product->lowprice . '</a></td>
					
					<td class="first"><a href="' . $parsed_xml->product->link . '" >' . $parsed_xml->product->avgprice . '</a></td>
					
					<td class="first"><a href="' . $parsed_xml->product->link . '" >' . $parsed_xml->product->hiprice . '</a></td>
					
					</tr>
					
					</table>';
						
				}
				
				else
				
				{
					
					$results  = "Could not find the price data! This is being worked on!";
					
				}
				
				echo '<img src="' . plugin_dir_url( __FILE__ ). 'img/' . 'tcgPlayerLogo.png" alt="TCGPlayer:" height="50" width="120"><br>';		
				echo $results;
			}
			
			echo $args['after_widget'];
		}
		
		// Widget Backend 
		public function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			}
			else {
				$title = __( 'TCGPlayer Price', 'wpb_widget_domain' );
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
	} // Class es_tcgplayer_widget ends here
?>