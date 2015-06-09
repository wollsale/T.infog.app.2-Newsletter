<?php 

session_start();

// effacer les fichiers stockant la session
session_destroy();

// effecer la variable de session
unset($_SESSION);

// refirige le navigateur vers la page d'accueil
header("Location: index.php");

?>