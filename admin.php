<?php

session_start();

include 'config.inc.php';
include 'functions.inc.php';

// Session

if($_SESSION['logged_in'] != 'ok'){
  
  // pas connecté
  if (count($_POST)>0) {
    // sanitization
    $username = trim(strip_tags($_POST['username']));
    $password = trim(strip_tags($_POST['password']));
    
      // On préparer le tableau des erreurs
    $errors = array();
      // Si usernam est vide
      if ($username == ''){
        $errors['username'] = 'Username error';
      }
      // Si password est vide
      if($password == ''){
        $errors['password'] = 'Password error';
      }
      if (count($errors)<1) {
       // S'il n'y a pas d'erreurs pour le moment, alors on vérifie avec les données enregistrées (dans config.inc.php)
        foreach ($users as $u){
          if($u['username']==$username && $u['password'] == $password){
            $_SESSION = $u;
            $_SESSION['logged_in'] = 'ok';
            header('Location: ./admin.php');
            exit;
          }
        }
        // Si ça ne correspond à rien
        $error['wrong'] = 'Ce login et mot de passe sont inconnus';
      }
  }
  // on affiche le formulaire
  include 'login.view.php';
} else {
  // concecté, on affiche la page de rédaction de la newsletter
  header('Location: ./writing.view.php');
}

?>
