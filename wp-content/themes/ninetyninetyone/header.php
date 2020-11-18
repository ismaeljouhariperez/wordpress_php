<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-primary mb-4 d-flex align-items-end">        
        <a class="navbar-brand" href="#">
            <img src="http://localhost/wp-content/uploads/2020/11/logo.png" width="150px" height="auto" alt="">
        </a>
        <div class="collapse navbar-collapse d-flex justify-content-around" id="navbarSupportedContent">
        <?php 
        wp_nav_menu([
            'theme_location' => 'header', 
            'container' => false,
            'menu_class' => 'navbar-nav ml-auto'
        ]) 
       
        ?>
         </div>
       

    </nav>

    
    <div class="container">