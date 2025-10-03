<?php
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];




switch ($action) {
    case 'demandeConnexion':
        

       $_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}



        include("vues/v_connexion.php");
        break;

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

            session_destroy();
            
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