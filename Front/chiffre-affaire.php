<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chiffre d'affaires - Vite & Gourmand</title>
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

    <section class="ca-hero">
        <h1>Chiffre d'affaires</h1>
        <p>Analysez les revenus par période et par menu.</p>
    </section>

    <section class="ca-filtres">
        <form class="ca-filter-form" method="GET">
            <div class="date-field">
                <label for="date-debut">Date de début</label>
                <input type="date" id="date-debut" name="date_debut">
            </div>
            <div class="date-field">
                <label for="date-fin">Date de fin</label>
                <input type="date" id="date-fin" name="date_fin">
            </div>
            <button type="submit" class="btn-commande">Filtrer</button>
        </form>
    </section>

    <section class="ca-summary">
        <div class="ca-card">
            <h2>Total CA</h2>
            <p class="ca-value">12 480 €</p>
        </div>
        <div class="ca-card">
            <h2>Commandes sur la période</h2>
            <p class="ca-value">62</p>
        </div>
        <div class="ca-card">
            <h2>Ticket moyen</h2>
            <p class="ca-value">201 €</p>
        </div>
    </section>

    <section class="ca-table-section">
        <h2>Détail des ventes</h2>
        <table class="ca-table">
            <thead>
                <tr>
                    <th>ID Commande</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Menu</th>
                    <th>Quantité</th>
                    <th>Total (€)</th>
                </tr>
            </thead>
            <tbody>
                <!-- EXEMPLE 1 -->
                <tr>
                    <td>#CMD-1203</td>
                    <td>12/01/2025</td>
                    <td>Claire M.</td>
                    <td>Menu Festif de Noël</td>
                    <td>6</td>
                    <td>149,40 €</td>
                </tr>
                <!-- EXEMPLE 2 -->
                <tr>
                    <td>#CMD-1194</td>
                    <td>10/01/2025</td>
                    <td>Julien R.</td>
                    <td>Menu Saveurs du Monde</td>
                    <td>4</td>
                    <td>89,60 €</td>
                </tr>
                <!-- EXEMPLE 3 -->
                <tr>
                    <td>#CMD-1187</td>
                    <td>09/01/2025</td>
                    <td>Sophie L.</td>
                    <td>Menu Cocktail Premium</td>
                    <td>10</td>
                    <td>179,90 €</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="ca-graph">
        <div class="graph-card">
            <h2>Évolution du chiffre d'affaires</h2>
            <canvas id="graphCA"></canvas>
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
                <p>&copy; 2025 Vite & Gourmand. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>
