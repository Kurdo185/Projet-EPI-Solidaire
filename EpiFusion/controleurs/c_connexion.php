<?php
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];

switch ($action) {
    case 'demandeConnexion':
        include("vues/v_connexion.php");
        break;

    /* ---------- DÉCONNEXION : VERSION ULTRA-SÛRE ---------- */
    case 'deconnexion':
        // 1. Démarrer la session si ce n’est pas déjà fait
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 2. Vider le tableau $_SESSION
        $_SESSION = [];

        // 3. Supprimer le cookie de session (peu importe son nom ou ses paramètres)
        $cookieParam = session_get_cookie_params();
        $name        = session_name();
        if (isset($_COOKIE[$name])) {
            setcookie(
                $name,
                '',
                time() - 42000,
                $cookieParam['path'],
                $cookieParam['domain'],
                $cookieParam['secure'],
                $cookieParam['httponly']
            );
        }

        // 4. Détruire la session côté serveur
        session_destroy();
        session_write_close();   // force l’écriture et la fermeture

        // 5. Rediriger vers la page de connexion
        header('Location: index.php?uc=connexion&action=demandeConnexion');
        exit;

    /* ---------- CONNEXION ---------- */
    case 'valideConnexion':
        $login    = $_POST['login'] ?? '';
        $mdpClair = $_POST['mdp']   ?? '';
        $mdpHash  = sha1($mdpClair);

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

    default:
        include("vues/v_connexion.php");
        break;
}