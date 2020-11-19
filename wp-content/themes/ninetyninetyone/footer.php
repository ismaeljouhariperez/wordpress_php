</div>
</main>

    <!-- FOOTER -->
    <footer class="bg-secondary mt-5"> 
        <nav class="footer-first">  
            <div class="col-2">
                <a href="/index.php"><img src="http://localhost/wp-content/themes/ninetyninetyone/assets/images/Logo-Offshore-white.svg" width="150px" height="auto" alt="" /></a>
            </div>
        
            <div class="footer-items col-10" id="navbarSupportedContent">
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
        <div class="footer-second">
            <div class="col-4">
                <p class="footer-text text-white">Offshore is a journal for the daily explorators, for those who love the outdoors, telling stories of passionate people inspired by nature. We are an inspirational medium for travelers and photography lovers.</p>
            </div>
            <div class="smo">
                <a><img src="http://localhost/wp-content/themes/ninetyninetyone/assets/smo/Facebook.png"></a>
                <a><img src="http://localhost/wp-content/themes/ninetyninetyone/assets/smo/Instagram.png"></a>
                <a><img src="http://localhost/wp-content/themes/ninetyninetyone/assets/smo/Twitter.png"></a>
                <a><img src="http://localhost/wp-content/themes/ninetyninetyone/assets/smo/Youtube.png"></a>
            </div>
        </div>
        <div class="footer-third pt-2 pb-3">
            <div class="col-5 credits">
                <span class="text-white">Design by Ismael Perez</span>
                <span class="text-white">© 2020 Offshore Magazine</span>
                <span class="text-white">Privacy Policy</span>
            </div>
        </div>
    </footer>
<?php wp_footer() ?>
</body>
</html> 

