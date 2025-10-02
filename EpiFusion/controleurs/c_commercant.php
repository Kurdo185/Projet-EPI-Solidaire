<?php
if (($_SESSION['metier'] ?? '') !== 'commercant') {
    header('Location: index.php');
    exit;
}

require_once 'vues/v_sommaire.php';

$action = $_REQUEST['action'] ?? 'accueil';
$idCommerce = $_SESSION['idCommerce'];

switch ($action) {
    case 'mesProduits':
        $lesProduits = $pdo->getProduitsDuCommerce($idCommerce);
        include 'vues/commercant/v_mesProduits.php';
        break;

    default:
        header('Location: index.php?uc=commercant&action=mesProduits');
        exit;
}
?>