<?php

function envoyerMailConfirmation($email, $recap) {

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

    $headers = "From: Vite & Gourmand <contact@vite-gourmand.fr>\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8";

    @mail($email, 'Confirmation de commande', $message, $headers);
}


function envoyerMailBienvenue(string $email, string $prenom): void
{
    $subject = "Bienvenue chez Vite & Gourmand 🎉";

    $message = "
Bonjour $prenom,

Bienvenue chez Vite & Gourmand !
Votre compte a bien été créé. Vous pouvez maintenant vous connecter et passer commande.

À très vite,
L'équipe Vite & Gourmand
";

    @mail($email, $subject, $message);
}


function envoyerMailPretMateriel(string $emailClient, string $menuNom, string $dateLimite): void
{
    $sujet = 'Retour de matériel - Commande Vite & Gourmand';

    $message =
        "Bonjour,\n\n" .
        "Lors de votre commande « {$menuNom} », du matériel a été mis à votre disposition.\n\n" .
        "Merci de prendre contact avec notre équipe afin d'organiser la restitution de ce matériel.\n\n" .
        "Date limite de restitution : {$dateLimite}\n\n" .
        "Conformément à nos conditions générales de vente, en l'absence de restitution sous 10 jours ouvrés, " .
        "des frais de 600 € pourront être appliqués.\n\n" .
        "Cordialement,\n" .
        "L'équipe Vite & Gourmand";

    @mail($emailClient, $sujet, $message);
}



function envoyerMailCreationEmploye(string $email): void
{
    $sujet = "Création de votre compte employé - Vite & Gourmand";

    $message =
        "Bonjour,\n\n" .
        "Un compte employé a été créé pour vous sur le site Vite & Gourmand.\n\n" .
        "Pour des raisons de sécurité, le mot de passe n'est pas communiqué par email.\n" .
        "Merci de vous rapprocher de l'administrateur afin de l'obtenir.\n\n" .
        "Cordialement,\n" .
        "L'équipe Vite & Gourmand";

    @mail($email, $sujet, $message);
}


function envoyerMailContact(string $email, string $sujet, string $message): bool
{
    $to = "contact@viteetgourmand.fr";
    $headers = "From: $email";

    $body = "Message envoyé depuis le formulaire de contact :\n\n"
          . "Email : $email\n"
          . "Sujet : $sujet\n\n"
          . $message;

    return mail($to, $sujet, $body, $headers);
}


function envoyerMailResetMotDePasse(string $email, string $resetLink): void
{
    $sujet = "Réinitialisation de votre mot de passe - Vite & Gourmand";

    $message =
        "Bonjour,\n\n" .
        "Vous avez demandé la réinitialisation de votre mot de passe.\n\n" .
        "Cliquez sur le lien ci-dessous pour définir un nouveau mot de passe :\n\n" .
        $resetLink . "\n\n" .
        "Ce lien est valable pendant 1 heure.\n\n" .
        "Si vous n'êtes pas à l'origine de cette demande, ignorez cet email.\n\n" .
        "Cordialement,\n" .
        "L'équipe Vite & Gourmand";

    $headers  = "From: Vite & Gourmand <no-reply@vite-gourmand.fr>\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8";

    @mail($email, $sujet, $message, $headers);
}


