<?php

    include 'database.php';
    
    // Mise en place du mail par défault

    // on récupère l'adresse mail de l'inscrit
    $to = $email;
    $subject = 'Votre inscription est confirmée';
    $content = 'j\'ai l\'honneur de vous annoncer que votre compte a bien été ajouté à la base de données. Vous recevrez dès lors une newsletter toute les deux semaines. Vous pouvez à tout moment vous désabonner grâce au lien disponible en bas de chaque newsletter.<br/>A très bientôt, <br/>La team.';

    // message
    $message = '
        <html>
            <head>
                <title>' . $subject . '</title>
            </head>
            <body>
                <h1 style="text-align:center">' . $subject . '</h1>
                <p><span style="font-weight:bold">' . 'Hello ' . $name . ', ' . '</span><br/>' . $content . '</p><br/><a href="http://alexiswollseifen.com/tfe/newsletter/unsubscribe.php">Se désabonner</a>
            </body>
        </html>
      ';

    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
    // content-type et content-transfert-encoding permet l'affichage de caractère spécifique dans le mail et dans l'aperçu du mail (qui n'ont pas le même encodage)
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .='Content-Transfer-Encoding: 8bit'."\r\n";

    // Envoi
    mail($to, $subject, $message, $headers);

?>