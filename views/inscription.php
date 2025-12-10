<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #eef2f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .card {
            width: 450px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
        }
        .btn-primary {
            background-color: #007bff;
        }
    </style>
</head>

<body>

<div class="card p-4">
    <h3 class="text-center text-primary mb-3">Créer un compte</h3>

    <form action="../controllers/controllersinscription.php" method="POST">

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Prenom</label>
            <input type="text" class="form-control" id="nom" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="nomber" class="form-label">telephone</label>
            <input type="text" class="form-control" id="email" name="telephone" required>
        </div>

        <div class="mb-3">
            <label for="mdp1" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mdp1" name="mdp1" required>
        </div>

        <div class="mb-3">
            <label for="mdp2" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="mdp2" name="mdp2" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">S’inscrire</button>

        <p class="text-center mt-3">
            Vous avez déjà un compte ? 
            <a href="connexion.php" class="text-primary">Se connecter</a>
        </p>
    </form>
</div>

</body>
</html>
