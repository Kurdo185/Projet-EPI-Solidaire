<div id="contenu">
  <h2>Mon profil commerçant</h2>

  <table class="listeLegere">
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Login</th>
      <th>Date embauche</th>
    </tr>
    <tr>
      <td><?= htmlspecialchars($leProfil['nom']) ?></td>
      <td><?= htmlspecialchars($leProfil['prenom']) ?></td>
      <td><?= htmlspecialchars($leProfil['login']) ?></td>
      <td><?= htmlspecialchars($leProfil['dateEmbauche']) ?></td>
    </tr>
  </table>
</div>