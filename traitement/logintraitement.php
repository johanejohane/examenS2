<?php

include("../include/function.php");

session_start();

if (verifierCompte($_POST['email'], $_POST['motDePasse'])) {
    $_SESSION['user'] = getUser($_POST['email']);
    header('location:../pages/accueil.php');
} else {
    header('location:../pages/connexion.php?erreur=1');
    exit();
}
?>