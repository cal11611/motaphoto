<?php get_header() ?>
<header>
        <?php
            $upload_dir = wp_get_upload_dir(); // Récupère les infos du dossier uploads
            $image_url = $upload_dir['baseurl'] . '/2026/04/nathalie-9.jpeg'; // Construit l'URL complète
        ?>
        <img src="<?php echo esc_url($image_url); ?>" alt="Photo Nathalie">
        <h1 class = "ph_event">PHOTOHRAPHE EVENT</h1>    
    </header>
<main>
<?php get_template_part( 'templates/photos' ); ?>
</main>
<?php get_footer() ?>