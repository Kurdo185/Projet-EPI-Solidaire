<?php
// Accès : maire ou secrétaire
if (!estConnecte() || !in_array(($_SESSION['metier'] ?? ''), ['maire', 'secretaire'])) {
    header('Location: index.php');
    exit;
}

include("vues/v_sommaire.php");

$action = $_REQUEST['action'] ?? 'liste';

switch ($action) {
    case 'liste':
        $lesProduits = $pdo->getProduitsAvecTotalAchat();
        include("vues/v_listeProduitsAchat.php");
        break;

    default:
        header('Location: index.php?uc=produitsAchat&action=liste');
        exit;
}
?>