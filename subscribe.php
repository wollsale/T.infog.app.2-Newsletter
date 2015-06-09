<?php

include 'database.php';

if (count($_POST['subscribe'])>0) {
    
    // sanitization
    $name = trim(strip_tags($_POST['name']));
    $email = trim(strip_tags($_POST['email']));
    
    // On prépare le tableau des erreurs
    $error = array(
        "name" => "",
        "email" => ""
    );

    // On assigne les message d'erreurs en fonction du problème
    if($name == "") {
        
        $error["name"] = "Name is required!";
        
    } if($email == "") {
        
        $error["email"] = "Email is required!";
        
    } else {
        
        // on vérifie le bon format du mail
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {

            $error["email"] = "Not a Valid Email!";
            
        } else {
            
        
        // Si tout est bon, on prépare la comparation avec les mails des abonnés
        $compare = array($name, $email);
        // On récupère les infos nom et mail de la base de données qui corresponde au nom et mail envoyé par le nouvel abonné
        $query = "  SELECT name, email
                    FROM newsletter
                    WHERE name = :name || email = :email
                    LIMIT 2";
        $preparedStatement = $link->prepare($query);
        $preparedStatement->execute(array(
                                    ':name' => $name,
                                    ':email' => $email
                                    ));
        $result = $preparedStatement->fetchAll();
        
        
        
        
        
        // Si on récupère quelque chose, c'est qu'il est déjà inscrit
        if(!empty($result)){
            // On le préviens alors du doublon
            $compare_rech = array_intersect($result[0], $compare);
            if(in_array($email, $compare_rech)) {
                $error['doublon'] = "Cet email est déjà utilisé";
            }
            
            // On vérifie une deuxième fois
            if(array_key_exists(1, $result) == true){
                $compare_rech = array_intersect($result[1], $compare);
                if(in_array($email, $compare_rech)){
                    $error['doublon'] = "Cet email est déjà utilisé";
                }
            }
        } else {
            
            // Si tout va bien, on peut intégrer les informations dans notre base de données d'après le résultat du formulaire
            $query = "INSERT INTO newsletter(name, email) VALUES(:name, :email)";
            $params = array(
            ':name' => $name,
            ':email' => $email
            );

            $statement = $link->prepare($query);
            $statement->execute($params);
            
            // Et on prévient l'utilisateur que tout a fonctionné sur l'interface
            
            $feedback['confirm'] = "Votre adresse <span>" . $email . "</span> a bien été rajoutée à la base de donnée !";
            
            // Et par mail
            
            include_once 'confirmmail.php';
            
        }
        
    }
    }
}



?>