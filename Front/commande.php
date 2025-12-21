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
        <h1>Passer commande</h1>
        <p>Complétez les informations ci-dessous pour finaliser votre commande.</p>
    </section>

    <section class="commande-container">

        <div class="recap-menu">
            <h2>Votre menu</h2>
            <img src="assets/images/menu-noel.jpg" alt="Image du menu">
            <h3>Menu Festif de Noël</h3>
            <p>Prix : 24,90 € / personne</p>
            <p>Minimum : 6 personnes</p>
        </div>

        <form id="commande-form" class="commande-form form-card" action="#" method="POST">
            
            <h2>Informations de commande</h2>
            <label for="quantite">Nombre de personnes <span class="required">*</span></label>
            <input type="number" id="quantite" name="quantite" min="6" placeholder="Ex : 8">
            <label for="date">Date de livraison / retrait <span class="required">*</span></label>
            <input type="date" id="date" name="date">
            <label for="heure">Heure souhaitée <span class="required">*</span></label>
            <input type="time" id="heure" name="heure">

            <h2>Mode de réception <span class="required">*</span></h2>
            <label>
                <input type="radio" name="reception" value="retrait">
                Retrait sur place (gratuit)
            </label>
            <label>
                <input type="radio" name="reception" value="livraison">
                Livraison (5 € + 0,59 €/km)
            </label>
            <div class="livraison-adresse">
                <label for="adresse">Adresse de livraison <span class="required">*</span></label>
                <input type="text" id="adresse" name="adresse" placeholder="Votre adresse">

                <label for="ville">Ville <span class="required">*</span></label>
                <input type="text" id="ville" name="ville" placeholder="Votre ville">

                <label for="code-postal">Code postal <span class="required">*</span></label>
                <input type="text" id="code-postal" name="code_postal" placeholder="Code postal">
            </div>

            <h2>Message au traiteur (optionnel)</h2>
            <textarea id="message" name="message" rows="4" placeholder="Ex : Allergies, instructions spéciales…"></textarea>

            <p class="required-info">
                <span class="required">*</span> Champs obligatoires
            </p>
            <p id="commande-error"></p>
            <button type="submit" class="btn-commande">Valider la commande</button>
        </form>

    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
