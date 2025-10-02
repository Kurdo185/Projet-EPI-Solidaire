<div id="contenu">
  <h2>Espace Commerçant – <?php echo $_SESSION['prenom'].' '.$_SESSION['nom']; ?></h2>

  <table class="listeLegere">
    <caption>Vos accès métiers</caption>
    <tr><th>Libellé</th><th class="action">Accéder</th></tr>
    <tr><td>Mes produits en cours</td>
        <td><a href="index.php?uc=commercant&action=mesProduits">Consulter</a></td></tr>
    <tr><td>Enregistrer un don / une vente solidaire</td>
        <td><a href="index.php?uc=commercant&action=ajouterOffre">Nouvelle offre</a></td></tr>
    <tr><td>Mes statistiques de ventes</td>
        <td><a href="index.php?uc=commercant&action=stats">Afficher</a></td></tr>
    <tr><td>Télécharger mon récapitulatif PDF</td>
        <td><a href="index.php?uc=commercant&action=pdfRecap">Exporter</a></td></tr>
  </table>
</div>