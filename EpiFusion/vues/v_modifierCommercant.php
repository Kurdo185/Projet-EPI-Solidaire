<div id="contenu">
  <h2>Modifier les infos du commerçant</h2>

  <form method="POST" action="index.php?uc=listeCommerces&action=modifierCommercant&id=<?= $infos['id'] ?>">
    <table class="listeLegere">
      <tr>
        <td>Nom du commerce :</td>
        <td><input type="text" name="nom" value="<?= htmlspecialchars($infos['nom']) ?>" required></td>
      </tr>
      <tr>
        <td>Rue :</td>
        <td><input type="text" name="rue" value="<?= htmlspecialchars($infos['rue']) ?>" required></td>
      </tr>
      <tr>
        <td>Code postal :</td>
        <td><input type="text" name="cp" value="<?= htmlspecialchars($infos['codePostal']) ?>" required></td>
      </tr>
      <tr>
        <td>Ville :</td>
        <td><input type="text" name="ville" value="<?= htmlspecialchars($infos['ville']) ?>" required></td>
      </tr>
      <tr>
        <td>Téléphone :</td>
        <td><input type="text" name="tel" value="<?= htmlspecialchars($infos['telephonePortable']) ?>"></td>
      </tr>
      <tr>
        <td>Mail :</td>
        <td><input type="email" name="mail" value="<?= htmlspecialchars($infos['mail']) ?>"></td>
      </tr>
    </table>
    <br>
    <input type="submit" value="Enregistrer">
    <a href="index.php?uc=listeCommerces&action=gererCommerces">Annuler</a>
  </form>
</div>