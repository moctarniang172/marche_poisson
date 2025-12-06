<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
 $title = "Ajouter Vente"; include("layout.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Paiements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Historique des Paiements</h2>
     <form action="../controllers/filtre.php" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="nom_client" class="form-control" placeholder="Entrez le nom du client" required>
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </div>
    </form>


    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Client</th>
                <th>Poisson</th>
                <th>Poids</th>
                <th>Total Vente</th>
                <th>Paiement</th>
                <th>Reste</th>
                <th>Date Paiement</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($operation)): ?>
                <?php foreach ($operation as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['nom_client']) ?></td>
                    <td><?= htmlspecialchars($p['poisson']) ?></td>
                    <td><?= htmlspecialchars($p['poids']) ?> kg</td>
                    <td><?= number_format($p['total'], 0, ',', ' ') ?> FCFA</td>
                    <td class="text-success fw-bold">
                        <?= number_format($p['montant'], 0, ',', ' ') ?> FCFA
                    </td>
                    <td class="text-danger fw-bold">
                        <?= number_format($p['reste'], 0, ',', ' ') ?> FCFA
                    </td>
                    <td><?= $p['date_paiement'] ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Aucune opération trouvée.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

</body>
</html>
