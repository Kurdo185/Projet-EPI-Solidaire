<?php
/* produitsendace.php  –  inclusion seule */
require_once __DIR__ . '/../include/modele.php';

$modele = Modele::getModele();
$liste  = $modele->getProduitsEnDace(); // méthode à créer
?>
<h3>Produits bientôt en rupture (stock ≤ 5)</h3>
<table class="listeLegere">
    <tr>
        <th>Réf.</th>
        <th>Désignation</th>
        <th>Stock actuel</th>
    </tr>
    <?php foreach ($liste as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['reference']) ?></td>
        <td><?= htmlspecialchars($p['designation']) ?></td>
        <td><?= (int)$p['stock'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>