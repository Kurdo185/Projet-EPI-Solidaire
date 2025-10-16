<div id="contenu">
  <h2>Top 3 des produits les plus achetés</h2>

  <?php if (empty($top3)): ?>
    <p>Aucun achat enregistré.</p>
  <?php else: ?>
    <table class="listeLegere">
      <tr>
        <th>Réf.</th>
        <th>Désignation</th>
        <th>Qté totale vendue</th>
      </tr>
      <?php foreach ($top3 as $p): ?>
        <tr>
          <td><?= htmlspecialchars($p['reference']) ?></td>
          <td><?= htmlspecialchars($p['designation']) ?></td>
          <td><?= (int)$p['totalAchat'] ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
</div>