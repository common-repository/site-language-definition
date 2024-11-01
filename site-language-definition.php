<?php
/*
Plugin Name: Site Language Definition
Plugin URI: http://www.wpsos.io/wordpress-plugin-site-language-definition/
Description: Site Language Definition is a simple plugin for forcing the web browser to know what language your site is in.
Author: WPSOS
Version: 1.0
Author URI: http://www.wpsos.io/
*/

add_filter('language_attributes', 'wpsos_sld_modify_html_tag');

//Modifies the attributes of html tag
function wpsos_sld_modify_html_tag($output) {
	$attributes = array();
	
	if ( function_exists( 'is_rtl' ) && is_rtl() )
		$attributes[] = 'dir="rtl"';
	
	if ( !$lang = get_bloginfo('language') ) {
		$lang = "en";
	}
	
	$attributes[] = "lang=\"$lang\"";
	$attributes[] = "xml:lang=\"$lang\"";
	
	return implode(' ', $attributes);
}

add_action('wp_enqueue_scripts', 'wpsos_sld_add_meta_tag_script');

//Add meta tags for languages
function wpsos_sld_add_meta_tag_script(){
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'wpsos-sld', plugin_dir_url( __FILE__ ) . 'layout-control.js', array( 'jquery' ) );
	if ( !$lang = get_bloginfo('language') ) {
		$lang = "en";
	}
	wp_localize_script( 'wpsos-sld', 'Lang', array( 'lang' => $lang ) );
}

/**
 * Add plugin meta links
 * @param array $links
 * @param string $file
 * @return multitype:
 */
function wpsos_sld_set_plugin_meta( $links, $file ) {

	if ( strpos( $file, 'site-language-definition.php' ) !== false ) {

		$links = array_merge( $links, array( '<a href="http://www.wpsos.io/wordpress-plugin-site-language-definition/">' . __( 'Plugin details' ) . '</a>' ) );
		$links = array_merge( $links, array( '<a href="http://www.wpsos.io/">WPSOS - WordPress Security & Hack Repair</a>' ) );		
	}

	return $links;
}
add_filter( 'plugin_row_meta', 'wpsos_sld_set_plugin_meta', 10, 2 );