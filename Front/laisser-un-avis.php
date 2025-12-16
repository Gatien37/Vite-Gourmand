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
        <h1>Laisser un avis</h1>
        <p>Partagez votre expérience avec Vite & Gourmand.</p>
    </section>

    <section class="avis-container">
        <form class="avis-form form-card" action="#" method="POST">
            <h2>Votre commande</h2>
            <!-- Exemple statique, sera dynamique en PHP -->
            <p><strong>Menu :</strong> Menu Festif de Noël</p>
            <p><strong>Commande :</strong> #CMD-1023</p>
            <h2>Votre note</h2>
            <div class="rating">
                <label>
                    <input type="radio" name="note" value="1">
                    ⭐
                </label>
                <label>
                    <input type="radio" name="note" value="2">
                    ⭐⭐
                </label>
                <label>
                    <input type="radio" name="note" value="3">
                    ⭐⭐⭐
                </label>
                <label>
                    <input type="radio" name="note" value="4">
                    ⭐⭐⭐⭐
                </label>
                <label>
                    <input type="radio" name="note" value="5">
                    ⭐⭐⭐⭐⭐
                </label>
            </div>
            <h2>Votre commentaire</h2>
            <textarea name="commentaire" rows="5" placeholder="Donnez votre avis sur le menu, la livraison, la qualité des plats…"></textarea>
            <button type="submit" class="btn-commande">Envoyer mon avis</button>
            <div class="auth-links">
                <a href="commande-utilisateur.php">← Retour à mes commandes</a>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
