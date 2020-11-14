<?= get_header();?>

<!-- TITLE -->
<div class="container-fluid ">
    <?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="row mx-auto">
        <div class="col-12">
            <h1 class="text-left text-secondary display-3"> <?= the_title() ?></h1>
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

<?php endwhile; else : ?>
<h1> Aucun article publié </h1>
<?php endif; ?>

<?= get_footer() ?>