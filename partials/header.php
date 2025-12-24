<header>

  <?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
  ?>

  <div class="header-container">
    <img src="assets/images/logo.svg" alt="logo Vite & Gourmand">

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
    <a href="espace-utilisateur.php" class="signup-button">
      Mon Profil
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
