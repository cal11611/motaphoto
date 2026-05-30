<?php get_template_part( 'template_parts/modale' ); ?> 
<?php wp_footer() ?>
<nav id="nav_footer">      
<?php
wp_nav_menu([
   'theme_location' => 'footer',
   'container' => false
])
?>
</nav>
<div class="lightbox">
    <div class="lightbox_controls">
        <button id="prev-photo" aria-label="Photo précédente"><img src = "<?php echo esc_url( get_stylesheet_directory_uri() . '/img/prec.png' ); ?>" alt="Précédente"></button>
        <button id="next-photo" aria-label="Photo suivante"><img src = "<?php echo esc_url( get_stylesheet_directory_uri() . '/img/suiv.png' ); ?>" alt="Suivante"></button>
        <button id="close-photo" aria-label="Fermer lightbox"><img src = "<?php echo esc_url( get_stylesheet_directory_uri() . '/img/close.png' ); ?>" alt="Fermer"></button>
    </div>
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <div class="lightbox_image" id="ajax_image_return">
        
    </div>
</div>
</body>
</html>