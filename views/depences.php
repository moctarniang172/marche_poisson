<?php $title = "Ajouter Vente"; include("layout.php"); 
require_once __DIR__ . '/../authers/fonctions.php';

verfierConnexion();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une dépense</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #eef4ff;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.15);
        }
        h2 {
            color: #0d6efd;
        }
    </style>
</head>

<body class="p-4">

<div class="container">
    <div class="card p-4">
        <h2 class="mb-3">Ajouter une dépense</h2>

        <!-- Alerte retour -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Dépense enregistrée avec succès !</div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">Erreur lors de l’enregistrement !</div>
        <?php endif; ?>

        <form method="POST" action="../controllers/controllersDepences.php" id="formDepense">

            <!-- Type de dépense -->
            <div class="mb-3">
                <label class="form-label">Motif</label>
                <input type="text" class="form-control" name="motif" id="motif"  required>
            </div>

            <!-- Montant -->
            <div class="mb-3">
                <label class="form-label">Montant (FCFA)</label>
                <input type="number" class="form-control" name="montant" id="montant" min="0" required>
            </div>

            <!-- Bouton -->
            <button class="btn btn-primary w-100">Enregistrer la dépense</button>
        </form>
    </div>
 <body class="bg-light">

<div class="container py-4">

    <h2 class="mb-4 text-center">Gestion des Dépenses</h2>

    <!-- ================= LISTE DES DEPENSES ================= -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Liste des dépenses</h5>
        </div>
        <div class="card-body">

            <?php if (!empty($liste)) : ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Montant</th>
                            <th>Motif</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($liste as $dep) : ?>
                                <tr>
                                   <td><?= isset($dep['montant']) ? htmlspecialchars($dep['montant']) : '—' ?> FCFA</td>
                                   <td><?= isset($dep['motif']) ? htmlspecialchars($dep['motif']) : '—' ?></td>
                                   <td><?= isset($dep['date_depense']) ? htmlspecialchars($dep['date_depense']) : '—' ?></td>
                                </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="text-muted text-center">Aucune dépense enregistrée.</p>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
    // Validation simple
    document.getElementById("formDepense").addEventListener("submit", function(e) {
        const montant = document.getElementById("montant").value;

        if (montant <= 0) {
            alert("Le montant doit être supérieur à 0 !");
            e.preventDefault();
        }
    });
</script>

</body>
</html>
