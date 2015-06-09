<?php 

    include 'database.php';
    
    if(count($_POST)>0) {
        
        $email = trim(strip_tags($_POST['email']));
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            
            $error["email"] = "Not a Valid Email!";
            
        } else {                
        
        // Si tout est bon, on prépare la comparation avec les mails des abonnés
        $compare = array($name, $email);
        // On récupère les infos nom et mail de la base de données qui corresponde au nom et mail envoyé l'abonné sur le point de se désinscrire
        $query = "  SELECT email
                    FROM newsletter
                    WHERE email = :email
                    LIMIT 2";
        $preparedStatement = $link->prepare($query);
        $preparedStatement->execute(array(
                                    ':email' => $email
                                    ));
        $result = $preparedStatement->fetchAll();
        
        // Si on récupère quelque chose, c'est qu'il est bien inscrit
        if(!empty($result)){
            $compare_rech = array_intersect($result[0], $compare);
            
            // Dans ce cas, on peut supprimer ses informations de la base de données
            if(in_array($email, $compare_rech)) {
                $sql = "DELETE FROM newsletter WHERE email = :email";
                $stmt = $link->prepare($sql);
                $stmt->bindParam(':email', $email, PDO::PARAM_INT);   
                $stmt->execute();

                // Et lui annoncé que c'est fait uniquement par l'interface
                $feedback['unsubscribe'] = "L'adresse email <span>" . $email . "</span> a bien été désinscrite.";
            }
        } else {
            
            // S'il n'existe pas dans la base de données, on lui dit
            
           $error['doublon'] = "Cet email n'existe pas";
                        
        }
    }
}
?>




<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
    <link rel="stylesheet" href="stylesheets/screen.css">
</head>
<body>

<p class="feedbackunsubscribe"><?php echo $feedback['unsubscribe'] ?></p>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="unsubscribe">
  <fieldset>
    <legend>Confirmation de désinscription :</legend>
    <ol>
      <li>
        <label for="email">Email * :</label>
        <input type="email" name="email" id="email">
        <p class="error"><?php echo $error['email']; ?></p>
        <p class="error"><?php echo $error['doublon']; ?></p>
      </li>
      <li>
        <input type="submit" name="unsubscribe" value="Se désinscrire">
      </li>
    </ol>
  </fieldset>

</form>

</body>
</html>