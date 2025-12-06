<?php $title = "Ajouter Vente"; include("layout.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter une vente</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #eef4ff;
    }
    .card {
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.15);
    }
    #suggestions {
        position: absolute;
        background: white;
        border: 1px solid #ccc;
        width: 100%;
        z-index: 9999;
        display: none;
    }
    #suggestions div {
        padding: 8px;
        cursor: pointer;
    }
    #suggestions div:hover {
        background: #e9ecef;
    }
</style>
</head>

<body class="p-4">

<div class="container">
    <div class="card p-4">
        <h2 class="text-primary mb-3">Ajouter une vente</h2>

        <!-- Message dette -->
        <div id="infoDette" class="alert d-none"></div>

        <!-- Suggestions autocomplétion -->
        <div id="suggestions"></div>

        <form id="formVente" method="POST" action="../controllers/controllesDataVente.php">

            <div class="row g-3">

                <!-- Nom client -->
                <div class="col-md-3 position-relative">
                    <label class="form-label">Nom du client</label>
                    <input type="text" class="form-control" id="nom_client" name="nom_client" autocomplete="off" required>
                </div>

                <!-- Poisson -->
                <div class="col-md-2">
                    <label class="form-label">Poisson</label>
                    <select class="form-select" id="poisson" name="poisson" required>
                        <option value="">-- Choisir --</option>
                        <option>Tilapia</option>
                        <option>Maquereau</option>
                        <option>Sardine</option>
                        <option>Thon</option>
                    </select>
                </div>

                <!-- Poids -->
                <div class="col-md-2">
                    <label class="form-label">Poids (kg)</label>
                    <input type="number" class="form-control" id="poids" name="poids" step="0.01" required>
                </div>

                <!-- Prix -->
                <div class="col-md-2">
                    <label class="form-label">Prix unitaire (FCFA/kg)</label>
                    <input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" step="0.01" required>
                </div>

                <!-- Avance -->
                <div class="col-md-1">
                    <label class="form-label">Avance</label>
                    <input type="number" class="form-control" id="avance" name="avance" value="0">
                </div>

                <!-- Total -->
                <div class="col-md-1">
                    <label class="form-label">Total</label>
                    <input type="number" class="form-control" id="total" readonly>
                </div>

                <!-- Reste -->
                <div class="col-md-1">
                    <label class="form-label">Reste</label>
                    <input type="number" class="form-control" id="reste" readonly>
                </div>

                <div class="col-md-12 mt-3">
                    <input type="submit" class="btn btn-primary w-100" value="Enregistrer la vente">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// ------------ CALCUL AUTOMATIQUE ------------
const poids = document.getElementById('poids');
const prix = document.getElementById('prix_unitaire');
const avance = document.getElementById('avance');
const total = document.getElementById('total');
const reste = document.getElementById('reste');

function updateCalc() {
    const p = parseFloat(poids.value) || 0;
    const pu = parseFloat(prix.value) || 0;
    const av = parseFloat(avance.value) || 0;

    const t = p * pu;
    const r = Math.max(t - av, 0);

    total.value = t.toFixed(2);
    reste.value = r.toFixed(2);
}
poids.oninput = prix.oninput = avance.oninput = updateCalc;


// ------------ AUTOCOMPLÉTION CLIENTS ------------
const inputClient = document.getElementById("nom_client");
const boxSuggestions = document.getElementById("suggestions");

inputClient.addEventListener("input", function() {
    const nom = this.value.trim();

    if (nom.length < 2) {
        boxSuggestions.style.display = "none";
        return;
    }

    fetch("controllers/searchClients.php?nom=" + nom)
        .then(res => res.json())
        .then(data => {
            boxSuggestions.innerHTML = "";
            boxSuggestions.style.display = "block";

            data.forEach(client => {
                let div = document.createElement("div");
                div.innerText = client.nom_client;
                div.onclick = () => {
                    inputClient.value = client.nom_client;
                    boxSuggestions.style.display = "none";
                    verifierDette(client.nom_client);
                };
                boxSuggestions.appendChild(div);
            });
        });
});

document.addEventListener("click", () => boxSuggestions.style.display = "none");


// ------------ VÉRIFIER DETTES D'UN CLIENT ------------
function verifierDette(nom) {
    fetch("controllers/checkDette.php?client=" + nom)
        .then(res => res.json())
        .then(data => {
            const info = document.getElementById("infoDette");
            info.classList.remove("d-none");

            if (data.dette > 0) {
                info.className = "alert alert-danger";
                info.innerHTML = "🔴 Dette existante : <b>" + data.dette + " FCFA</b>";
            } else {
                info.className = "alert alert-success";
                info.innerHTML = "🟢 Ce client n’a aucune dette";
            }
        });
}
</script>

</body>
</html>
