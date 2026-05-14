<?php get_header(); ?>
<main>
<div class="main_single">
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <div class="single_infos">
        <div>
            <input type = "hidden" id = "hide" value = "<?php echo htmlspecialchars( get_field('reference')); ?>">
            <h1 class="post-title"><?php the_title(); ?></h1>
            <p class="single-info"  >
                Référence :  <?php echo get_field('reference'); ?> 
            </p>
            <?php
                $postcat = get_the_category();
            if ($postcat) {  
            foreach($postcat as $cat) {
                echo '<p class="single-info"> Catégorie :  ' .$cat->name . '</p> '; 
            }
            } 
            ?>
            </p>
            <?php
            $posttags = get_the_tags();
            if ($posttags) {  
            foreach($posttags as $tag) {
                echo '<p class="single-info"> Format :  ' .$tag->name . '</p> '; 
            }
            }
            
            ?>
            <p class="single-info">
                Type :  <?php echo get_field('type'); ?> 
            </p>
            <p class="single-info">
                Année :  <?php the_time('Y'); ?>
            </p>
    </div>
    </div>
    <div class="single_portrait">
    <?php the_post_thumbnail( 'medium' ); ?>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
    </div>
    <div class = "single_contact">
        <div class = "single_contact1">
            <p> Cette photo vous intéresse ? </p>
            <button id="contact_button">Contact</button>
        </div> 
        <div class = "single_contact2">
            <div class = "single_contact2_1">
                <?php get_template_part( 'template_parts/Images_swiperJs' ); ?>
            </div>
        </div>
    </div>
    
        <h2 class = "norm"> Vous aimerez aussi </h2>

        <?php 
$args = [
    'post_type' => 'photo',
    'post__not_in' => [get_the_ID()],
    'category_name' => $cat->name,
    'posts_per_page' => 2,
    'orderby' => 'rand',
    'order' => 'ASC'
];
$query = new WP_Query($args);

if ($query->have_posts()) :
  echo '<div class="two_columns">';
  while ($query->have_posts()) : $query->the_post();
    get_template_part('template_parts/content', 'photo');
  endwhile;
  echo '</div>';
endif;

wp_reset_postdata();
?>
        
        
        
        
        
</main>
<?php get_footer(); ?>