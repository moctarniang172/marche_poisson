<?php $title = "Ajouter Vente"; include("layout.php"); ?>
<?php
if (!isset($_GET['id'])) {
    die("Erreur : aucune vente sélectionnée !");
}
$id_vente = intval($_GET['id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Payer une dette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h3>Payer une dette</h3>

    <form action="../controllers/controllersPayer.php" method="POST">
        
        <!-- ID invisible et non modifiable -->
        <input type="hidden" name="id_vente" value="<?= $id_vente ?>">

        <div class="mb-3">
            <label class="form-label">Montant payé</label>
            <input type="number" name="montant" class="form-control" required>
        </div>

        <button class="btn btn-success w-100">Valider</button>
    </form>
</div>

</body>
</html>
