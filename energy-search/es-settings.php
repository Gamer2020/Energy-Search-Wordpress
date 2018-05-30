<?php	
	/** Options Page.*/
	function es_plugin_options() {
		if ( !current_user_can( 'administrator' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		echo '<form method="post" action="options.php">';
		settings_fields( 'es_options_group' );
		$es_cardpage_options = get_option( 'es_cardpage_options' );
		$es_searchpage_options = get_option( 'es_searchpage_options' );
		$es_ebay_AppID_key = get_option( 'es_ebay_AppID_key' );
		$es_tcgplayer_API_key = get_option( 'es_tcgplayer_API_key' );
		
		echo '<h2>Selected Pages</h2>';
		
		echo '<table class="form-table">';
		
		echo '<tr valign="top"><th scope="row">Card page:</th>';
		echo '<td>';
		echo '<select name="es_cardpage_options[page_id]">';
		if( $pages = get_pages() ){
			foreach( $pages as $page ){
				echo '<option value="' . $page->ID . '" ' . selected( $page->ID, $es_cardpage_options['page_id'] ) . '>' . $page->post_title . '</option>';
			}
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';
		
		echo '<tr valign="top"><th scope="row">Search page:</th>';
		echo '<td>';
		echo '<select name="es_searchpage_options[page_id]">';
		if( $pages = get_pages() ){
			foreach( $pages as $page ){
				echo '<option value="' . $page->ID . '" ' . selected( $page->ID, $es_searchpage_options['page_id'] ) . '>' . $page->post_title . '</option>';
			}
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';
		
		echo '<tr valign="top"><th scope="row">Ebay AppID Key:</th>';
		echo '<td>';
		echo '<input type="text" name="es_ebay_AppID_key" value="' . sanitize_text_field(get_option('es_ebay_AppID_key')) . '">';
		echo '</td>';
		echo '</tr>';
		
		echo '<tr valign="top"><th scope="row">TCGplayer API Key:</th>';
		echo '<td>';
		echo '<input type="text" name="es_tcgplayer_API_key" value="' . sanitize_text_field(get_option('es_tcgplayer_API_key')) . '">';
		echo '</td>';
		echo '</tr>';	
		
		echo '</table>';
		echo '<p class="submit">';
		echo '<input type="submit" class="button-primary" value="Save Changes" />';
		echo '</p>';
		echo '</form>';
		echo '</div>';
	}
?>