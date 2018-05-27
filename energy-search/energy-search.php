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
	require 'searchbox.php';
	
	/** Hooks go here*/
	/** Hook for options page.*/
	add_action( 'admin_menu', 'es_plugin_menu' );
	add_action( 'admin_init', 'es_options_init' );
	
	/** Shortcodes!*/
	add_shortcode('es_search_page', 'es_search_page');
	add_shortcode('es_card_page', 'es_card_page');
	add_shortcode('es_sets_page', 'es_sets_page');
	add_shortcode('es_search_box', 'es_search_box');
	
	/** Link for options page.*/
	function es_plugin_menu() {
		add_options_page( 'Energy Search Settings', 'Energy Search', 'administrator', 'energy-search-settings', 'es_plugin_options' );
	}
	
	function es_options_init(){
		register_setting('es_options_group','es_cardpage_options','es_options_validate');
		register_setting('es_options_group','es_searchpage_options','es_options_validate');
	}
	
	function es_options_validate( $input ) {
		// do some validation here if necessary
		return $input;
	}
	
?>