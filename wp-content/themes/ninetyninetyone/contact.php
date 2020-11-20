<?php
/*
Template Name: Contact
*/

get_header(); 

?> 

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<form class="py-5" method="POST">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="name" name="user_name" class="form-control" id="name" placeholder="name" required>
  </div>
  <div class="form-group">
    <label for="surname">Surname</label>
    <input type="surname" name="user_surname" class="form-control" id="surname" placeholder="surname" required>
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" name="user_email" class="form-control" id="email" placeholder="name@example.com" required>
  </div>
  <div class="form-group">
    <label for="message">Message</label>
    <textarea class="form-control" name="user_message" id="message" rows="3" required></textarea>
  </div>
  <button type="submit" value="submit" class="btn btn-primary">Send</button>

</form>

<?php endwhile; endif; ?>
	

<?php get_footer(); ?>
