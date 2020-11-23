<?php 

Admin\View::navigate_tabs();
$categories = Admin\View::search_categories();

?>

<!-- TITLE -->
<div class="row mx-auto">
    <div class="col-12 text-center d-flex flex-column align-items-center justify-content-center">
        <h1 class="py-3">Stories</h1>
        <h2 class="display-6 col-6">Explore all our articles</p>
    </div>
</div>
<!-- NAV -->
<div class="d-flex inline-flex justify-content-center py-5">
    <ul class="nav nav-tabs display-8 col-5 d-flex justify-content-between border-0" role="tablist">
        <li class="nav-item">
            <a href="#" onclick="toggleAll()" id="test" class="text-secondary tab-select">All</a>
        </li>
        <?php 
        foreach($categories as $category) { ?> 
        <li class="nav-item" >
            <a href="#<?= $category->slug ?>" class="tab-toggle text-secondary tab-select" role="tab" data-toggle="tab" onclick="toggleCat()">
            <?= $category->name ?>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>
<!-- TAB CONTENT -->
<div class="tab-content" >
    <!-- CARDS -->
    <div class="card-deck m-0" id="all">
        <?php while ( have_posts() ) :  the_post() ; ?>
            <div class="card col-4 border-0">       
                <figure class="thumbnail">       
                <a href="<?= the_permalink() ?>">
                    <?php the_post_thumbnail('card-header', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height: auto;border-radius:0;']) ?> 
                </a>
                </figure>
                <?php 
                    $posttags = get_the_tags();
                    if ($posttags) : foreach($posttags as $tag) { ?>
                <em class="py-1 text-center text-secondary slug"><?= $tag->name ?></em>
                    <?php } endif ?>
                <h2 class="display-5 text-center">
                    <a class="text-decoration-none" href="<?= the_permalink() ?>"><?= the_title() ?></a> 
                </h2>      
                <p class="display-7 text-center">by <?php the_author(); ?></p>       
            </div>      
        <?php endwhile; ?>
    </div>    
</div>     
<!-- TAB CONTENT -->
<div class="tab-content m-0 p-0" id="away">
    <?php foreach($categories as $category) { ?>
        <div class="tab-pane" id="<?= $category->slug ?>" >
            <!-- CARDS -->
            <div class="card-deck m-0">
                <!-- PHP QUERY AND LOOP -->
                <?php   
                $display_categories = Admin\View::search_posts(100, $category->slug); 
                while ( $display_categories->have_posts() ) :  $display_categories->the_post() ; ?>
                <div class="card col-4 border-0" id="<?= get_the_category() ?>">
                    <figure class="thumbnail">       
                        <a href="<?= the_permalink() ?>">
                            <?php the_post_thumbnail('card-header', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height: auto;border-radius:0;']) ?> 
                        </a>    
                    </figure>
                        <?php $posttags = get_the_tags(); if ($posttags) : foreach($posttags as $tag) { ?>
                            <em class="py-1 text-center text-secondary slug"><?= $tag->name ?></em>
                    <?php } endif ?>
                    <h2 class="display-5 text-center">
                        <a class="text-decoration-none" href="<?= the_permalink() ?>"><?= the_title() ?></a> 
                    </h2>
                    <p class="display-7 text-center">by <?php the_author(); ?></p>
                </div>   
            </div> 
        </div>
    <?php endwhile; } ?> 
    <?php //get_search_form() ?>
</div>
