<div id="contenu">
  <h2>Liste des produits avec nombre d’achats</h2>

  <?php if (empty($lesProduits)): ?>
    <p>Aucun produit trouvé.</p>
  <?php else: ?>
    <table class="listeLegere">
      <tr>
        <th>Réf.</th>
        <th>Désignation</th>
        <th>Total achats</th>
      </tr>
      <?php foreach ($lesProduits as $p): ?>
        <tr>
          <td><?= htmlspecialchars($p['reference']) ?></td>
          <td><?= htmlspecialchars($p['designation']) ?></td>
          <td><?= (int)$p['totalAchat'] ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
</div>