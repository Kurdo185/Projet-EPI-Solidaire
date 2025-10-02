<?php

// Accès réservé au rôle secretaire uniquement
if (!estConnecte() || ($_SESSION['metier'] ?? '') !== 'secretaire') {
    header('Location: index.php');
    exit;
}

include("vues/v_sommaire.php");
$idEmploye = $_SESSION['idEmploye'];

$action = $_REQUEST['action'];

	
switch($action){
	case 'gererAcheteurs':{
		$lesAcheteurs = $pdo->getLesAcheteurs();
		include("vues/v_listeAcheteurs.php");
		break;
	}
	case 'supprimerAcheteur':{
		$idAcheteur = $_REQUEST['idAcheteur'];
		$pdo->supprimerAcheteur($idAcheteur);
		$lesAcheteurs = $pdo->getLesAcheteurs();
		include("vues/v_listeAcheteurs.php");
	  break;
	}
}

?>