<?php
ini_set('display_errors',1);
ini_set('display_stratup_errors',1);
error_reporting(E_ALL);

require_once('../../authers/fonctions.php');
require_once('../../mes_classes/Admin.php');
require_once('../../mes_classes/Database.php');

verifierAdmin();

$db = new Database();
$conn = $db->getConnection();

$admin = new Admin();
$users = $admin->getUsers($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion des utilisateurs</title>
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

    <!-- Contenu -->
    <main class="content">

        <div class="header-users">
            <h1 class="titre-page">Liste des utilisateurs</h1>

            <a href="ajouter_user.php" class="btn-add">➕ Ajouter un utilisateur</a>
        </div>

        <div class="table-container">
            <table class="table-users">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($users as $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= $u['nom'] ?></td>
                        <td><?= $u['prenom'] ?></td>
                        <td><?= $u['telephone'] ?></td>
                        <td><?= strtoupper($u['role']) ?></td>

                        <td>
                            <a class="btn-edit" href="modifier_user.php?id=<?= $u['id'] ?>">Modifier</a>

                            <a class="btn-delete" 
                               href="../../controllers/controllerAdmins/controllerAdmin.php?action=supprimer&id=<?= $u['id'] ?>"
                               onclick="return confirm('Supprimer cet utilisateur ?');">
                               Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </main>

</div>

</body>
</html>
