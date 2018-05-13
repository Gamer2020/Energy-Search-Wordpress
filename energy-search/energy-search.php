<?php
	/*
		Plugin Name:  Energy Search
		Plugin URI:	https://github.com/Gamer2020/Energy-Search
		Description:  A Pokemon TCG plugin for Wordpress made with the Pokemon TCG API!
		Version:      0.1
		Author:       Gamer2020
		Author URI:   https://www.Gamer2020.net
		License:      GPL2
		License URI:  https://www.gnu.org/licenses/gpl-2.0.html
	*/
?>
<?php
	
	use Pokemon\Pokemon;
	require __DIR__ . '/vendor/autoload.php';
	
	require 'card.php';
	
	/** Hooks go here*/
	/** Hook for options page.*/
	add_action( 'admin_menu', 'es_plugin_menu' );
	add_action( 'admin_init', 'es_options_init' );
	
	/** Shortcodes!*/
	add_shortcode('es_db_page', 'es_database_page');
	add_shortcode('es_card_page', 'es_card_page');
	
	/** Link for options page.*/
	function es_plugin_menu() {
		add_options_page( 'Energy Search Options', 'Energy Search', 'administrator', 'energy-search-options-identifier', 'es_plugin_options' );
	}
	
	function es_options_init(){
		register_setting('es_options_group','es_cardpage_options','es_options_validate');
	}
	
	function es_options_validate( $input ) {
		// do some validation here if necessary
		return $input;
	}
?>
<?php	
	/** Options Page.*/
	function es_plugin_options() {
		if ( !current_user_can( 'administrator' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		echo '<div class="wrap">';
		echo '<form method="post" action="options.php">';
		settings_fields( 'es_options_group' );
		$cardpageoptions = get_option( 'es_cardpage_options' );
		echo '<table class="form-table">';
		echo '<tr valign="top"><th scope="row">Card page:</th>';
		echo '<td>';
		echo '<select name="es_cardpage_options[page_id]">';
		if( $pages = get_pages() ){
			foreach( $pages as $page ){
				echo '<option value="' . $page->ID . '" ' . selected( $page->ID, $cardpageoptions['page_id'] ) . '>' . $page->post_title . '</option>';
			}
		}
		echo '</select>';
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
<?php
	function es_database_page(){
		
		$options = ['verify' => true];
		
		$response = Pokemon::Set()->where(['standardLegal' => 'true'])->all();
		foreach ($response as $model) {
			//print_r($model->toArray());
			$set = $model->toarray();
			echo($set['name'] . "<br>");
		}
		
	}
?>