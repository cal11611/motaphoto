<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    // Chargement myStyle.css
    wp_enqueue_style('myStyle-style', get_stylesheet_directory_uri() . '/css/myStyle.css', array(), filemtime(get_stylesheet_directory() . '/css/myStyle.css'));
    // Chargement fonts.css
    wp_enqueue_style('myFonts-style', get_stylesheet_directory_uri() . '/css/fonts.css', array(), filemtime(get_stylesheet_directory() . '/css/fonts.css'));

    }

add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}

// Chargement script.js
function add_script() {
    wp_enqueue_script('myScript', get_stylesheet_directory_uri() . '/js/script.js', array(), '1.0.2', true);
}
add_action('wp_enqueue_scripts', 'add_script');
// Chargement JQuery
function load_jquery_from_google_cdn() {
  
  
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.3.min.js', false, '3.6.0');
    wp_enqueue_script('jquery');
    
  
}
add_action('wp_enqueue_scripts', 'load_jquery_from_google_cdn');
?>