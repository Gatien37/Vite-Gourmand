<header>

  <?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
  ?>

  <div class="header-container">
    <img src="assets/images/logo.png" alt="logo Vite & Gourmand">

    <button class="burger" id="burger">
      ☰
    </button>

    <nav class="main-nav" id="main-nav">
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="menus.php">Menu</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>

      <!-- Boutons de connexion / déconnexion -->
       
      <div class="buttons">
        <?php if (isset($_SESSION['user'])): ?>

          <a href="deconnexion.php" class="connect-button">
            Se déconnecter
          </a>
          
          <?php
          $profilLink = 'espace-utilisateur.php';
          $profilLabel = 'Mon profil';

          if ($_SESSION['user']['role'] === 'employe') {
              $profilLink = 'espace-employe.php';
              $profilLabel = 'Gérer le site';
          } elseif ($_SESSION['user']['role'] === 'admin') {
              $profilLink = 'espace-admin.php';
              $profilLabel = 'Gérer le site';
          }
          ?>

          <a href="<?= $profilLink ?>" class="signup-button">
            <?= $profilLabel ?>
          </a>

        <?php else: ?>

          <a href="connexion.php" class="connect-button">
            Se connecter
          </a>
          <a href="inscription.php" class="signup-button">
            Créer un compte
          </a>

        <?php endif; ?>
    </div>

    </nav>
  </div>
</header>
