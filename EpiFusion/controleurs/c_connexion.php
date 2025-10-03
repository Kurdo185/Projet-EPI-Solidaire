<?php
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];

switch ($action) {
    case 'demandeConnexion':
        include("vues/v_connexion.php");
        break;

    case 'deconnexion':
        // Détruire toutes les variables de session
        $_SESSION = array();

        // Détruire le cookie de session si il existe
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-3600, '/');
        }

        // Détruire la session
        session_destroy();

        // Rediriger vers la page de connexion
        header("Location: index.php?uc=connexion&action=demandeConnexion");
        exit;

    case 'valideConnexion': {
        $login = $_POST['login'] ?? '';
        $mdpClair = $_POST['mdp'] ?? '';
        $mdpHash = sha1($mdpClair);

        $employe = $pdo->getEmployeByLogin($login);
        if (!$employe || $employe['mdp'] !== $mdpHash) {
            ajouterErreur("Login ou mot de passe incorrect");
            include("vues/v_erreurs.php");
            include("vues/v_connexion.php");
            break;
        }

        // Enregistrement en session
        $_SESSION['idEmploye'] = $employe['idEmploye'];
        $_SESSION['nom']       = $employe['nom'];
        $_SESSION['prenom']    = $employe['prenom'];
        $_SESSION['metier']    = $employe['metier'];

        // Redirection selon le métier
        switch ($employe['metier']) {
            case 'commercant':
                $idC = $pdo->getIdCommerceByEmploye($employe['idEmploye']);
                if ($idC) {
                    $_SESSION['idCommerce'] = $idC;
                    header('Location: index.php?uc=employe&action=profil');
                    exit;
                }
                ajouterErreur("Commerçant non lié à un commerce");
                include("vues/v_erreurs.php");
                include("vues/v_connexion.php");
                break;

            case 'maire':
            case 'secretaire':
                header('Location: index.php?uc=employe&action=profil');
                exit;

            default:
                header('Location: index.php?uc=connexion');
                exit;
        }
        break;
    }

    default:
        include("vues/v_connexion.php");
        break;
}