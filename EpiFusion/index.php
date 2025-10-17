<?php
session_start();
require_once("include/fonctions.php");
require_once("include/modele.php");
include("vues/v_entete.php");

$pdo = Modele::getModele();
$estConnecte = estConnecte();

if(!isset($_REQUEST['uc']) || !$estConnecte){
     $_REQUEST['uc'] = 'connexion';
}

$uc = $_REQUEST['uc'];
switch($uc){
    case 'connexion':
        include("controleurs/c_connexion.php");
        break;
    case 'employe':
    case 'profilEmploye':
        include("controleurs/c_employe.php");
        break;
    case 'commercant':
        include("controleurs/c_commercant.php");
        break;
    case 'listeCommerces':
        include("controleurs/c_gererCommerces.php");
        break;
    case 'listeAcheteurs':
        include("controleurs/c_gererAcheteurs.php");
        break;
    default:
        $_REQUEST['uc'] = 'connexion';
        include("controleurs/c_connexion.php");
        break;
case 'stats':
    include 'controleurs/c_stats.php';
    break;

    case 'produitsAchat':
    include("controleurs/c_produitsAchat.php");
    break;
    
    case 'prix':
    include("controleurs/c_prix.php");
    break;
}

include("vues/v_pied.php");

?>