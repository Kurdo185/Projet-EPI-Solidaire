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

    case 'ajouterOffre':
        if (!isset($_POST['valider'])) {
            // Afficher le formulaire
            $listeRef = $pdo->getLesReferences();
            include 'vues/commercant/v_nouvelleOffre.php';
        } else {
            // Traiter le formulaire
            $reference = $_POST['produit'];
            $quantite = $_POST['qte'];
            $prixOrigine = $_POST['prixOrigine'];
            $prixSolidaire = !empty($_POST['prixSolidaire']) ? $_POST['prixSolidaire'] : null;
            $estDon = isset($_POST['estDon']) ? 1 : 0;
            
            // Ajouter l'offre à la base de données
            $pdo->enregistrerOffre($idCommerce, $reference, $quantite, $prixOrigine, $prixSolidaire, $estDon);
            header('Location: index.php?uc=commercant&action=mesProduits');
            exit;
        }
        break;

    default:
        header('Location: index.php?uc=commercant&action=mesProduits');
        exit;
}
?>