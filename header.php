<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/png" sizes="80x80" href="<?php echo get_stylesheet_directory_uri() . '/img/photo2.png'; ?>">
    <?php wp_head() ?>
</head>
<body>
    <nav id="nav_header">
        <img src="<?php echo get_stylesheet_directory_uri() . '/img/logo.png'; ?>">
        <?php
        wp_nav_menu([
        'theme_location' => 'header',
        'container' => false,
        'class' => 'myMenu'
        ])
        ?>
    </nav>
    <header>
        <?php
            $upload_dir = wp_get_upload_dir(); // Récupère les infos du dossier uploads
            $image_url = $upload_dir['baseurl'] . '/2026/04/nathalie-9.jpeg'; // Construit l'URL complète
        ?>
        <img src="<?php echo esc_url($image_url); ?>" alt="Photo Nathalie">
        <p>PHOTOHRAPHE EVENT</p>    
    </header>