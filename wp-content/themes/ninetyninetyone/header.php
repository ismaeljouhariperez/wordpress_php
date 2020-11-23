<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>
<body class="Site">

    <nav class="header <?php if(!is_front_page() && !is_singular('post')): ?> mb-5 <?php endif ?>">  
        <div class="col-2">
            <a class="col-10" href="/index.php">
                <img src="http://localhost/wp-content/themes/ninetyninetyone/assets/images/Logo-Offshore.svg" width="150px" height="auto" alt="">
            </a>
        </div>
      
        <div class="header-items" id="navbarSupportedContent">
            <ul>
            <?php 
                wp_nav_menu([
                    'theme_location' => 'header', 
                    'container' => false,
                    'menu_class' => 'header-items'
                ])   
            ?>
            </ul>
      
         </div>
       

    </nav>

    <main class="Site-content">
        <?php if(!is_front_page() && !is_singular('post') ): ?>
                    <div class="container">
       <?php endif ?>
