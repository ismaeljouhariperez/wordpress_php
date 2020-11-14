<?= get_header();?>

<div class="card-deck m-0">
    <div class="row mx-auto">
    <?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-3 d-flex align-items-stretch">
            <div class="card mt-4 border-0">
                <h2>
                    <a class="text-decoration-none" href="<?= the_permalink() ?>"><?= the_title() ?></a> - <?php the_author(); ?>
                </h2>
                <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height: auto;']) ?>
                <div class="card-body px-0">
                    <p class="card-text p-0">
                        <?= the_excerpt() ?>
                        <?= the_content('En voir plus') ?>
                    <p>                                
                    <p class="date card-text text-muted text-height-3"><?= the_date() ?></p>
                </div>
            <div class="card-footer bg-white">
                <small class="text-muted">Temps de lecture :</small>
            </div>
        </div>
    </div>    
    
    <?php endwhile; else : ?>
        <h1> Aucun article publié </h1>
    <?php endif; ?>
    </div>
</div>

<?= get_footer() ?>