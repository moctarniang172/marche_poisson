<?php $title = "Ajouter Vente"; include("layout.php"); 
require_once __DIR__ . '/../authers/fonctions.php';

verfierConnexion();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilan Journalier</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h2 class="text-center mb-4">
        📊 Bilan du <?= date("d/m/Y", strtotime($date)) ?>
    </h2>

    <!-- Sélecteur de date -->
    <form method="GET" class="mb-3" action="../controllers/controllerBilan.php">
        <div class="row">
            <div class="col-md-4 offset-md-3">
                <input type="date" name="date" value="<?= $date ?>" class="form-control">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Afficher</button>
            </div>
        </div>
    </form>


    <!-- SECTION TOTALS -->
    <div class="card p-4 shadow mb-4">
        <h4>Récapitulatif général</h4>

        <table class="table table-bordered">

            <tr>
                <th>Total des ventes du jour :</th>
                <td><?= $totaux_ventes ?> FCFA</td>
            </tr>

            <tr>
                <th>Avances reçues aujourd’hui :</th>
                <td><?= $totaux_avance ?> FCFA</td>
            </tr>

            <tr>
                <th>Restes du jour :</th>
                <td><?= $totaux_restant ?> FCFA</td>
            </tr>

            <tr class="table-warning">
                <th>Dette payée aujourd’hui :</th>
                <td><?= $dette_jour ?> FCFA</td>
            </tr>

            <tr class="table-warning">
                <th>Anciennes dettes encaissées :</th>
                <td><?= $ancienne_dettes ?> FCFA</td>
            </tr>

            <tr class="table-danger">
                <th>Total des dépenses :</th>
                <td><?= $totalDepenses ?> FCFA</td>
            </tr>

            <tr class="table-info">
                <th>Total encaissé aujourd’hui :</th>
                <td><strong><?= $encaissements ?> FCFA</strong></td>
            </tr>

            <tr class="table-success">
                <th>Solde final :</th>
                <td><strong><?= $solde ?> FCFA</strong></td>
            </tr>

        </table>
    </div>


    <!-- SECTION VENTES DU JOUR -->
    <div class="card p-4 shadow mb-4">
        <h4>📦 Ventes du jour</h4>

        <?php if (!empty($ventes_jour)): ?>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Poisson</th>
                    <th>Poids</th>
                    <th>Total</th>
                    <th>Avance</th>
                    <th>Reste</th>
                    <th>Date vente</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($ventes_jour as $v): ?>
                <tr>
                    <td><?= $v['nom_client'] ?></td>
                    <td><?= $v['poisson'] ?></td>
                    <td><?= $v['poids'] ?></td>
                    <td><?= $v['total'] ?> FCFA</td>
                    <td><?= $v['avance'] ?> FCFA</td>
                    <td><?= $v['reste'] ?> FCFA</td>
                    <td><?= date("d/m/Y", strtotime($v['date_vente'])) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <?php else: ?>
            <p class="text-muted">Aucune vente aujourd’hui.</p>
        <?php endif; ?>
    </div>


    <!-- SECTION PAIEMENTS -->
    <div class="card p-4 shadow mb-4">
        <h4>💰 Paiements reçus</h4>

        <?php if (!empty($paiements_jour)): ?>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Montant payé</th>
                    <th>Type</th>
                    <th>Date paiement</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($paiements_jour as $p): ?>
                <tr>
                    <td><?= $p['nom_client'] ?></td>
                    <td><?= $p['montant'] ?> FCFA</td>
                    <td>
                        <?php if ($p['date_vente'] == $date): ?>
                            <span class="badge bg-warning">Dette du jour</span>
                        <?php else: ?>
                            <span class="badge bg-info">Ancienne dette</span>
                        <?php endif; ?>
                    </td>
                    <td><?= date("d/m/Y", strtotime($p['date_paiement'])) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <?php else: ?>
            <p class="text-muted">Aucun paiement aujourd’hui.</p>
        <?php endif; ?>
    </div>


    <!-- SECTION DEPENSES -->
    <div class="card p-4 shadow mb-4">
        <h4>📉 Dépenses du jour</h4>

        <?php if (!empty($depenses_jour)): ?>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Motif</th>
                    <th>Montant</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($depenses_jour as $d): ?>
                <tr>
                    <td><?= $d['motif'] ?></td>
                    <td><?= $d['montant'] ?> FCFA</td>
                    <td><?= date("d/m/Y", strtotime($d['date_depense'])) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <?php else: ?>
            <p class="text-muted">Aucune dépense aujourd’hui.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
