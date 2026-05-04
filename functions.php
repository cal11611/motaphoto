<?php
function theme_enqueue_assets() {
    // Styles
    wp_enqueue_style('myStyle-style', get_stylesheet_directory_uri() . '/css/myStyle.css', array(), filemtime(get_stylesheet_directory() . '/css/myStyle.css'));
    wp_enqueue_style('myFonts-style', get_stylesheet_directory_uri() . '/css/fonts.css', array(), filemtime(get_stylesheet_directory() . '/css/fonts.css'));

    // Deregister jQuery par défaut et charger depuis CDN
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.3.min.js', array(), '3.6.3', true);
    wp_enqueue_script('jquery');

    // Script personnalisé, en dépendance de jQuery
    wp_enqueue_script('myScript', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), '1.0.2', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');

function register_my_menu() {
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}
add_action('after_setup_theme', 'register_my_menu');
// image en avant
add_theme_support('post-thumbnails');

// Chargement swiperJs
function my_theme_enqueue_swiper() {
   wp_enqueue_style('swiper-css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css');
   wp_enqueue_script('swiper-js', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js');
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_swiper');

// Enqueue Font Awesome
if (! function_exists('fa_custom_setup_kit') ) {
  function fa_custom_setup_kit($kit_url = '') {
    foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
      add_action(
        $action,
        function () use ( $kit_url ) {
          wp_enqueue_script( 'font-awesome-kit', $kit_url, [], null );
        }
      );
    }
  }
}

fa_custom_setup_kit('https://kit.fontawesome.com/83e08ef1b5.js');
?>