<?php $title = "Liste Ventes"; include("layout.php"); ?>

<h3 class="fw-bold mb-4">📄 Liste des Ventes</h3>

<table class="table table-bordered table-striped shadow">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Poisson</th>
            <th>Poids</th>
            <th>Total</th>
            <th>Avance</th>
            <th>Reste</th>
            <th>Date</th>
            <th>Payer</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($ventes as $v): ?>
        <tr>
            <td><?= $v['id'] ?></td>
            <td><?= $v['nom_client'] ?></td>
            <td><?= $v['poisson'] ?></td>
            <td><?= $v['poids'] ?> kg</td>
            <td class="fw-bold"><?= $v['total'] ?> FCFA</td>
            <td><?= $v['avance'] ?></td>
            <td class="text-danger fw-bold"><?= $v['reste'] ?></td>
            <td><?= date('d/m/Y', strtotime($v['date_vente'])) ?></td>

            <td>
                <?php if($v['reste'] > 0): ?>
                <a href="payer.php?id=<?= $v['id'] ?>" class="btn btn-success btn-sm">Payer</a>
                <?php else: ?>
                <span class="badge bg-success">Payé</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include("layout_footer.php"); ?>
