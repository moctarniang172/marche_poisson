<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Gestion Poissonnerie" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="../dashboard.php">🐟 Gestion Caisse</a>

    <!-- Bouton toggle pour mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarButtons" aria-controls="navbarButtons" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarButtons">
      <div class="ms-auto d-flex flex-column flex-lg-row">
        <a href="../views/ajouter_vente.php" class="btn btn-light btn-sm me-2 mb-2 mb-lg-0">Ajouter Vente</a>
        <a href="../views/liste_ventes.php" class="btn btn-light btn-sm me-2 mb-2 mb-lg-0">Ventes</a>
        <a href="../controllers/filtre.php" class="btn btn-light btn-sm me-2 mb-2 mb-lg-0">Historique</a>
        <a href="../controllers/controllerDataDette.php" class="btn btn-light btn-sm me-2 mb-2 mb-lg-0">Paiements</a>
        <a href="../views/depences.php" class="btn btn-light btn-sm me-2 mb-2 mb-lg-0">Dépenses</a>
        <a href="../views/bilan.php" class="btn btn-warning btn-sm me-2 mb-2 mb-lg-0">Bilan</a>
        <a href="../controllers/controllerLogout.php" class="btn btn-warning btn-sm mb-2 mb-lg-0">Déconnecter</a>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-4">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
