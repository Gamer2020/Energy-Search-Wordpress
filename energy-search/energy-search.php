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
	
use pokemon-tcg-sdk-php\Pokemon;

/** Hooks go here*/
/** Hook for options page.*/
add_action( 'admin_menu', 'es_plugin_menu' );

/** Link for options page.*/
function es_plugin_menu() {
	add_options_page( 'Energy Search Options', 'Energy Search', 'administrator', 'energy-search-options-identifier', 'es_plugin_options' );
}

/** Options Page.*/
function es_plugin_options() {
	if ( !current_user_can( 'administrator' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}
?>