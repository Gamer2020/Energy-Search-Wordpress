<?php
	/*
		Plugin Name:  Energy Search
		Plugin URI:	https://www.EnergySearch.Gamer2020.net
		Description:  A Pokemon TCG plugin for Wordpress made with the Pokemon TCG API!
		Version:      0.2
		Author:       Gamer2020
		Author URI:   https://www.Gamer2020.net
		License:      GPL2
		License URI:  https://www.gnu.org/licenses/gpl-2.0.html
	*/
?>
<?php
	
	use Pokemon\Pokemon;
	require __DIR__ . '/vendor/autoload.php';
	
	require 'poketcgfunctions.php';
	require 'settings.php';
	require 'card.php';
	require 'search.php';
	require 'sets.php';
	require 'es-widgets.php';
	require 'es-searchbox.php';
	require 'es-short-codes.php';
	require 'es-text-editor-buttons.php';
	
	/** Hooks go here*/
	/** Hook for options page.*/
	add_action( 'admin_menu', 'es_plugin_menu' );
	add_action( 'admin_init', 'es_options_init' );
	/** Other hooks */
	add_filter( 'pre_get_document_title', 'es_handle_document_title', 10 );
	add_filter( 'wpseo_title', 'es_handle_document_title', 15 );
	add_filter( 'the_title', 'es_handle_post_title' );
	
	/** Shortcodes!*/
	add_shortcode('es_search_page', 'es_search_page');
	add_shortcode('es_card_page', 'es_card_page');
	add_shortcode('es_sets_page', 'es_sets_page');
	add_shortcode('es_search_box', 'es_search_box');
	add_shortcode('es_shortcode_card_image', 'es_shortcode_card_image');
	add_shortcode('es_shortcode_card_name', 'es_shortcode_card_name');
	
	/** Link for options page.*/
	function es_plugin_menu() {
		add_options_page( 'Energy Search Settings', 'Energy Search', 'administrator', 'energy-search-settings', 'es_plugin_options' );
	}
	
	function es_options_init(){
		register_setting('es_options_group','es_cardpage_options','es_options_validate');
		register_setting('es_options_group','es_searchpage_options','es_options_validate');
		register_setting('es_options_group','es_ebay_AppID_key','es_options_text_validate');
		register_setting('es_options_group','es_tcgplayer_API_key','es_options_text_validate');
	}
	
	function es_options_validate($input) {
		// do some validation here if necessary
		//return sanitize_text_field($input);
		return $input;
	}
	
	function es_options_text_validate($input) {
		// do some validation here if necessary
		return sanitize_text_field($input);
	}
	
	function es_handle_document_title($title) {
		$es_cardpage_options = get_option( 'es_cardpage_options' );
		
		$newtittle = "";
		
		if (get_the_ID() == $es_cardpage_options['page_id']){
			
			if(isset($_GET['ID'])){
				
				$options = ['verify' => true];
				$response = Pokemon::Card($options)->find(sanitize_text_field($_GET['ID']));
				$card = $response->toArray();
				
				$newtittle =  $card['name'] . ' | ' . get_bloginfo('name');
				
			}
			
		}
		else
		{
			$newtittle = $title;
		}
		
		
		return $newtittle;  
	}
	
	function es_handle_post_title($title) {
		$es_cardpage_options = get_option( 'es_cardpage_options' );
		$es_searchpage_options = get_option( 'es_searchpage_options' );
		
		$newtittle = "";
		
		if (is_page() && in_the_loop() && (get_the_ID() == $es_cardpage_options['page_id'])){
			
			$newtittle =  "";
			
			/* 			if(isset($_GET['ID'])){
				
				$options = ['verify' => true];
				$response = Pokemon::Card($options)->find(sanitize_text_field($_GET['ID']));
				$card = $response->toArray();
				
				$newtittle =  $card['name'];
				
			} */
		}
		elseif (is_page() && in_the_loop() && (get_the_ID() == $es_searchpage_options['page_id'])){
			
			$newtittle =  "";
			
		}
		else
		{
			$newtittle = $title;
		}
		
		
		return $newtittle;  
	}
	
?>