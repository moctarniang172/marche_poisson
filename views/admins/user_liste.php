<?php
ini_set('display_errors',1);
ini_set('display_stratup_errors',1);
error_reporting(E_ALL);
require_once('../../authers/fonctions.php');

require_once('../../mes_classes/Admin.php');
require_once('../../mes_classes/Database.php');

$db = new Database();
$conn = $db->getConnection();

$admin = new Admin();
$users = $admin->getUsers($conn);
?>

<h2>Liste des utilisateurs</h2>

<a href="ajouter_user.php">➕ Ajouter un utilisateur</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Actions</th>
    </tr>

    <?php foreach($users as $u): ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= $u['nom'] ?></td>
        <td><?= $u['telephone'] ?></td>
        <td><?= $u['role'] ?></td>

        <td>
            <a href="modifier_user.php?id=<?= $u['id'] ?>">Modifier</a> |
            <a href="../../controllers/controllerAdmin.php?action=supprimer&id=<?= $u['id'] ?>"
               onclick="return confirm('Supprimer cet utilisateur ?');">
               Supprimer
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
