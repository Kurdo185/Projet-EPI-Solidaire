<table class="listeLegere">
    <caption>Liste des acheteurs enregistrés</caption>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Téléphone</th>
        <th>Mail</th>
        <th>Date de naissance</th>
        <th>Justif. identité</th>
        <th>Justif. domicile</th>
        <th>Statut</th>
        <th class="action">Supprimer</th>
    </tr>

<?php
foreach ($lesAcheteurs as $a):
    // pretty status
    switch ($a['statut']) {
        case 'valide':
            $statutLbl = '✔ valide';
            break;
        case 'en_attente':
            $statutLbl = '⏳ en attente';
            break;
        default:
            $statutLbl = htmlspecialchars($a['statut']);
    }
?>
    <tr>
        <td><?= htmlspecialchars($a['nom'])          ?></td>
        <td><?= htmlspecialchars($a['prenom'])       ?></td>
        <td><?= htmlspecialchars($a['telephonePortable']) ?></td>
        <td><?= htmlspecialchars($a['mail'])         ?></td>
        <td><?= dateAnglaisVersFrancais($a['dateNaiss']) ?></td>

        <!-- icônes identiques à l’image -->
        <td class="center"><?= $a['justificatif_identite'] ? '✔️' : '❌' ?></td>
        <td class="center"><?= $a['justificatif_domicile'] ? '✔️' : '❌' ?></td>

        <td><?= $statutLbl ?></td>

        <td class="action">
            <a href="index.php?uc=listeAcheteurs&action=supprimerAcheteur&idAcheteur=<?= $a['id'] ?>"
               onclick="return confirm('Voulez-vous vraiment supprimer cet acheteur ?');">
               Supprimer cet acheteur
            </a>
        </td>
    </tr>
<?php endforeach; ?>
</table>