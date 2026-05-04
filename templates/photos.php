<?php
$args = [
  'post_type' => 'photo',
  'posts_per_page' => 16,
  'orderby' => 'date', 
  'order' => 'ASC'
];
$query = new WP_Query($args);
?>
<div class = "two_columns">
<?php
if ($query->have_posts()) {
  while ($query->have_posts()) {
    echo '<div class = "moitie">';
    $query->the_post();
    // Afficher titre
    //the_title();
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
else {
    echo 'rien trouvé';
  }

?>
</div>