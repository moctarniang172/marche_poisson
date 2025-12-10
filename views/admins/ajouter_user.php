<?php
require_once('../../authers/fonctions.php');

?>

<h2>Ajouter un utilisateur</h2>

<form action="../../controllers/controllerAdmin.php" method="POST">
    <input type="hidden" name="action" value="addUser">

    <label>Nom :</label>
    <input type="text" name="nom" required><br><br>

    <label>Email :</label>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe :</label>
    <input type="password" name="password" required><br><br>

    <label>Rôle :</label>
    <select name="role">
        <option value="user">Utilisateur</option>
        <option value="admin">Administrateur</option>
    </select><br><br>

    <button type="submit">Créer</button>
</form>
