<?php
/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/horaireModel.php';
require_once __DIR__ . '/../services/mailService.php';

/* ========== Récupération des horaires ========== */

$horaires = getHoraires($pdo);

/* ========== Initialisation des messages ========== */

$message = '';
$success = false;

/* ========== Traitement du formulaire de contact ========== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email   = trim($_POST['email'] ?? '');
    $sujet   = trim($_POST['sujet'] ?? '');
    $contenu = trim($_POST['message'] ?? '');

    /* Validation des champs */
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Adresse e-mail invalide.";
    }
    elseif (empty($sujet) || empty($contenu)) {
        $message = "Veuillez remplir tous les champs.";
    }
    else {

        /* Envoi du message */
        if (envoyerMailContact($email, $sujet, $contenu)) {
            $message = "Votre message a bien été envoyé. Nous vous répondrons rapidement.";
            $success = true;
        } else {
            $message = "Erreur lors de l'envoi du message.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Contact";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <!-- ===== Titre ===== -->
    <section class="hero-section commandes-hero">
        <h1>Contactez-nous</h1>
        <p>Une question ? Un événement à organiser ? Nous sommes là pour vous aider.</p>
    </section>

    <section class="contact-container">

        <!-- ===== Formulaire de contact ===== -->
        <div class="contact-form form-card">

            <!-- Message de retour -->
            <?php if (!empty($message)): ?>
                <p class="<?= $success ? 'alert-success' : 'error-message' ?>">
                    <?= htmlspecialchars($message) ?>
                </p>
            <?php endif; ?>

            <h2>Envoyer un message</h2>

            <form action="#" method="POST">

                <label for="email">E-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    placeholder="Votre adresse e-mail"
                >

                <label for="sujet">Sujet</label>
                <input
                    type="text"
                    id="sujet"
                    name="sujet"
                    required
                    placeholder="Sujet de votre message"
                >

                <label for="message">Message</label>
                <textarea
                    id="message"
                    name="message"
                    rows="6"
                    required
                    placeholder="Votre message"
                ></textarea>

                <button class="btn-commande" type="submit">
                    Envoyer
                </button>

            </form>
        </div>

        <!-- ===== Informations de contact ===== -->
        <div class="contact-infos">

            <h2>Nos coordonnées</h2>

            <p>
                <strong>Adresse :</strong><br>
                12 Rue des Gourmets, 33000 Bordeaux
            </p>

            <p>
                <strong>Téléphone :</strong><br>
                05 56 48 32 10
            </p>

            <p>
                <strong>Email :</strong><br>
                contact@viteetgourmand.fr
            </p>

            <p><strong>Horaires d'ouverture :</strong></p>

            <?php foreach ($horaires as $h): ?>
                <p class="horaire-item">
                    <strong><?= ucfirst($h['jour']) ?> :</strong>
                    <?php if ($h['ouverture'] && $h['fermeture']): ?>
                        <?= substr($h['ouverture'], 0, 5) ?> – <?= substr($h['fermeture'], 0, 5) ?>
                    <?php else: ?>
                        Fermé
                    <?php endif; ?>
                </p>
            <?php endforeach; ?>

        </div>
    </section>
</main>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
