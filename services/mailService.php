<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* ======================= AUTOLOAD COMPOSER (PHPMailer) ======================= */
require_once __DIR__ . '/../vendor/autoload.php';

/* ======================= FONCTION SMTP GÉNÉRIQUE (INTERNE) ======================= */
function envoyerMailSMTP(
    string $to,
    string $subject,
    string $body,
    bool $html = false
): bool {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = getenv('SMTP_HOST');
        $mail->SMTPAuth   = true;
        $mail->Username   = getenv('SMTP_USER');
        $mail->Password   = getenv('SMTP_PASS');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = getenv('SMTP_PORT');

        $mail->CharSet = 'UTF-8';

        $mail->setFrom('no-reply@vite-gourmand.fr', 'Vite & Gourmand');
        $mail->addAddress($to);

        $mail->isHTML($html);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        return $mail->send();
    } catch (Exception $e) {
        error_log('Erreur envoi mail : ' . $mail->ErrorInfo);
        return false;
    }
}

/* ======================= EMAIL CONFIRMATION DE COMMANDE ======================= */
function envoyerMailConfirmation($email, $recap): void
{
    $message = "
Bonjour,

Votre commande a bien été enregistrée.

Menu : {$recap['menu']}
Date : {$recap['date']} à {$recap['heure']}
Personnes : {$recap['nb']}
Mode : {$recap['reception']}
Total : " . number_format($recap['total'], 2, ',', ' ') . " €

Merci pour votre confiance.
";

    envoyerMailSMTP($email, 'Confirmation de commande', nl2br($message), true);
}

/* ======================= EMAIL BIENVENUE UTILISATEUR ======================= */
function envoyerMailBienvenue(string $email, string $prenom): void
{
    $message = "
Bonjour $prenom,

Bienvenue chez Vite & Gourmand !
Votre compte a bien été créé. Vous pouvez maintenant vous connecter et passer commande.

À très vite,
L'équipe Vite & Gourmand
";

    envoyerMailSMTP($email, 'Bienvenue chez Vite & Gourmand', nl2br($message), true);
}

/* ======================= EMAIL COMMANDE TERMINÉE (AVIS CLIENT) ======================= */
function envoyerMailCommandeTerminee(string $email, string $menuNom): void
{
    $message =
        "Bonjour,\n\n" .
        "Votre commande pour le menu « {$menuNom} » est maintenant terminée.\n\n" .
        "Nous espérons que la prestation vous a donné entière satisfaction.\n\n" .
        "Vous pouvez dès à présent vous connecter à votre espace client afin de laisser un avis " .
        "depuis votre commande.\n\n" .
        "Cordialement,\n" .
        "L'équipe Vite & Gourmand";

    envoyerMailSMTP(
        $email,
        'Votre commande est terminée - Donnez votre avis',
        nl2br($message),
        true
    );
}


/* ======================= EMAIL PRÊT DE MATÉRIEL ======================= */
function envoyerMailPretMateriel(
    string $emailClient,
    string $menuNom,
    string $dateLimite
): void {
    $message =
        "Bonjour,\n\n" .
        "Lors de votre commande « {$menuNom} », du matériel a été mis à votre disposition.\n\n" .
        "Merci de prendre contact avec notre équipe afin d'organiser la restitution de ce matériel.\n\n" .
        "Date limite de restitution : {$dateLimite}\n\n" .
        "Conformément à nos conditions générales de vente, en l'absence de restitution sous 10 jours ouvrés, " .
        "des frais de 600 € pourront être appliqués.\n\n" .
        "Cordialement,\n" .
        "L'équipe Vite & Gourmand";

    envoyerMailSMTP(
        $emailClient,
        'Retour de matériel - Commande Vite & Gourmand',
        nl2br($message),
        true
    );
}

/* ======================= EMAIL CRÉATION COMPTE EMPLOYÉ ======================= */
function envoyerMailCreationEmploye(string $email): void
{
    $message =
        "Bonjour,\n\n" .
        "Un compte employé a été créé pour vous sur le site Vite & Gourmand.\n\n" .
        "Pour des raisons de sécurité, le mot de passe n'est pas communiqué par email.\n" .
        "Merci de vous rapprocher de l'administrateur afin de l'obtenir.\n\n" .
        "Cordialement,\n" .
        "L'équipe Vite & Gourmand";

    envoyerMailSMTP(
        $email,
        'Création de votre compte employé - Vite & Gourmand',
        nl2br($message),
        true
    );
}

/* ======================= EMAIL FORMULAIRE DE CONTACT ======================= */
function envoyerMailContact(
    string $email,
    string $sujet,
    string $message
): bool {
    $body =
        "Message envoyé depuis le formulaire de contact :\n\n" .
        "Email : $email\n" .
        "Sujet : $sujet\n\n" .
        $message;

    return envoyerMailSMTP(
        'contact@viteetgourmand.fr',
        $sujet,
        nl2br($body),
        true
    );
}

/* ======================= EMAIL RÉINITIALISATION MOT DE PASSE ======================= */
function envoyerMailResetMotDePasse(
    string $email,
    string $resetLink
): void {
    $message =
        "Bonjour,\n\n" .
        "Vous avez demandé la réinitialisation de votre mot de passe.\n\n" .
        "Cliquez sur le lien ci-dessous pour définir un nouveau mot de passe :\n\n" .
        $resetLink . "\n\n" .
        "Ce lien est valable pendant 1 heure.\n\n" .
        "Si vous n'êtes pas à l'origine de cette demande, ignorez cet email.\n\n" .
        "Cordialement,\n" .
        "L'équipe Vite & Gourmand";

    envoyerMailSMTP(
        $email,
        'Réinitialisation de votre mot de passe - Vite & Gourmand',
        nl2br($message),
        true
    );
}
