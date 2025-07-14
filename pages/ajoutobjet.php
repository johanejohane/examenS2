<?php
include "../include/function.php";
$categories = getCategorie();
$obj = getDernierObjet();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel objet</title>
</head>

<body>
    <a href="accueil.php">Retour</a>
    <h1>Ajout d'objet :</h1>
    <form action="../traitement/objet.php" method="post" enctype="multipart/form-data">
        <label for="categorie">Catégorie :</label>
        <select name="categorie">
            <?php while ($categ = mysqli_fetch_assoc($categories)) { ?>
                <option value="<?= $categ['id_categorie'] ?>"><?= $categ['nom_categorie'] ?></option>
            <?php } ?>
        </select>
        <br><br>

        <label for="nom">Nom de l'objet :</label>
        <input type="text" name="nom" required>
        <br><br>

        <input type="hidden" name="objet" value="<?= $obj['id_objet'] ?>">

        <label for="media">Insérer une image (facultatif) :</label>
        <input type="file" id="media" name="media" accept="image/*">
        <br><br>

        <input type="submit" value="Ajouter l'objet">
    </form>
</body>

</html>