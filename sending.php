<?php

    include 'database.php';


    // On récupère l'ensemble des adresses email des abonnés
    $maillist = $link->query('SELECT * FROM newsletter');
    $donnees = $maillist->fetch();

    // Qu'on assigne aux adresses destinataires
    $to = $donnees['email'];
    // On prépare la variable "toname" si l'on souhaite créer un mail personnalisé en utilisant le nom de l'abonné
    $toname = $donnees['name'];
        
    // Si les champs sont remplis
    if (count($_POST)>0) {
        
    // sanitization
    $subject = trim(strip_tags($_POST['subject']));
    $content = trim(strip_tags($_POST['content']));
    
    // On prépare le tableau propre aux erreurs
    $error = array(
        "subject" => "",
        "content" => ""
    );
        
    // Si vide = "is required"
    if($subject == "") {
        
        $error["subject"] = "Name is required!";
        
    } if($content == "") {
        
        $error["content"] = "Email is required!";
        
    } else {
        
        // Si non : 

        // message
        $message = '
        <html>
        <head>
        <title>' . $subject . '</title>
        </head>
        <body>
        <h1 style="text-align:center">' . $subject . '</h1>
        <p>' . $content . '</p><br/><a href="http://alexiswollseifen.com/tfe/newsletter/unsubscribe.php">Se désabonner</a>
        </body>
        </html>
        ';

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .='Content-Transfer-Encoding: 8bit'."\r\n";

        // Envoi
        mail($to, $subject, $message, $headers);
        
        
        // On prépare un message feedback pour annoncé que le mail a bien été envoyé
        // Le mieux serait d'utiliser un abonné fictif qui permet de vérifier la bonne réception des newletters
        $feedback['envoi'] = "<span>Votre message a bien été envoyé :</span><br/><br/>" . $subject . '</br>' . $content;

        
    }
}


?>