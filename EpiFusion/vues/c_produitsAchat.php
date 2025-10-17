<?php
// Accès réservé : maire ou secrétaire uniquement
if (!estConnecte() || !in_array(($_SESSION['metier'] ?? ''), ['maire', 'secretaire'])) {
    header('Location: index.php');
    exit;
}

// Inclusion du sommaire (menu de navigation)
include("vues/v_sommaire.php");

// Récupération de l'action demandée (par défaut : liste)
$action = $_REQUEST['action'] ?? 'liste';

switch ($action) {
    case 'liste':
        // Récupération de tous les produits avec leur nombre d'achats
        $lesProduits = $pdo->getProduitsAvecTotalAchat();
        
        // Affichage de la vue
        include("vues/v_listeProduitsAchat.php");
        break;

    default:
        // Si l'action n'existe pas, redirection vers la liste
        header('Location: index.php?uc=produitsAchat&action=liste');
        exit;
}
?>