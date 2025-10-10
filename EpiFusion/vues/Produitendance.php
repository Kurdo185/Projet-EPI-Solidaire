<div id="contenu">
  <h2>Produits bientôt en rupture (stock ≤ 5)</h2>

  <?php if (empty($liste)): ?>
    <p>Aucun produit en rupture prochaine.</p>
  <?php else: ?>
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
  <?php endif; ?>
</div>