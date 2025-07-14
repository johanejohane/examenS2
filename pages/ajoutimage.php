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

        .alert {
            margin-top: 20px;
        }

        a {
            color: #60a5fa;
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

    <h1 class="mb-4"><i class="bi bi-image"></i> Ajout d'image :</h1>

    <form action="../traitement/upload.php" method="post" enctype="multipart/form-data" class="mb-4">
        <div class="mb-3">
            <label for="objet" class="form-label">Choisissez l'objet :</label>
            <select name="objet" id="objet" class="form-select">
                <?php while ($obj = mysqli_fetch_assoc($objets)) { ?>
                    <option value="<?= $obj['id_objet'] ?>"><?= $obj['nom_objet'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="media" class="form-label">Insérer une image :</label>
            <input type="file" id="media" name="media" accept="image/*" class="form-control" required>
        </div>

        <input type="submit" value="Ajouter l'objet" class="btn btn-primary">
    </form>

    <?php if (isset($_GET['error'])) {
        if ($_GET['error'] == 1) { ?>
            <div class="alert alert-danger"><i class="bi bi-exclamation-circle"></i> Image introuvable</div>
        <?php } elseif ($_GET['error'] == 2) { ?>
            <div class="alert alert-warning"><i class="bi bi-exclamation-triangle"></i> Format de fichier non supporté</div>
        <?php } elseif ($_GET['error'] == 3) { ?>
            <div class="alert alert-danger"><i class="bi bi-x-circle"></i> Erreur lors de l'upload de l'image</div>
    <?php }} ?>
</body>

</html>
