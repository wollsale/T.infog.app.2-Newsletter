<?php 

include 'database.php';
include 'sending.php';

?>


<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
    <link rel="stylesheet" href="stylesheets/screen.css">
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="writing">
  <fieldset>
    <legend>Qu'avez vous à dire ?</legend>
    <ul>
      <li>
        <label for="Subject">Sujet * :</label></br>
        <input type="text" name="subject" id="subject">
        <?php echo $error['subject']; ?>
      </li>
      <li>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <?php echo $error['content']; ?>
      </li>
      <li>
        <input type="submit" name="send" value="Envoyer">
      </li>
    </ul>
  </fieldset>
</form>

<a href="logout.php" class="logout">Logout</a>

<p class="feedback"><?php echo $feedback['envoi']; ?></p>

<ol class="subscribers">
<h2>Subscribers</h2>
<?php 


    // On récupère les infos de la base de données et on les affiche de manière à ce qu'on puisse avoir un oeil sur le nombre d'abonnés ou d'éventuelles erreurs

    $dbhost = "localhost:8889";
    $dbname = "newsletter";
    $dbusername = "root";
    $dbpassword = "root";

    try {
        $link = new PDO("mysql:host=$dbhost;dbname=$dbname","$dbusername","$dbpassword");
    }

    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    
    $reponse = $link->query('SELECT * FROM newsletter');

    // On affiche chaque entrée une à une dans des <li>
    while ($donnees = $reponse->fetch())
    {

?>



    <li>
        <?php echo $donnees['name'] . ' à '?><strong><?php echo $donnees['email']; ?></strong>
    </li>

    
<?php
}

$reponse->closeCursor(); // Termine le traitement de la requête

?>
</ol>


</body>
</html>