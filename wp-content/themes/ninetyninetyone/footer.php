</div>

<!-- FOOTER -->
<footer class="page-footer text-white bg-secondary pt-4 border-top border-white">
  <div class="container-fluid text-center text-md-left">
    <div class="row mx-auto">
      <div class="col-md-4 mt-md-0 mt-3">
        <!-- PAGES -->
        <h5 class="text-uppercase text-light">Plan du site</h5>
        <ul class="list-unstyled">
          <li>
            <a href="index.php" class="text-white">Accueil</a>
          </li>
          <li>
            <a href="index.php?controller=article&task=index" class="text-white">Chapitres</a>
          </li>
          <li>
            <a href="index.php?controller=contact&task=contact_author" class="text-white">Contact</a>
          </li>
        </ul>
      </div>
      <!-- TITLE -->
      <div class="col-md-4 mb-md-0 mb-3 text-center icon-footer">
        <img src="../public/images/logo.svg" alt="Logo du site Jean Forteroche">        
        <p class="text-uppercase pt-4 ">Site officiel de Jean Forteroche</p>
      </div>
      <!-- ADMIN -->
      <div class="d-flex flex-column col-md-4 mb-md-0 mb-3 align-items-md-end text-md-right text-lg-right text-xl-right text-sm-center">
        <h5 class="text-uppercase">Espace Administrateur</h5>
        <ul class="list-unstyled">
          <!-- ADMIN OPTIONS -->
          <?php if (isset($_SESSION["username"])) { ?>      
            <li>
              <a href="index.php?controller=admin&task=logout" class="text-white" data-toggle="modal" data-target="#exampleModalCenter">Se déconnecter</a>
              <?php include 'view/backend/logout-modal.php' ?>
            </li>
            <li>
              <a href="index.php?controller=admin&task=add" class="text-white">Ajouter un utilisateur</a>
            </li>
            <li>
              <a href="index.php?controller=admin&task=index" class="text-white">Administration</a>
            </li>         
          <?php } else { ?>
            <li>
              <a href="index.php?controller=admin&task=login" target="_blank" class="text-white">Se connecter</a>
            </li>  
          <?php } ?>  
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright text-center bg-secondary py-3">© 2020 Copyright Jean Forteroche
  </div>
</footer>

  


    <?php wp_footer() ?>
</body>
</html>