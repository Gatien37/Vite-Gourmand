<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Accueil";
    require_once __DIR__ . '/partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1>Créer / Modifier un employé</h1>
        <p>Complétez les informations ci-dessous pour enregistrer un employé.</p>
    </section>

    <section class="employe-form-container">
        <form class="employe-form form-card" action="#" method="POST">
            <!-- INFOS PERSONNELLES -->
            <h2>Informations personnelles</h2>
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" placeholder="Ex : Julie">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Ex : Martin">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="email@exemple.com">

            <!-- MOT DE PASSE -->
            <h2>Mot de passe</h2>
            <p class="info">
                (Laissez vide pour conserver l'ancien mot de passe lors d'une modification)
            </p>
            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Laisser vide si inchangé">

            <!-- RÔLE -->
            <h2>Rôle</h2>
            <label for="role">Sélectionnez le rôle</label>
            <select id="role" name="role">
                <option value="employe">Employé</option>
                <option value="admin">Administrateur</option>
            </select>

            <!-- STATUT -->
            <h2>Statut du compte</h2>
            <label for="statut">Statut</label>
            <select id="statut" name="statut">
                <option value="actif">Actif</option>
                <option value="inactif">Inactif</option>
            </select>

            <!-- BOUTONS -->
            <button type="submit" class="btn-commande">Enregistrer l'employé</button>

            <div class="auth-links">
                <a href="gestion-employes.php">← Retour à la liste des employés</a>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
