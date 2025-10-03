<?php
/* top3produits.php  –  inclusion seule */
require_once __DIR__ . '/../include/modele.php';

$modele = Modele::getModele();
$top    = $modele->getTop3Produits();   // méthode à créer
?>
<h3>Top 3 des produits les plus achetés</h3>
<table class="listeLegere">
    <tr>
        <th>Réf.</th>
        <th>Désignation</th>
        <th>Qté totale vendue</th>
    </tr>
    <?php foreach ($top as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['reference']) ?></td>
        <td><?= htmlspecialchars($p['designation']) ?></td>
        <td><?= (int)$p['totalAchat'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>