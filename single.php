<?php get_header(); ?>

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
                <?php get_template_part( 'templates/Images_swiperJs' ); ?>
            </div>
        </div>
    </div>
    <div class = "single_posts_related">
        <h2> Vous aimerez aussi </h2>

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
        ?>
        <div class = "two_columns">
        <?php
        if ($query->have_posts()) {
        while ($query->have_posts()) {
            echo '<div class = "moitie_single">';
            $query->the_post();
            ?>
        <?php
            
        $link = get_the_permalink();
            ?>    
            <a href = "<?php echo $link ?>"> 
            <?php the_post_thumbnail( 'medium' ); ?> 
            </a> 
            <div class = "bigger"><i class="fa-solid fa-expand"></i></div>
            <div class = "eye"><i class="fa-regular fa-eye"></i></div>  
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
        

<?php get_footer(); ?>