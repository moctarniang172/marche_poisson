<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Gestion Poissonnerie</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #0d6efd;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-size: 16px;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .card-box {
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="text-center mb-4">📊 Dashboard</h4>

        <a href="index.php">➕ Ajouter Vente</a>
        <a href="liste_ventes.php">📄 Liste des Ventes</a>
        <a href="liste_dettes.php">💰 Dettes Clients</a>
        <a href="paiements.php">🏦 Paiements</a>
        <a href="depenses.php">📉 Dépenses</a>
        <a href="bilan.php">📘 Bilan Journalier</a>
        <a href="#">⚙️ Paramètres</a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <h2 class="mb-4">Bienvenue dans votre tableau de bord</h2>

        <div class="row">

            <!-- TOTAL VENTES -->
            <div class="col-md-4 mb-3">
                <div class="card bg-primary text-white card-box">
                    <h4>Ventes du Jour</h4>
                    <p class="fs-3">0 FCFA</p>
                </div>
            </div>

            <!-- DETTES -->
            <div class="col-md-4 mb-3">
                <div class="card bg-warning text-dark card-box">
                    <h4>Dettes en Cours</h4>
                    <p class="fs-3">0 FCFA</p>
                </div>
            </div>

            <!-- DEPENSES -->
            <div class="col-md-4 mb-3">
                <div class="card bg-danger text-white card-box">
                    <h4>Dépenses du Jour</h4>
                    <p class="fs-3">0 FCFA</p>
                </div>
            </div>

        </div>

        <!-- SECTION RAPIDE -->
        <div class="row mt-4">
            <div class="col-md-6">
                <a href="ajouter_vente.php" class="btn btn-success w-100 p-3">➕ Enregistrer une nouvelle vente</a>
            </div>

            <div class="col-md-6">
                <a href="controllers/controllerBilan.php" class="btn btn-info w-100 p-3">📘 Voir le Bilan du Jour</a>
            </div>
        </div>

    </div>

</body>
</html>
