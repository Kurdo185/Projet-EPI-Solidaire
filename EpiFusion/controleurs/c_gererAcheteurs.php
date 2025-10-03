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
		try {
			$lesAcheteurs = $pdo->getLesAcheteurs();
			include("vues/v_listeAcheteurs.php");
		} catch (Exception $e) {
			// Pass the error to the error view instead of letting a fatal exception occur
			$_REQUEST['erreurs'] = [ $e->getMessage() ];
			include("vues/v_erreurs.php");
		}
		break;
	}
	case 'supprimerAcheteur':{
		$idAcheteur = $_REQUEST['idAcheteur'];
		try {
			$pdo->supprimerAcheteur($idAcheteur);
			$lesAcheteurs = $pdo->getLesAcheteurs();
			include("vues/v_listeAcheteurs.php");
		} catch (Exception $e) {
			$_REQUEST['erreurs'] = [ $e->getMessage() ];
			include("vues/v_erreurs.php");
		}
	  break;
	}
}

?>