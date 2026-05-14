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
        <div id = "nav_header_div1">
            <div id = "logo">
                
                <a href="<?php echo esc_url( home_url('/') ); ?>">    
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logo.png' ); ?>" alt="Logo">
                </a>
                
            </div>
            <div id="icon">
                <i class="fa-solid fa-bars" id ="fa-moi"></i>
            </div>
        </div>
        <div id = "nav_header_div2">
            <div id = "nav_header_div1_mobile">
                <div id = "logo_mobile">
                    <a href="<?php echo esc_url( home_url('/') ); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/logo.png'; ?>">
                    </a>
                </div>
                <div id="icon_mobile">
                    <i class="fa-solid fa-x" id = "fa-moi-mobile"></i>
                </div>
            </div>
            <div id = "menu">
            <?php
            wp_nav_menu([
            'theme_location' => 'header',
            'container' => false,
            'class' => 'myMenu'
            ])
            ?>
            </div>
        </div>
        
    </nav>
    