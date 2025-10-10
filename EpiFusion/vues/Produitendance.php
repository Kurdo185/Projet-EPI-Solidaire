<div id="contenu">
  <h2>Produits en tendance (les plus achetés)</h2>

  <?php if (empty($topAchat)): ?>
    <p>Aucun achat enregistré.</p>
  <?php else: ?>
    <table class="listeLegere">
      <tr>
        <th>Réf.</th>
        <th>Désignation</th>
        <th>Qté vendue</th>
      </tr>
      <?php foreach ($topAchat as $p): ?>
        <tr>
          <td><?= htmlspecialchars($p['reference']) ?></td>
          <td><?= htmlspecialchars($p['designation']) ?></td>
          <td><?= (int)$p['totalAchat'] ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
</div>