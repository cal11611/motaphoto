
<?php
$args = [
  'post_type' => 'photo',
  'posts_per_page' => 16,
  'orderby' => 'date', 
  'order' => 'ASC'
];
$query = new WP_Query($args);
?>
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php
        if ($query->have_posts()) {
        while ($query->have_posts()) {
            echo '<div class="swiper-slide">';
            $query->the_post();
            ?>
        <?php
            
        $link = get_the_permalink();
            ?>
            <a href = "<?php echo $link ?>"> 
            <?php the_post_thumbnail( 'medium' ); ?> 
            </a>
            
        
            
        <?php
    echo '</div>';

  }  
  wp_reset_postdata();
  
}
?>
</div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

