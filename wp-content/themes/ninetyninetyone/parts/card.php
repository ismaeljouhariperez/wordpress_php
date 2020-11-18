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