<div id="menuGauche">
<div id="infosUtil">
    <?php $metier = $_SESSION['metier'] ?? ''; ?>
    <p><?php echo ucfirst($metier); ?> : <?php echo $_SESSION['prenom']." ".$_SESSION['nom']; ?></p>
    <hr/>
</div>

    <ul id="menuList">
        <?php
        $m = $_SESSION['metier'] ?? '';
        switch($m){
            case 'maire': ?>
                <li><a href="index.php?uc=stats&action=dashboard">Tableau de bord global</a></li>
                <li><a href="index.php?uc=listeCommerces&action=gererCommerces">Gestion des commerces</a></li>
                <li><a href="index.php?uc=listeAcheteurs&action=gererAcheteurs">Gestion des acheteurs</a></li>
                <li><a href="index.php?uc=dons&action=ajouterExterne">Don extérieur</a></li>
                <li><a href="index.php?uc=pdf&action=rapportMensuel">Rapport PDF</a></li>
                <?php break;

            case 'secretaire': ?>
                <li><a href="index.php?uc=listeCommerces&action=gererCommerces">Gestion des commerces</a></li>
                <li><a href="index.php?uc=listeAcheteurs&action=gererAcheteurs">Gestion des acheteurs</a></li>
                <li><a href="index.php?uc=prix&action=fixer">Fixer prix solidaire</a></li>
                <li><a href="index.php?uc=stats&action=top3produits">Top 3 produits</a></li>
                <li><a href="index.php?uc=pdf&action=listeCommerces">Export PDF</a></li>
                <?php break;

            case 'commercant': ?>
                <li><a href="index.php?uc=commercant&action=mesProduits">Mes produits</a></li>
                <li><a href="index.php?uc=commercant&action=ajouterOffre">Nouvelle offre / don</a></li>
                <li><a href="index.php?uc=commercant&action=stats">Mes statistiques</a></li>
                <li><a href="index.php?uc=commercant&action=pdfRecap">Export PDF récap.</a></li>
                <li><a href="index.php?uc=produitsAchat&action=Produitendance">Produits les plus achetés</a></li>
                <?php break;

            default: ?>
                <li><a href="index.php">Se connecter</a></li>
        <?php } ?>

        <li class="smenu">
            <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Se déconnecter</a>
        </li>
    </ul>
</div>