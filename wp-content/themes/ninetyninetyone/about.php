<?php  

/*
Template Name: About
*/

get_header(); ?> 

<!-- EXCERPT -->
<div class="row mx-auto pt-5">
  <div class="col-12 text-left excerpt-highlight">
    <?= the_excerpt() ?>
  </div>
</div>
<!-- IMAGE -->
<?php the_post_thumbnail('full', ['class' => 'img-responsive responsive--full', 'title' => 'Feature image']); ?>
<h1 class="text-center pt-5"><?php the_title() ?></h1>
  <!-- CONTENT -->
  <div class="row mx-auto py-2" id="about-content">
    <div class="offset-2 col-8">
      <?php the_content() ?>
    </div>
  </div>

<?php get_footer(); ?>

