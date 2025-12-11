<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once('../../authers/fonctions.php');
verifierAdmin();
require_once('../../controllers/controllerAdmins/dashboardController.php');
$datas = include('../../controllers/controllerAdmins/dashboardController.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>
<link rel="stylesheet" href="style_admin.css">
</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="logo">ADMIN</h2>

        <ul class="menu">
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li><a href="user_liste.php">Gérer les utilisateurs</a></li>
            <li><a href="../ventes.php">Toutes les ventes</a></li>
            <li><a href="../depences.php">Toutes les dépenses</a></li>
            <li><a href="../bilan.php">Bilan général</a></li>
            <li><a href="../../controllers/controllerLogout.php" class="logout">Déconnexion</a></li>
        </ul>
    </aside>

    <!-- Contenu principal -->
    <main class="content">
        <h1 class="titre-page">Dashboard Administrateur</h1>

        <div class="grid-cards">
            <?php foreach($datas as $d): ?>
                <div class="card">
                    <h3><?= $d['user']['nom']; ?></h3>

                    <p><strong>Total ventes :</strong> <?= $d['bilan']['ventes']; ?> FCFA</p>
                    <p><strong>Total dépenses :</strong> <?= $d['bilan']['depenses']; ?> FCFA</p>
                    <p><strong>Solde :</strong> <span class="solde"><?= $d['bilan']['solde']; ?> FCFA</span></p>

                    <a class="btn-details" href="details.php?id=<?= $d['user']['id']; ?>">Voir détails</a>
                </div>
            <?php endforeach; ?>
        </div>

    </main>

</div>

</body>
</html>
