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

    <!-- Bootstrap CSS + Icons -->
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #181c24 0%, #232a36 100%);
            color: #e5e7eb;
            padding: 40px;
        }

        label {
            color: #e5e7eb;
        }

        .form-control,
        .form-select {
            background-color: #1f2937;
            color: #e5e7eb;
            border: 1px solid #374151;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(96, 165, 250, 0.25);
            border-color: #60a5fa;
        }

        .btn-primary {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        a {
            color: #60a5fa;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
            color: #818cf8;
        }
    </style>
</head>

<body>
    <a href="accueil.php" class="btn btn-outline-light mb-4">
        <i class="bi bi-arrow-left-circle"></i> Retour
    </a>

    <h1 class="mb-4"><i class="bi bi-plus-circle"></i> Ajout d'objet :</h1>

    <form action="../traitement/objet.php" method="post" enctype="multipart/form-data" class="mb-4">

        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie :</label>
            <select name="categorie" class="form-select">
                <?php while ($categ = mysqli_fetch_assoc($categories)) { ?>
                    <option value="<?= $categ['id_categorie'] ?>"><?= $categ['nom_categorie'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'objet :</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <input type="hidden" name="objet" value="<?= $obj['id_objet'] ?>">

        <div class="mb-3">
            <label for="media" class="form-label">Insérer une image (facultatif) :</label>
            <input type="file" id="media" name="media" accept="image/*" class="form-control">
        </div>

        <input type="submit" value="Ajouter l'objet" class="btn btn-primary">
    </form>
</body>

</html>
