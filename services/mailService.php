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