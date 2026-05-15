
<div class="moitie">
  <a href="<?php the_permalink(); ?>">
    <?php 
      // Récupère le titre du post pour l'attribut alt
      $alt_text = get_the_title();

      // Affiche la miniature avec l'attribut alt personnalisé
      echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', ['alt' => esc_attr($alt_text)]); 
    ?>
  </a>

  <div class="bigger child-element">
    <i class="fa-solid fa-expand"></i>
  </div>
  <div class="eye child-element">
    <i class="fa-regular fa-eye"></i>
  </div>
  <div class="infos">
    <h3><?php the_title(); ?></h3>
    <?php 
      $postcat = get_the_category();
      if ($postcat) {
        foreach ($postcat as $cat) {
          echo '<h3>' . esc_html($cat->name) . '</h3>';
        }
      } 
    ?>
  </div>
</div>