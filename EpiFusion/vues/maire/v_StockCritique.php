<h2>Produits périmés</h2>
<table class="listeLegere">
    <caption>Liste des produits périmés</caption>
    <tr>
        <th>Commerce</th>
        <th>Référence</th>
        <th>Désignation</th>
        <th>Stock actuel</th>
        <th>Date de péremption</th>
    </tr>
<?php
foreach ($perimes as $p) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($p['commerce']) . '</td>';
    echo '<td>' . htmlspecialchars($p['reference']) . '</td>';
    echo '<td>' . htmlspecialchars($p['designation']) . '</td>';
    echo '<td>' . (int)$p['qteStock'] . '</td>';
    echo '<td>' . dateAnglaisVersFrancais($p['datePeremption']) . '</td>';
    echo '</tr>';
}
?>
</table>

<h2>Stock critique</h2>
<table class="listeLegere">
    <caption>Liste des produits en stock critique (&lt; 5)</caption>
    <tr>
        <th>Référence</th>
        <th>Désignation</th>
        <th>Stock actuel</th>
    </tr>
<?php
foreach ($critiques as $p) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($p['reference']) . '</td>';
    echo '<td>' . htmlspecialchars($p['designation']) . '</td>';
    echo '<td>' . (int)$p['qteStock'] . '</td>';
    echo '</tr>';
}
?>
</table>