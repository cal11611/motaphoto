<?php
// menus
function register_my_menu() {
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}
add_action('after_setup_theme', 'register_my_menu');

// image en avant
add_theme_support('post-thumbnails');

// enléve la navigation sur lightbox single
function single_enleve_navigation() {
    wp_enqueue_script('single-enleve-navigation', get_template_directory_uri() . '/js/script.js', ['jquery'], '1.0', true);

    wp_localize_script( 'single-enleve-navigation', 'pageData', [
        'isSingle' => is_single(),  // true si vous êtes sur une page d'article unique
    ]);
}
add_action('wp_enqueue_scripts', 'single_enleve_navigation');

function theme_enqueue_assets() {

    // Styles
    wp_enqueue_style('myStyle-style', get_stylesheet_directory_uri() . '/css/myStyle.css', array(), filemtime(get_stylesheet_directory() . '/css/myStyle.css'));
    wp_enqueue_style('myFonts-style', get_stylesheet_directory_uri() . '/css/fonts.css', array(), filemtime(get_stylesheet_directory() . '/css/fonts.css'));
    
    // jQuery depuis CDN (déregister WordPress par défaut)
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.3.min.js', array(), '3.6.3', true);
    wp_enqueue_script('jquery');
    
    // Select2
    wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
    wp_enqueue_script('select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), null, true);
    
    // Swiper
    wp_enqueue_style('swiper-css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js', array('jquery'), null, true);
    
    // script select
    wp_enqueue_script('myScript', get_stylesheet_directory_uri() . '/js/script.js', array('jquery', 'select2-js', 'swiper-js'), '1.0.2', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');

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


// lightbox
function lightbox_photos() {
    $id = $_POST['id'] ?? '';
$html = '';

$args = [
    'post_type' => 'photo',
];

if ($id) {
    $args['p'] = intval($id);
}

$query = new WP_Query($args);

if ($query->have_posts()) {
    $query->the_post();

    $name = get_the_title();

    
    $categories = get_the_terms($id, 'category');  

    $cat_names = [];
    if ($categories && !is_wp_error($categories)) {
        foreach ($categories as $cat) {
            $cat_names[] = $cat->name;
        }
    }

    
    $cat_list = !empty($cat_names) ? implode(', ', $cat_names) : 'Pas de catégorie';

    ob_start();
    
    echo get_the_post_thumbnail(get_the_ID(), 'large', ['alt' => esc_attr($name)]);
    echo '<div class="infos visible"><h3>' . esc_html($cat_list) . '</h3><h3>' . esc_html($name) . '</h3></div>';
    $html = ob_get_clean();

    wp_reset_postdata();

    wp_send_json_success(['html' => $html]);
} else {
    wp_send_json_success(['html' => '<p>Photo introuvable</p>']);
}

wp_die();
}
add_action('wp_ajax_lightbox_photos', 'lightbox_photos');
add_action('wp_ajax_nopriv_lightbox_photos', 'lightbox_photos');


/***********************************************************************************************/
function photo_request_photos() {
    
    $catSlug = $_POST['category'] ?? '';
    $tagSlug = $_POST['tag'] ?? '';
    $sens = $_POST['sens'] ?? 'ASC';
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    $args = [
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'orderby'        => 'date',
        'order'          => $sens,
        'paged'          => $paged,
    ];

    if ($catSlug) {
        $args['category_name'] = sanitize_text_field($catSlug);
    }
    if ($tagSlug) {
        $args['tag'] = sanitize_text_field($tagSlug);
    }

    $query = new WP_Query($args);

    $html = '';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ob_start();
            get_template_part('template_parts/content', 'photo');
            $html .= ob_get_clean();
        }
        wp_reset_postdata();
        // Total pages
        $max_pages = $query->max_num_pages;
        wp_send_json_success([
            'html' => $html,
            'max_pages' => $max_pages,
            'current_page' => $paged,
        ]);
    } else {
        wp_send_json_success([
            'html' => '<p>Aucune photo trouvée</p>',
            'max_pages' => 0,
            'current_page' => $paged,
        ]);
    }
    wp_die();
}
add_action('wp_ajax_request_photos', 'photo_request_photos');
add_action('wp_ajax_nopriv_request_photos', 'photo_request_photos');

function photo_scripts() {
    wp_enqueue_script('photo', get_template_directory_uri() . '/js/photo.js', array('jquery'), '1.0.0', true);
    wp_localize_script('photo', 'photo_js', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'photo_scripts');


/************************************************************************************************/
function custom_dynamic_meta_tags() {
  if (is_home() || is_front_page()) {
    echo '<meta name="title" content="Mota Photo">' . "\n";
    echo '<meta name="description" content="Mota Photo la pro de la photo">' . "\n";
  }
}
add_action('wp_head', 'custom_dynamic_meta_tags');
?>