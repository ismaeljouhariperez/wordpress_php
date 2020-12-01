<?php

/*
Template Name: Contact
*/

session_start();
get_header(); 

// Check if plugin is activated
$wp_form_activated = Admin\View::check_plugin('wp-form', 'wp-form'); 

?>

<!-- TITLE -->
<div class="row mx-auto pb-5">
    <div class="col-12 text-center d-flex flex-column align-items-center justify-content-center">
        <h1 class="py-3">Contact</h1>
        <p class="display-5 col-6">Want to collaborate, make suggestions or just telling us a much you love our work?</p>
    </div>
</div>
<div class="row mx-auto">
  <!-- CONTACT FORM -->
  <?php if ($wp_form_activated === true) : ?>
  <div class="col-4">
      <h2 class="py-3">Contact form</h2>
      <?php if( !empty($_POST) || $_POST['init'] != NULL) : ?>
      <!-- DISPLAY USER FILLED INFORMATION -->
      <p class="display-7 m-0 p-0">Thank you, your message has been sent.</p>
      <p class="display-7">Here is a summary of your information.</p>
      <div class="row">
        <div class="col-4">
            <p>Name</p>
            <p>Surname</p>
            <p>Email</p>
            <p>Message</p>        
        </div>
        <div class="col-6">
            <p><?= ($_POST['user_name']); ?></p>
            <p><?= ($_POST['user_surname']); ?></p>
            <p><?= ($_POST['user_email']); ?></p>
            <p><?= ($_POST['user_message']); ?></p>
        </div>
        <div class="contact-buttons d-flex justify-content-center">
          <a href="<?= home_url(); ?>"><div class="btn btn-secondary text-white ml-3">Back home</div></a>
          <form method="POST">
            <input type="hidden" name="init" id='init' value="230486074536">
            <button type="submit" value="submit" class="btn btn-outline-primary mx-3">Send a new message</button>
          </form>
        </div>
      </div>
      <?php else : ?>
      <!-- FORM WITH POST METHOD -->
      <form method="POST">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="name" name="user_name" class="form-control" value="<?= $_SESSION['user_name'] ?>" id="name" placeholder="Name" required>
        </div>
        <div class="form-group">
          <label for="surname">Surname</label>
          <input type="surname" name="user_surname" class="form-control" value="<?= $_SESSION['user_surname'] ?>" id="surname" placeholder="Surname" required>
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" name="user_email" class="form-control" value="<?= $_SESSION['user_email'] ?>" id="email" placeholder="name@example.com" required>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" name="user_message" id="message" rows="3" required></textarea>
        </div>
          <button type="submit" value="submit" class="btn btn-primary">Send</button>       
          <?php wp_nonce_field( 'form_verify', 'contact_form' ); ?>       
      </form>
      <?php endif; ?>
  </div>
  <!-- SPONSORING  -->
  <div class="col-6 offset-1">
      <h2 class="py-3">Sponsoring</h2>
      <p class="display-7">We partner with select brands who share our values. The support of these companies has helped enable us to continue to create great content and publish Offshore.</p>
      <p class="display-7">If you’re interested in partnering with us, we’d love to hear from you. Please email partnership@offshore.com.</p>
  </div>    
</div>
<!-- IF PLUGIN DEACTIVATED -->
<?php else : ?>
 <!-- SPONSORING  -->
 <div class="col-12 text-center">
      <p class="display-7">We partner with select brands who share our values. The support of these companies has helped enable us to continue to create great content and publish Offshore.</p>
      <p class="display-7">If you’re interested in partnering with us, we’d love to hear from you. Please email partnership@offshore.com.</p>
  </div>    
</div>
<?php endif ; ?>

<?php get_footer(); ?>

	

