<!DOCTYPE html>
<html lang="fr">
<head>
    <?php wp_head() ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <nav id="navigation">
        <img src="<?php echo get_stylesheet_directory_uri() . '/img/logo.png'; ?>">
<?php
wp_nav_menu([
   'theme_location' => 'header',
   'container' => 'false'
])
?>
</nav>
    