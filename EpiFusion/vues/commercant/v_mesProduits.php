<div id="contenu">
  <h2>Mes produits / mes dons</h2>

  <?php if (empty($lesProduits)): ?>
    <p>Aucun produit ou don enregistré pour le moment.</p>
  <?php else: ?>
    <table class="listeLegere">
      <tr>
        <th>Réf.</th>
        <th>Désignation</th>
        <th>Qté</th>
        <th>Prix solidaire</th>
        <th>Date</th>
        <th>Type</th>
      </tr>
      <?php foreach ($lesProduits as $l): ?>
        <tr>
          <td><?= htmlspecialchars($l['reference']) ?></td>
          <td><?= htmlspecialchars($l['designation']) ?></td>
          <td><?= (int)$l['qte'] ?></td>
          <td><?= isset($l['prixSolidaire']) ? number_format($l['prixSolidaire'], 2) . ' €' : '--' ?></td>
          <td><?= dateAnglaisVersFrancais(substr($l['dateJour'], 0, 10)) ?></td>
          <td><?= $l['estDon'] ? 'Don' : 'Vente' ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
</div>