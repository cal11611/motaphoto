
<div class="moitie">
  <a href="<?php the_permalink(); ?>">
    <?php the_post_thumbnail('medium'); ?>
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