<?php
// Accès : maire ou secrétaire
if (!estConnecte() || !in_array(($_SESSION['metier'] ?? ''), ['maire', 'secretaire'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../include/modele.php';
require_once __DIR__ . '/../include/fonctions.php';

include("vues/v_sommaire.php");

$action = $_REQUEST['action'] ?? 'dashboard';

switch ($action) {
    case 'top3':
        $top3 = $pdo->getTop3Produits();
        include 'vues/top3produits.php';
        break;

    case 'Produitendance':
        $liste = $pdo->getProduitsEnDace();
        include 'vues/Produitendance.php';
        break;

    default:
        header('Location: index.php?uc=stats&action=top3');
        exit;

case 'produitsTendance':
    $topAchat = $pdo->getProduitsTendance(5);   // 5 plus achetés
    include 'vues/v_produitsTendance.php';
    break;

}