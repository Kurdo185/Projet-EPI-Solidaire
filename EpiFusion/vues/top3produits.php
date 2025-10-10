<div id="contenu">
  <h2>Top 3 des derniers produits ajoutés</h2>

  <?php if (empty($top3)): ?>
    <p>Aucun produit récemment ajouté.</p>
  <?php else: ?>
    <table class="listeLegere">
      <tr>
        <th>Réf.</th>
        <th>Désignation</th>
        <th>Qté</th>
        <th>Date</th>
        <th>Type</th>
      </tr>
      <?php foreach ($top3 as $p): ?>
        <tr>
          <td><?= htmlspecialchars($p['reference']) ?></td>
          <td><?= htmlspecialchars($p['designation']) ?></td>
          <td><?= (int)$p['totalAchat'] ?></td>
          <td><?= dateAnglaisVersFrancais(substr($p['dateJour'], 0, 10)) ?></td>
          <td><?= $p['estDon'] ? 'Don' : 'Vente' ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
</div>