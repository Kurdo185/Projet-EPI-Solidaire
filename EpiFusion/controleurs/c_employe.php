<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idEmploye = $_SESSION['idEmploye'];

switch($action){
	case 'profil':{
		$leProfil = $pdo->getInfosEmployeById($idEmploye);

		if (($_SESSION['metier'] ?? '') === 'commercant') {
			include("vues/commercant/v_profil_commercant.php");
		} else {
			include("vues/v_profil.php");
		}
		break;
	}
	default:{
		header('Location: index.php?uc=employe&action=profil');
		exit;
	}
}
?>