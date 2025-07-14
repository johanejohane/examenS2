<?php
include("../include/function.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #181c24 0%, #232a36 100%);
            color: #e5e7eb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: rgba(30, 34, 45, 0.95);
            border: 1px solid #2c2f36;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border-radius: 18px;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #a5b4fc;
            font-weight: 700;
        }

        label {
            color: #cbd5e1;
            font-weight: 500;
        }

        input {
            background-color: #2c2f36;
            border: 1px solid #3b3f46;
            color: #fff;
            border-radius: 8px;
            padding: 10px;
        }

        input:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 6px #60a5fa80;
        }

        .btn-primary {
            background: linear-gradient(90deg, #6366f1 0%, #38bdf8 100%);
            border: none;
            color: #fff;
            font-weight: 600;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.25);
        }

        .erreur p {
            color: #f87171;
            margin-top: 1rem;
            font-weight: 500;
        }

        p a {
            color: #38bdf8;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
            color: #818cf8;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <main class="container">
        <div class="card">
            <h1><i class="bi bi-box-arrow-in-right me-2"></i>Connexion</h1>

            <form action="../traitement/logintraitement.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope me-2"></i>Email :
                    </label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="motDePasse" class="form-label">
                        <i class="bi bi-lock me-2"></i>Mot de passe :
                    </label>
                    <input type="password" name="motDePasse" id="motDePasse" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">
                    <i class="bi bi-door-open-fill me-1"></i>Se connecter
                </button>
            </form>

            <div class="erreur text-center">
                <?php
                if (isset($_GET['erreur']) && $_GET['erreur'] == 1) {
                    echo "<p><i class='bi bi-exclamation-circle me-2'></i>Le compte n'existe pas.</p>";
                }
                ?>
            </div>

            <p class="mt-3 text-center">Vous n'avez pas de compte ? <a href="index.php">S'inscrire</a></p>
        </div>
    </main>

</body>

</html>
