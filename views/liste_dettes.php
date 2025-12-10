<?php $title = "Ajouter Vente"; include("layout.php");
require_once __DIR__ . '/../authers/fonctions.php';

verfierConnexion();
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Dettes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <h2 class="mb-4">Liste des Dettes des Clients</h2>

    <!-- Formulaire de filtrage -->
    <form action="../controllers/filtre.php" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="nom_client" class="form-control" placeholder="Entrez le nom du client" required>
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </div>
    </form>

    <!-- Tableau des dettes -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nom du Client</th>
                <th>Poisson</th>
                <th>Poids (kg)</th>
                <th>Dette (reste)</th>
                <th>Date de Vente</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($dettes)): ?>
                <?php foreach($dettes as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['nom_client']) ?></td>
                    <td><?= htmlspecialchars($d['poisson']) ?></td>
                    <td><?= htmlspecialchars($d['poids']) ?></td>
                    <td><?= number_format($d['reste'], 0) ?> FCFA</td>
                    <td><?= htmlspecialchars($d['date_vente']) ?></td>
                    <td>
                        <a href="../views/payer_dette.php?id_vente=<?= $d['id_vente'] ?>" class="btn btn-success btn-sm">
                            Payer
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Aucune dette trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
