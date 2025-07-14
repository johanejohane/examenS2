<?php
include "../include/function.php";
$objets = getAllObjets();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'image</title>
</head>

<body>
    <a href="accueil.php">Retour</a>

    <h1>Ajout d'image :</h1>
    <form action="../traitement/upload.php" method="post" enctype="multipart/form-data">
        <label for="objet">Choisissez l'objet :</label>
        <select name="objet">
            <?php while ($obj = mysqli_fetch_assoc($objets)) { ?>
                <option value="<?= $obj['id_objet'] ?>"><?= $obj['nom_objet'] ?></option>
            <?php } ?>
        </select>
        <br><br>

        <label for="media">Insérer une image :</label>
        <input type="file" id="media" name="media" accept="image/*" required>
        <br><br>

        <input type="submit" value="Ajouter l'objet">
    </form>

    <?php if (isset($_GET['error'])) { 
        if ($_GET['error'] == 1) { ?>
        <p>Image introuvable</p>
        <?php } elseif ($_GET['error'] == 2) { ?>
        <p>Format de fichier non supporté</p>
        <?php } elseif ($_GET['error'] == 3) { ?>
        <p>Erreur lors de l'upload de l'image</p>
    <?php }} ?>
</body>

</html>