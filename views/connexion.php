<?php
require_once __DIR__ . '/../authers/fonctions.php';
redirectIfLogged();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-5 offset-md-3">

        <div class="card p-4 shadow">
            <h3 class="text-center mb-4">Connexion</h3>

            <form action="../controllers/controllersLogin.php" method="POST">

                <div class="mb-3">
                    <label>Téléphone</label>
                    <input type="tel" name="telephone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-success w-100">Se connecter</button>

                <p class="text-center mt-3">
                    Pas de compte ? <a href="inscription.php">Inscription</a>
                </p>

            </form>
        </div>

    </div>
</div>

</body>
</html>
