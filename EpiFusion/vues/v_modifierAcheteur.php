<div id="contenu">
    <h2>Modifier les infos de l'acheteur</h2>
        <form method="POST" action="">
        <table class="listeLegere">

        <tr>
            <td> Nom de l'acheteur : </td>
            <td><input type="text" name="nomAcheteur" value="<?= htmlspecialchars($acheteur['nomAcheteur']) ?>" required></td>

        </tr>
        <tr>
            <td> Prénom de l'acheteur : </td>
            <td><input type="text" name="prenomAcheteur" value="<?= htmlspecialchars($acheteur['prenomAcheteur']) ?>" required></td>

        </tr>
        <tr>
            <td> Téléphone portable : </td>
            <td><input type="text" name="telephonePortable" value="<?= htmlspecialchars($acheteur['telephonePortable']) ?>" required></td>
        </tr>
        <tr>
            <td> Mail : </td>
            <td><input type="email" name="mail" value="<?= htmlspecialchars($acheteur['mail']) ?>" required></td>
        </tr>
        <tr>
            <td> Date de naissance : </td>
            <td><input type="date" name="dateNaiss" value="<?= htmlspecialchars($acheteur['dateNaiss']) ?>" required></td>
        </tr>
        <tr>
            <td> Justificatif d'identité : </td>
            <td>
                <select name="justificatif_identite" required>
                    <option value="1" <?= $acheteur['justificatif_identite'] ? 'selected' : '' ?>>✔️ Oui</option>
                    <option value="0" <?= !$acheteur['justificatif_identite'] ? 'selected' : '' ?>>❌ Non</option>
                </select>
            </td>
        </tr>
        <tr>
            Justificatif   de domicile :
            <td>
                <select name="justificatif_domicile" required>
                    <option value="1" <?= $acheteur['justificatif_domicile'] ? 'selected' : '' ?>>✔️ Oui</option>
                    <option value="0" <?= !$acheteur['justificatif_domicile'] ? 'selected' : '' ?>>❌ Non</option>
                </select>
            </td>
        </tr>
        <tr>
            <td> Statut : </td>
            <td>
                <select name="statut" required>
                    <option value="valide" <?= $acheteur['statut'] === 'valide' ? 'selected' : '' ?>>✔ valide</option>
                    <option value="en_attente" <?= $acheteur['statut'] === 'en_attente' ? 'selected' : '' ?>>⏳ en attente</option>
                </select>
            </td>
        </tr>

        <td>Supprimer : </td>
        <td>
            <input type="checkbox" name="supprimer" value="1">
        </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Enregistrer">
                <a href="index.php?uc=listeAcheteurs&action=gererAcheteurs">Annuler</a>
            </td>
        </tr>
    </table>
</div>
