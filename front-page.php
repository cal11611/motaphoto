<?php get_header() ?>
<header>
        <?php
            $upload_dir = wp_get_upload_dir(); // Récupère les infos du dossier uploads
            $image_url = $upload_dir['baseurl'] . '/2026/04/nathalie-9.jpeg'; // Construit l'URL complète
        ?>
        <img src="<?php echo esc_url($image_url); ?>" alt="Photo Nathalie">
        <h1 class = "ph_event">PHOTOHRAPHE EVENT</h1>    
    </header>
<main>
    <div class = "lists">
        <div class="list_half list_half_left">
        <?php $categories = get_categories(); ?>
        <select name = "categories" id = "cat-select">
            <option value = ""> Catégories </option>
            <?php foreach($categories as $category) : ?>
            <option value = "<?= esc_attr($category->slug); ?>" ><?= esc_html($category->name); ?></option>      
            <?php endforeach; ?>
        </select>

        <?php $posttags = get_tags(); ?>
     
        <select name = "formats" id = "format-select">
            <option value = ""> Formats </option>
            <?php foreach($posttags as $tag) : ?>
            <option value="<?= esc_attr($tag->slug); ?>"><?= esc_html($tag->name); ?></option>   
            <?php endforeach; ?>
            
        </select>
        </div>
        <div class="list_half list_half_right">
        <select name = "tri" id = "tri-select">
            <option value = "" > Trier par </option>
            <option value = "asc" > + ancien au + récent </option>
            <option value = "desc" > + récent au + ancien </option>
        </select>
        </div>
        
    </div>
    <?php 
    $args = [
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'orderby'        => 'date',
        'order'          => 'ASC',
        'paged'          => 1,
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) :
    echo '<div class="two_columns" id="ajax_return">';
    while ($query->have_posts()) : $query->the_post();
        get_template_part('template_parts/content', 'photo');
    endwhile;
    echo '</div>';
    endif;

    wp_reset_postdata();
    ?>

    <div class="chargerPlus">
    <button class="chargerPlusBtn" id="load-more">Charger plus</button>
    </div>
</main>
<?php get_footer() ?>