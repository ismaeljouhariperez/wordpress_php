
<?php 

$original = Admin\View::search_slug('original');
$featured = Admin\View::search_slug('featured');
$sponsored = Admin\View::search_slug('sponsored');

$latest_posts = Admin\View::display_latest_posts(10);

?>

<!-- SUB HEADER -->
<div class="row mx-auto pt-5 pb-4">
    <div class="col-12 text-center">
        <img class="main-logo" src="<?=get_template_directory_uri()?>/assets/images/Logo-Offshore.svg" alt="">
        <p class="text-right">Adventures to get you inspired</p>
    </div>
</div>
<!-- PHP LOOP -->
<?php while ( $featured->have_posts() ): $featured->the_post() ; ?>
<!-- FEATURED ARTICLE -->
<article id="post-<?php $featured->the_ID(); ?>" class="article article-has-backgroundThumb">
    <?php if(has_post_thumbnail()) 
    {
        $featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) , '' );
        $featured_img_url = $featured_img[0];
    } ?>
    <div class="backgroundThumb" style="background-image:url('<?= $featured_img_url ?>');">
        <em class="text-white text-underline text-center display-6 featured">Featured Story</em>
        <a href="<?= the_permalink() ?>">
            <h1 class="display-2 text-white text-center"><?= the_title() ?></h1>
        </a>
        <p class="text-white display-7">by <?php the_author() ?></p>
        <a href="<?= the_permalink() ?>" class="mt-5 py-2 px-3 btn btn-outline-info">Read the story</a>
    </div> 
</article>
<!-- PHP END LOOP -->
<?php endwhile; get_header();?>
<!-- MAIN CONTENT -->
<div class="container">
    <div class="row mx-auto pt-5">
        <!-- PHP LOOP -->
        <?php while ( $original->have_posts() ): $original->the_post() ; ?>
        <div class="col-xl-6">
            <figure id="main-content">
                <a href="<?= the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
            </figure>        
        </div>
        <div class="col-xl-6">
            <em class="text-secondary slug">Original</em>
            <a href="<?= the_permalink() ?>">
                <h2><?= the_title() ?></h2>
            </a>
            <p class="author-name">by <?php the_author() ?></p>
            <p><?= the_excerpt() ?></p>
            <a href="<?= the_permalink() ?>"><div class="btn btn-outline-primary">Read the story</div></a>
        </div> 
    </div>
    <?php endwhile; ?>
    <div class="row mx-auto py-5">
        <!-- PHP LOOP -->
        <?php while ( $sponsored->have_posts() ): $sponsored->the_post() ; ?>
        <div class="col-xl-6">
            <em class="text-secondary slug">Sponsored</em>
            <a href="<?= the_permalink() ?>">
                <h2><?= the_title() ?></h2>
            </a>
            <p class="author-name">by <?php the_author() ?></p>
            <p><?= the_excerpt() ?></p>
            <a href="<?= the_permalink() ?>"><div class="btn btn-outline-primary">Read the story</div></a>
        </div>
        <div class="col-xl-6 mt-2">
            <figure id="main-content">
                <a href="<?= the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
            </figure>        
        </div>
    </div>        
    <?php endwhile; ?>
    <!-- RECENT POSTS TITLE -->
    <div class="row mx-auto">
        <div class="col-xl-10 offset-xl-1">
            <h3 class="text-center py-3">Recent posts</h3>
        </div>
        <?php while ( $latest_posts->have_posts() ): $latest_posts->the_post() ; ?>
        <div class="card col-sm-12 col-md-3 col-xl-4 border-0">       
            <figure class="preview">       
                <a href="<?= the_permalink() ?>">
                    <?php the_post_thumbnail('card-header', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height: auto;border-radius:0;']) ?> 
                </a>
            </figure>
            <?php 
                $posttags = get_the_tags();
                if ($posttags) : foreach($posttags as $tag) { ?>
            <em class="py-1 text-center text-secondary slug"><?= $tag->name ?></em>
                <?php } endif ?>
            <h3 class="display-5 text-center">
                <a class="text-decoration-none" href="<?= the_permalink() ?>"><?= the_title() ?></a> 
            </h3> 
            <p class="display-7 text-center">by <?php the_author(); ?></p>                   
        </div>      
        <?php endwhile; ?>
        </div>
    <div class="row mx-auto py-4">
        <div class="d-flex col-12 justify-content-center text-center">
            <a href="<?= get_post_type_archive_link('post') ?>">
                <div class="btn btn-outline-primary display-7">All the stories</div>
            </a>
        </div>
    </div>
<?php get_footer() ?>