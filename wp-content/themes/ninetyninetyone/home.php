<?= get_header();?>

<div class="row mx-auto">        
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card-deck m-0">
        <?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="card mt-4 border-0" style="width: 18rem;">
                <h2>
                    <a class="text-decoration-none" href="<?= the_permalink() ?>"><?= the_title() ?></a> - <?php the_author(); ?>
                </h2>
                <?php the_post_thumbnail('card-header', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height: auto;border-radius:0;']) ?>
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
                <?php endwhile; else : ?>

        </div>
    </div>
</div>
        
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h1> Aucun article publié </h1>
    </div>

    <?php endif; ?>
</div>


<?php nineninetyone_pagination() ?>

</nav>

   

<?= get_footer() ?>