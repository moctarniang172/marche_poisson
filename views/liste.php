<?php $title = "Ajouter Vente"; include("layout.php");
require_once __DIR__ . '/../authers/fonctions.php';

verfierConnexion(); ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Liste des dettes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
   <form action="../controllers/filtre.php" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="nom_client" class="form-control" placeholder="Entrez le nom du client" required>
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </div>
    </form>
  <h3>Liste des dettes</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Client</th>
        <th>Poisson</th>
        <th>poids Total</th>
        <th>Total</th>
        <th>Avance</th>
        <th>Restant</th>
        <th>DAte operation</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
 <?php foreach ($listeDettes as $d): ?>
    <tr>
        <td><?= $d['id'] ?></td>
        <td><?= $d['nom_client'] ?></td>
        <td><?= $d['poisson'] ?></td>
        <td><?= $d['poids'] ?> kg</td>
        <td><?= $d['total'] ?> FCFA</td>
        <td><?= $d['avance'] ?> FCFA</td>
        <td><?= $d['reste'] ?> FCFA</td>
        <td><?= $d['date_vente'] ?></td>
        <td>
            <a href="../views/dettes.php?id=<?= $d['id'] ?>" class="btn btn-success btn-sm">
                Payer
            </a>
        </td>
    </tr>
<?php endforeach; ?>

    </tbody>
  </table>
  <a href="index.php" class="btn btn-secondary">Nouvelle vente</a>
</div>
</body>
</html>
