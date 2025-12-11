<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
 $title = "Liste Ventes"; include("layout.php");
require_once __DIR__ . '/../authers/fonctions.php';
require_once __DIR__ . '/../mes_classes/Database.php';
require_once __DIR__ . '/../mes_classes/fonction.php';

verfierConnexion();
$user_id = $_SESSION['user_id'] ?? null;

$db = new Database();
$connexion = $db->getConnection();

$fonction = new Fonction();
$ventesjours = $fonction->venteJours($connexion,$user_id);

 ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped shadow">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Poisson</th>
                <th>Poids</th>
                <th>Total</th>
                <th>Avance</th>
                <th>Reste</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ventesjours as $v): ?>
            <tr>
                <td><?= $v['id'] ?></td>
                <td><?= $v['nom_client'] ?></td>
                <td><?= $v['poisson'] ?></td>
                <td><?= $v['poids'] ?> kg</td>
                <td class="fw-bold"><?= $v['total'] ?> FCFA</td>
                <td><?= $v['avance'] ?></td>
                <td class="text-danger fw-bold"><?= $v['reste'] ?></td>
                <td><?= date('d/m/Y', strtotime($v['date_vente'])) ?></td>
                <td>
                    <?php if($v['reste'] > 0): ?>
                        <a href="modifier.php?id=<?= $v['id'] ?>" class="btn btn-success btn-sm">modifier</a>
                    <?php else: ?>
                        <span class="badge bg-success">Payé</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
