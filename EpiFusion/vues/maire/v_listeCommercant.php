<h2>Liste des commerçants et nombre de produits</h2>

<table class="listeLegere">
    <caption>Commerçants et leurs produits</caption>
    <tr>
        <th>Commerce</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Téléphone</th>
        <th>Mail</th>
        <th>Nb produits</th>
    </tr>
<?php
foreach ($lesCommercants as $c) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($c['commerce']) . '</td>';
    echo '<td>' . htmlspecialchars($c['nom']) . '</td>';
    echo '<td>' . htmlspecialchars($c['prenom']) . '</td>';
    echo '<td>' . htmlspecialchars($c['telephonePortable']) . '</td>';
    echo '<td>' . htmlspecialchars($c['mail']) . '</td>';
    echo '<td>' . (int)$c['nbProduits'] . '</td>';
    echo '</tr>';
}
?>
</table>