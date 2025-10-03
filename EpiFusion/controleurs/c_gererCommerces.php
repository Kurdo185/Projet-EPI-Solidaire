<?php

// Accès réservé aux rôles maire ou secretaire
if (!estConnecte() || !in_array(($_SESSION['metier'] ?? ''), ['maire','secretaire'])) {
    header('Location: index.php');
    exit;
}

include("vues/v_sommaire.php");

$idEmploye = $_SESSION['idEmploye'];

$action = $_REQUEST['action'];

	
switch($action){
	case 'gererCommerces':{
		$lesCommerces = $pdo->getLesCommerces();
		include("vues/v_listeCommerces.php");
		include("vues/v_ajoutCommerce.php");
		break;
	}
	case 'supprimerCommerce':{
		$idCommerce= $_REQUEST['id'];
		$pdo->supprimerCommerce($idCommerce);
		$lesCommerces = $pdo->getLesCommerces();
		include("vues/v_listeCommerces.php");
		include("vues/v_ajoutCommerce.php");
	  break;
	}
	case 'ajouterUnCommerce':{
		$nom = $_REQUEST['nom'];
		$rue = $_REQUEST['rue'];
		$cp = $_REQUEST['cp'];
		$ville = $_REQUEST['ville'];
		$pdo->ajouterUnCommerce($nom, $rue, $cp, $ville);
		$lesCommerces = $pdo->getLesCommerces();
		include("vues/v_listeCommerces.php");
		include("vues/v_ajoutCommerce.php");
		break;
	}

	case 'stockCritique':{
		$perimes = $pdo->getProduitsPerimes();
		$critiques = $pdo->getProduitsStockCritique();
   		include("vues/maire/v_stockCritique.php");
    	break;
	}

}


?>