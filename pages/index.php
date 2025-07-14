<?php
include("../include/function.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #181c24 0%, #232a36 100%);
            color: #e5e7eb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        main {
            background: rgba(30, 34, 45, 0.95);
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 700;
            color: #a5b4fc;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #cbd5e1;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            background-color: #2c2f36;
            color: #fff;
            border: 1px solid #3b3f46;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 5px #60a5fa80;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #6366f1 0%, #38bdf8 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(56, 189, 248, 0.25);
        }

        p {
            margin-top: 1.5rem;
            text-align: center;
        }

        a {
            color: #38bdf8;
            text-decoration: none;
        }

        a:hover {
            color: #818cf8;
            text-decoration: underline;
        }

        .message {
            text-align: center;
            margin-top: 1rem;
        }

        .message.error {
            color: #f87171;
        }

        .message.success {
            color: #38fca0;
        }
    </style>
</head>

<body>

    <main>
        <h1><i class="bi bi-pencil-square me-2"></i>Inscription</h1>

        <form action="../traitement/inscription.php" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>

            <label for="dateNaissance">Date de naissance :</label>
            <input type="date" name="dateNaissance" id="dateNaissance" required>

            <label for="gender">Genre :</label>
            <select name="departement" id="departement" required>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
                <option value="Autre">Autre</option>
            </select>

            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>

            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville" required>

            <label for="motDePasse">Mot de passe :</label>
            <input type="password" name="motDePasse" id="motDePasse" required>

            <button type="submit"><i class="bi bi-person-plus-fill me-1"></i> S'inscrire</button>
        </form>

        <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>

        <?php if (isset($_GET['erreur']) && $_GET['erreur'] == 1) { ?>
            <div class="message error">L'email est déjà utilisé.</div>
        <?php } ?>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
            <div class="message success">Inscription réussie !</div>
        <?php } ?>
    </main>

</body>

</html>
