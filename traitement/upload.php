<?php
include "../include/function.php";
$uploadDir = '../asset/images/';
$allowedMimeTypesImage = ['image/jpeg', 'image/png', 'image/jpg'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media'])) {
    $file = $_FILES['media'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Erreur lors de l’upload : ' . $file['error']);
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMimeTypesImage)) {
        header('location: ../pages/ajoutimage?error=2');
        exit();
    }

    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = null;
    $htmlForm = null;
    $media = null;
    $newName = "img" . '_' . uniqid() . '.' . $extension;

    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        newImageObjet($_POST['objet'], $newName);
        header('location: ../pages/accueil.php');
    } else {
        header('location: ../pages/ajoutimage.php?error=3');
        exit();
    }
} else {
    header('location: ../pages/ajoutimage.php?error=1');
}
?>