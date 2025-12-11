<?php
require_once('../../authers/fonctions.php');
verifierAdmin();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter un utilisateur</title>
<link rel="stylesheet" href="style_admin.css">
</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="logo">ADMIN</h2>

        <ul class="menu">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a class="active" href="user_liste.php">Gérer les utilisateurs</a></li>
            <li><a href="../ventes.php">Toutes les ventes</a></li>
            <li><a href="../depences.php">Toutes les dépenses</a></li>
            <li><a href="../bilan.php">Bilan général</a></li>
            <li><a href="../../controllers/controllerLogout.php" class="logout">Déconnexion</a></li>
        </ul>
    </aside>

    <!-- Contenu principal -->
    <main class="content">

        <h1 class="titre-page">Ajouter un utilisateur</h1>

        <div class="card-form">

            <form action="../../controllers/controllerAdmins/controllerAdmin.php" method="POST">

                <input type="hidden" name="action" value="addUser">

                <label>Nom :</label>
                <input type="text" name="nom" required>

                <label>Prénom :</label>
                <input type="text" name="prenom" required>

                <label>Téléphone :</label>
                <input type="text" name="telephone" required>

                <label>Email :</label>
                <input type="email" name="email" required>

                <label>Mot de passe :</label>
                <input type="password" name="password" required>

                <label>Rôle :</label>
                <select name="role">
                    <option value="user">Utilisateur</option>
                    <option value="admin">Administrateur</option>
                </select>

                <button type="submit" class="btn-save">➕ Créer utilisateur</button>

                <a href="user_liste.php" class="btn-back">↩ Retour</a>
            </form>
        </div>

    </main>

</div>

</body>
</html>
