<?php

include("../include/function.php");

if(!verifierMail($_POST['email'])) {
    creerCompte($_POST['email'],$_POST['nom'], $_POST['motDePasse'], $_POST['dateNaissance'], $_POST['genre'], $_POST['ville']);
} else {
    header('location: ../pages/index.php?erreur=1');
    exit();
}
header('location:../pages/login.php');
?>