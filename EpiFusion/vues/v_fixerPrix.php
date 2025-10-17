<div id="contenu">
    <h2>Fixer les prix solidaires</h2>

    <?php if (empty($lesOffres)): ?>
        <p>✅ Aucune offre en attente de fixation de prix.</p>
    <?php else: ?>
        <p>Liste des offres de vente sans prix solidaire fixé :</p>
        
        <table class="listeLegere">
            <tr>
                <th>Commerce</th>
                <th>Produit</th>
                <th>Date</th>
                <th>Prix origine</th>
                <th>Qté</th>
                <th>Prix solidaire</th>
                <th class="action">Action</th>
            </tr>
            <?php foreach ($lesOffres as $offre): ?>
                <tr>
                    <td><?= htmlspecialchars($offre['nomCommerce']) ?></td>
                    <td><?= htmlspecialchars($offre['designation']) ?></td>
                    
                    <td><?= number_format($offre['prixOrigine'], 2) ?> €</td>
                    <td><?= (int)$offre['qte'] ?></td>
                    <td>
                        <form method="POST" action="index.php?uc=prix&action=enregistrerPrix" style="display: inline;">
                            <input type="hidden" name="idCommerce" value="<?= $offre['idCommerce'] ?>">
                            <input type="hidden" name="refProduit" value="<?= htmlspecialchars($offre['refProduit']) ?>">
                            <input type="hidden" name="dateJour" value="<?= $offre['dateJour'] ?>">
                            
                            <input type="number" 
                                   name="prixSolidaire" 
                                   step="0.01" 
                                   min="0.01" 
                                   max="<?= $offre['prixOrigine'] ?>"
                                   placeholder="Prix" 
                                   required 
                                   style="width: 80px;">
                            €
                    </td>
                    <td class="action">
                            <input type="submit" value="Valider">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div style="margin-top: 20px; padding: 10px; background-color: #e8f4f8; border-left: 4px solid #2196F3;">
            <strong>💡 Conseil :</strong> Le prix solidaire doit être inférieur ou égal au prix d'origine.
        </div>
    <?php endif; ?>
</div>