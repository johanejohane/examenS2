<?php
include "../include/function.php";
session_start();
$user = $_SESSION['user'];
$categories = getCategorie();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Objets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #181c24 0%, #232a36 100%);
            min-height: 100vh;
            color: #e5e7eb;
        }

        .navbar {
            background: rgba(30, 34, 45, 0.97);
            border-bottom: 1px solid #232a36;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand {
            font-weight: bold;
            color: #a5b4fc !important;
        }

        .navbar-brand i {
            margin-right: 5px;
        }

        h1, h2, h3, h5 {
            color: #e5e7eb;
        }

        .container {
            padding-bottom: 50px;
        }

        .card {
            background: rgba(30, 34, 45, 0.92);
            border: 1px solid #2c2f36;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            color: #a5b4fc;
            font-weight: 600;
        }

        .text-success i,
        .text-success {
            color: #38fca0 !important;
        }

        .text-danger i,
        .text-danger {
            color: #f87171 !important;
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
        }

        .section-title {
            font-weight: 700;
            color: #60a5fa;
            border-left: 5px solid #60a5fa;
            padding-left: 10px;
        }

        .card-body {
            background-color: rgba(36, 41, 54, 0.9);
            border-top: 1px solid #232a36;
        }

        .fw-bold {
            color: #a5b4fc;
        }

        .text-secondary {
            color: #94a3b8 !important;
        }

        .elementNav a {
            color: #38bdf8;
            font-weight: 500;
            text-decoration: none;
            transition: 0.2s;
        }

        .elementNav a:hover {
            color: #818cf8;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-box2-heart"></i>Objets Partagés</a>
            <div class="ms-auto">
                <a href="../traitement/deconnexion.php" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold"><i class="bi bi-person-circle me-2"></i>Bonjour <?= htmlspecialchars($user['nom']) ?></h1>
            <h2 class="text-secondary">Liste des objets disponibles</h2>
        </div>

        <?php while ($categ = mysqli_fetch_assoc($categories)) { ?>
            <h3 class="section-title mt-4 mb-3">
                <i class="bi bi-folder2-open me-2"></i><?= htmlspecialchars($categ['nom_categorie']) ?>
            </h3>

            <div class="row">
                <?php 
                $objets = getListObjet($categ['id_categorie']); 
                while ($obj = mysqli_fetch_assoc($objets)) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="../asset/images/<?= htmlspecialchars($obj['nom_image']) ?>" class="card-img-top rounded-top" alt="Image de <?= htmlspecialchars($obj['nom_objet']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($obj['nom_objet']) ?></h5>
                                <?php $emp = getEmprunt($obj['id_objet']); ?>
                                <?php if ($emp != null) { ?>
                                    <p class="card-text text-danger">
                                        <i class="bi bi-x-circle me-1"></i> Emprunté jusqu'au <?= $emp['date_retour'] ?>
                                    </p>
                                <?php } else { ?>
                                    <p class="card-text text-success">
                                        <i class="bi bi-check-circle me-1"></i> Disponible
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

</body>

</html>
