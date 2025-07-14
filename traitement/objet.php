<?php
include "../include/function.php";
session_start();
$user = $_SESSION['user'];
newObjet($_POST['categorie'], $_POST['nom'], $user['id_membre']);

$obj = getDernierObjet();
echo "Objet ajouté avec succès ! ID: " . $obj['id_objet'];

if (!isset($_FILES['media']) || $_FILES['media']['error'] == UPLOAD_ERR_NO_FILE) {
    newImageObjet($obj['id_objet'], 'default.jpg');
} else {
    
}'

header("Location: ../pages/accueil.php");