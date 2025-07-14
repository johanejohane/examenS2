<?php
include "../include/function.php";

if (!isset($_GET['id'])) {
    echo "Objet introuvable.";
    exit;
}

$id_objet = intval($_GET['id']);
$objet = getFicheObjet($id_objet);
$images = getImagesObjet($id_objet);
$historique = getHistoriqueEmprunts($id_objet);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche de l'objet</title>
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h1 class="text-info"><?= htmlspecialchars($objet['nom_objet']) ?></h1>
    <p>Catégorie : <strong><?= htmlspecialchars($objet['nom_categorie']) ?></strong></p>

    <h3>Images</h3>
    <div class="row mb-4">
        <?php while ($img = mysqli_fetch_assoc($images)) { ?>
            <div class="col-md-3 mb-2">
                <img src="../asset/images/<?= htmlspecialchars($img['nom_image']) ?>" class="img-fluid rounded" alt="">
            </div>
        <?php } ?>
    </div>

    <h3>Historique des emprunts</h3>
    <table class="table table-dark table-bordered">
        <thead>
            <tr>
                <th>Emprunteur</th>
                <th>Date d'emprunt</th>
                <th>Date de retour</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($emp = mysqli_fetch_assoc($historique)) { ?>
                <tr>
                    <td><?= htmlspecialchars($emp['nom']) ?></td>
                    <td><?= $emp['date_emprunt'] ?></td>
                    <td><?= $emp['date_retour'] ?? '<span class="text-warning">Non retourné</span>' ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="accueil.php" class="btn btn-outline-info">← Retour à la liste</a>
</div>

</body>
</html>
