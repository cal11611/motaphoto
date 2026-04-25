<?php get_header(); ?>
<div class="main single">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="post">
<h1 class="post-title"><?php the_title(); ?></h1>
<p class="post-info">
Posté le <?php the_date(); ?> dans <?php the_category(', '); ?> par <?php the_author(); ?>.
</p>
<?php the_post_thumbnail( 'medium' ); ?>
</div>
<?php endwhile; ?>
<?php endif; ?>
</div>

<?php get_footer(); ?>