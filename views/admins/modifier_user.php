<?php
require_once('../../authers/fonctions.php');
require_once('../../mes_classes/Admin.php');
require_once('../../mes_classes/Database.php');

$db = new Database();
$conn = $db->getConnection();

$admin = new Admin();

$id = $_GET['id'] ?? null;
$user = $admin->getUser($conn, $id);
?>

<h2>Modifier un utilisateur</h2>

<form action="../../controllers/controllerAdmin.php" method="POST">
    <input type="hidden" name="action" value="updateUser">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    <label>Nom :</label>
    <input type="text" name="nom" value="<?= $user['nom'] ?>" required><br><br>

    <label>Nom :</label>
    <input type="text" name="prenom" value="<?= $user['prenom'] ?>" required><br><br>

    <label>Email :</label>
    <input type="email" name="email" value="<?= $user['telephone'] ?>" required><br><br>

    <label>Rôle :</label>
    <select name="role">
        <option value="user"  <?= $user['role']=='user' ? 'selected' : '' ?>>Utilisateur</option>
        <option value="admin" <?= $user['role']=='admin' ? 'selected' : '' ?>>Administrateur</option>
    </select><br><br>

    <button type="submit">Modifier</button>
</form>
