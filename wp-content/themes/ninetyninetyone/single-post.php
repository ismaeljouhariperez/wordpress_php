<?php get_header();?>

<!-- TITLE -->
<div class="container-fluid ">
    <?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="row mx-auto">
        <div class="col-12">
            <h1 class="text-left text-secondary display-3"> <?= the_title() ?></h1>
            <?php //if(get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true) === '1'): ?>
                <div class='alert alert-info'>
                    Cet article est sponsorisé
                </div>
            <?php //endif ?>
        </div>
    </div>
</div>
<!-- SEPARATOR -->
<div class="row mx-auto">
    <div class="col-12">
        <hr class="bg-secondary">
    </div>
</div>
<div class="container-fluid ">
    <div class="row mx-auto">    
        <!-- CHAPTER -->
        <div class="col-sm-12 col-md-4 col-lg-6 col-xl-6">
            <h3 class="text-uppercase text-primary">Chapitre</h3>
        
        </div>  
        <!-- DATE -->
        <div class="col-sm-6 col-md-3">
            <p class="text-muted text-sm-center text-md-right text-lg-right text-xl-right"><?= the_date() ?></p>
        </div>
        <!-- READING TIME -->
        <div class="col-sm-6 col-md-3">
            <p class="text-muted text-sm-center text-md-right text-lg-right text-xl-right">Temps de lecture : minutes</p>
        </div>
    </div>
</div>
<!-- IMAGE -->
<figure id="article-image" class="d-flex flex-row justify-content-center">
    <?php the_post_thumbnail('large', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height: auto;']) ?>
</figure>
<!-- CONTENT -->
<div class="container-fluid">
    <div class="row mx-auto mb-3">
        <div class="col-sm-12 col-md-12 col-lg-10 offset-lg-1 col-xl-9 offset-xl-1">
            <p><b><?= the_excerpt() ?></b></p>
        </div>
    </div>
    <div class="row mx-auto">
        <div class="col-sm-12 col-md-12 col-lg-10 offset-lg-1 col-xl-9 offset-xl-1">
            <?= the_content() ?>
        </div>
    </div>
</div>

<?php endwhile; else : ?>
<h1> Aucun article publié </h1>
<?php endif; ?>

<?php previous_post_link() ?>
<?php next_post_link() ?>

<?php 

$sports = get_terms(['taxonomy' => 'sport']);

if ( ! empty( $sports ) && ! is_wp_error( $sports ) ) : ?>

    <?php $terms = array_map(function($term) 
    {
        return $term->term_id;
    }, get_the_terms(get_post(), 'sport'));

    $query = new WP_Query(
    [
        'post__not_in' => [get_the_ID()],
        'post_type' => 'post',
        'posts_per_page' => 3,
        'tax_query' => 
        [
            [
                'taxonomy' => 'sport',
                'field' => 'slug',
                'terms' => $terms
            ]
        ]
    ]);
    while($query->have_posts()) : the_post() ?>
        <h2>Articles relatifs</h2>

    <?php endwhile ; wp_reset_postdata(); //Permet de conserver le même ID d'article 
    
endif ?>



<?php get_footer() ?>
