<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Vite & Gourmand</title>
</head>

<body>
    <header>
        <div class="header-container">
            <img src="assets/images/logo.png" alt="logo Vite & Gourmand">

            <nav>
                <ul>
                    <li><a href="dashboard-admin.php">Dashboard</a></li>
                    <li><a href="gestion-employes.php">Employés</a></li>
                    <li><a href="statistiques.php">Statistiques</a></li>
                    <li><a href="chiffre-affaires.php">Chiffre d'affaires</a></li>
                </ul>
            </nav>

            <div class="buttons">
                <button>Déconnexion</button>
            </div>
        </div>
    </header>

    <section class="stats-hero">
        <h1>Statistiques générales</h1>
        <p>Analysez les performances de Vite & Gourmand.</p>
    </section>

    <section class="stats-summary">
        <div class="stats-card">
            <h2>📦 Commandes totales</h2>
            <p class="stats-value">1245</p>
        </div>
        <div class="stats-card">
            <h2>💶 Chiffre d'affaires total</h2>
            <p class="stats-value">48 320 €</p>
        </div>
        <div class="stats-card">
            <h2>🍽️ Menu le plus vendu</h2>
            <p class="stats-value">Menu Festif de Noël</p>
        </div>
        <div class="stats-card">
            <h2>⭐ Note moyenne clients</h2>
            <p class="stats-value">4.6 / 5</p>
        </div>
    </section>

    <section class="stats-graphs">
        <div class="graph-card">
            <h2>Évolution des ventes</h2>
            <canvas id="graphVentes"></canvas>
        </div>
        <div class="graph-card">
            <h2>Menus les plus populaires</h2>
            <canvas id="graphMenus"></canvas>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="horaires">
                <h3>Horaires d'ouverture</h3>
                <p>Lundi - Vendredi : 9h - 18h</p>
                <p>Samedi : 10h - 14h</p>
                <p>Dimanche : Fermé</p>
            </div>

            <div class="contact">
                <p>Vite & Gourmand, 12 Rue des Gourmets, 33000 Bordeaux</p>
                <p>Téléphone : 05 56 48 32 10</p>
                <p>Email : contact@viteetgourmand.fr</p>
            </div>

            <div class="legal">
                <a href="mentions-legales.php">Mentions légales</a>
                <a href="cgv.php">Conditions Générales de Vente</a>
            </div>

            <div class="copyright">
                <p>&copy; 2024 Vite & Gourmand. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>
