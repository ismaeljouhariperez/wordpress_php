<?= get_header();?>

<div class="card-deck m-0">
    <div class="row mx-auto py-5">
    <?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h1><?= the_title() ?></h1>
            <?= the_content() ?>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <a href="<?= get_post_type_archive_link('post') ?>">Découvrir le blog</a>
        </div>
    </div>    
    
    <?php endwhile; else : ?>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-3 d-flex align-items-stretch">
                <h1> Aucun article publié </h1>
        </div>
    <?php endif; ?>
    </div>
</div>


<?= get_footer() ?>