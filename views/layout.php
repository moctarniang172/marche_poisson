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
        <a class="navbar-brand fw-bold" href="../dashboard.php">🐟 Gestion Poissonnerie</a>

        <div>
            <a href="../views/ajouter_vente.php" class="btn btn-light btn-sm me-2">Ajouter Vente</a>
            <a href="../views/liste.php" class="btn btn-light btn-sm me-2">Ventes</a>
            <a href="../controllers/liste_dettes.php" class="btn btn-light btn-sm me-2">Dettes</a>
            <a href="../controllers/controllerDataDette.php" class="btn btn-light btn-sm me-2">Paiements</a>
            <a href="../views/depenses.php" class="btn btn-light btn-sm me-2">Dépenses</a>
            <a href="../views/bilan.php" class="btn btn-warning btn-sm">Bilan</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
