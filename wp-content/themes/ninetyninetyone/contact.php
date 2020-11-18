<?php
/*
Template Name: Contact
*/

get_header(); 

?> 

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<form class="py-5">
  <div class="form-group">
    <label for="exampleFormControlInput1">Name</label>
    <input type="name" class="form-control" id="exampleFormControlInput1" placeholder="name" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Surname</label>
    <input type="surname" class="form-control" id="exampleFormControlInput1" placeholder="surname" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Message</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Send</button>

</form>

<?php endwhile; endif; ?>
	

<?php get_footer(); ?>
