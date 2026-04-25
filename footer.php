<?php get_template_part( 'templates/modale' ); ?> 
<?php wp_footer() ?>
<nav id="nav_footer">      
<?php
wp_nav_menu([
   'theme_location' => 'footer',
   'container' => false
])
?>
</nav>
</body>
</html>