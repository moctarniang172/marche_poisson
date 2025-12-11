<?php
require_once('../../authers/fonctions.php');
require_once('../../mes_classes/Admin.php');
require_once('../../mes_classes/Database.php');

verifierAdmin();

$db = new Database();
$conn = $db->getConnection();

$admin = new Admin();

$id = $_GET['id'] ?? null;
$user = $admin->getUser($conn, $id);

if(!$user){
    die("Utilisateur introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier utilisateur</title>
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
            <li><a href="../controllers/controllerLogout.php" class="logout">Déconnexion</a></li>
        </ul>
    </aside>

    <!-- Contenu -->
    <main class="content">

        <h1 class="titre-page">Modifier un utilisateur</h1>

        <div class="card-form">

            <form action="../../controllers/controllerAdmins/controllerAdmin.php" method="POST">

                <input type="hidden" name="action" value="updateUser">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                <label>Nom :</label>
                <input type="text" name="nom" value="<?= $user['nom'] ?>" required>

                <label>Prénom :</label>
                <input type="text" name="prenom" value="<?= $user['prenom'] ?>" required>

                <label>Téléphone :</label>
                <input type="text" name="telephone" value="<?= $user['telephone'] ?>" required>

                <label>Rôle :</label>
                <select name="role">
                    <option value="user"  <?= $user['role']=='user' ? 'selected' : '' ?>>Utilisateur</option>
                    <option value="admin" <?= $user['role']=='admin' ? 'selected' : '' ?>>Administrateur</option>
                </select>

                <button type="submit" class="btn-save">💾 Enregistrer</button>

                <a href="user_liste.php" class="btn-back">↩ Retour</a>
            </form>

        </div>

    </main>

</div>

</body>
</html>
