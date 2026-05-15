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


function photo_request_photos() {
    $catSlug = $_POST['category'] ?? '';
    $tagSlug = $_POST['tag'] ?? '';
    
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby'        => 'date',
        'order'          => 'ASC',
    ];
    if ($catSlug) {
        $args['category_name'] = $catSlug;
    }
    if ($tagSlug) {
        $args['tag'] = $tagSlug;
    }
    
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        $html = '<div class="two_columns" id="ajax_return">';
        while ($query->have_posts()) {
            $query->the_post();
            ob_start();
            get_template_part('template_parts/content', 'photo');
            $html .= ob_get_clean();
        }
        $html .= '</div>';
        
        wp_reset_postdata();
        wp_send_json_success(['html' => $html]);
    } else {
        wp_send_json_success(['html' => '<p>rien trouvé du tout</p>']);
    }
    wp_die();
}

add_action('wp_ajax_request_photos', 'photo_request_photos');
add_action('wp_ajax_nopriv_request_photos', 'photo_request_photos');


function load_more_photos() {
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $posts_per_page = 8;

    $args = [
        'post_type'      => 'photo',
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'ASC',
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $html = '';
        while ($query->have_posts()) {
            $query->the_post();
            ob_start();
            get_template_part('template_parts/content', 'photo');
            $html .= ob_get_clean();
        }

        $is_last_page = ($paged >= $query->max_num_pages);

        wp_reset_postdata();

        wp_send_json_success([
            'html'         => $html,
            'is_last_page' => $is_last_page,
        ]);
    } else {
        wp_send_json_success([
            'html'         => '',
            'is_last_page' => true,
        ]);
    }

    wp_die();
}
add_action('wp_ajax_load_more', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more', 'load_more_photos');

function photo_scripts() {
    wp_enqueue_script('photo', get_template_directory_uri() . '/js/photo.js', array('jquery'), '1.0.0', true);
    wp_localize_script('photo', 'photo_js', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'photo_scripts');



function custom_dynamic_meta_tags() {
  if (is_home() || is_front_page()) {
    echo '<meta name="title" content="Mota Photo">' . "\n";
    echo '<meta name="description" content="Mota Photo la pro de la photo">' . "\n";
  }
}
add_action('wp_head', 'custom_dynamic_meta_tags');
?>