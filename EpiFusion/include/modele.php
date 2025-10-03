<?php
class Modele {
    private static $serveur = 'mysql:host=172.16.203.111';
    private static $bdd = 'dbname=getcet';
    private static $user = 'sio';
    private static $mdp = 'slam';
    private static $monPdo;
    private static $monModele = null;

    private function __construct(){
        self::$monPdo = new PDO(self::$serveur.';'.self::$bdd, self::$user, self::$mdp);
        self::$monPdo->query("SET CHARACTER SET utf8");
    }

    public static function getModele(){
        if(self::$monModele == null){
            self::$monModele = new Modele();
        }
        return self::$monModele;
    }

    public function getEmployeByLogin($login){
        $req = "SELECT idEmploye, nom, prenom, metier, mdp FROM Employe WHERE login = '$login'";
        $rs = self::$monPdo->query($req);
        return $rs->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdCommerceByEmploye($idEmploye){
        $idEmploye = (int)$idEmploye;
        $req = "SELECT c.idCommerce
                FROM commercant c
                JOIN habitant h ON h.idHabitant = c.idHabitant AND h.idFoyer = c.idFoyer
                WHERE h.idEmployeValidation = $idEmploye";
        $rs = self::$monPdo->query($req);
        $row = $rs->fetch();
        return $row ? (int)$row['idCommerce'] : null;
    }

    public function getProduitsDuCommerce($idCommerce) {
        $sql = "(SELECT p.reference, p.designation, v.qte, v.prixSolidaire, v.dateJour, 0 AS estDon
                 FROM vendre v
                 JOIN produit p ON p.reference = v.refProduit
                 WHERE v.idCommerce = ?)
                UNION
                (SELECT p.reference, p.designation, d.qte, NULL AS prixSolidaire, d.dateJour, 1 AS estDon
                 FROM donner d
                 JOIN produit p ON p.reference = d.refProduit
                 WHERE d.idCommerce = ?)
                ORDER BY dateJour DESC";
        $stmt = self::$monPdo->prepare($sql);
        $stmt->execute([$idCommerce, $idCommerce]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

	public function getLesAcheteurs(){
		$req = "
			SELECT  a.id                AS id,
					h.nom               AS nom,
					h.prenom            AS prenom,
					h.telephonePortable AS telephonePortable,
					h.mail              AS mail,
					h.dateNaiss         AS dateNaiss,
					a.justificatif_identite   AS justificatif_identite,
					a.justificatif_domicile   AS justificatif_domicile,
					a.statut            AS statut
			FROM   acheteur  a
			JOIN   habitant  h
				ON  h.idHabitant = a.idHabitant
				AND h.idFoyer   = a.idFoyer
			ORDER  BY h.nom, h.prenom";
		try {
			$stmt = self::$monPdo->prepare($req);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			error_log("Error in getLesAcheteurs: " . $e->getMessage());
			throw new Exception("Unable to fetch buyers list: " . $e->getMessage());
		}
	}

    public function supprimerAcheteur($idAcheteur){
        $idAcheteur = (int)$idAcheteur;
        $cmdIds = [];
        $st = self::$monPdo->query("SELECT id FROM commande WHERE idAcheteur = $idAcheteur");
        if ($st) {
            $cmdIds = $st->fetchAll(PDO::FETCH_COLUMN, 0);
        }

        self::$monPdo->beginTransaction();
        try {
            if (!empty($cmdIds)) {
                $ids = implode(',', array_map('intval', $cmdIds));
                foreach ([
                    "DELETE FROM ligne_commande WHERE idCommande IN ($ids)",
                    "DELETE FROM detailcommande WHERE idCommande IN ($ids)",
                    "DELETE FROM contenir WHERE idCommande IN ($ids)",
                ] as $sqlTry) {
                    try { self::$monPdo->exec($sqlTry); } catch (Exception $e) { /* ignore */ }
                }
                self::$monPdo->exec("DELETE FROM commande WHERE id IN ($ids)");
            }
            self::$monPdo->exec("DELETE FROM acheter WHERE idAcheteur = $idAcheteur");
            self::$monPdo->exec("DELETE FROM acheteur WHERE id = $idAcheteur");
            self::$monPdo->commit();
        } catch (Exception $e) {
            self::$monPdo->rollBack();
            throw $e;
        }
    }

    public function ajouterAcheteur($idHabitant, $idFoyer, $tel, $mail, $justifIdentite, $justifDomicile){
        $statut = ($justifIdentite == 1 && $justifDomicile == 1) ? 'valide' : 'en_attente';
        $req = "INSERT INTO acheteur (idHabitant, idFoyer, justificatif_identite, justificatif_domicile, statut)
                VALUES ($idHabitant, $idFoyer, $justifIdentite, $justifDomicile, " . self::$monPdo->quote($statut) . ")";
        self::$monPdo->exec($req);
    }

    public function getLesCommerces(){
        $req = "SELECT * FROM commerce";
        $res = self::$monPdo->query($req);
        return $res->fetchAll();
    }

    public function ajouterUnCommerce($nom, $rue, $cp, $ville){
        $req = "INSERT INTO commerce (nom, rue, codePostal, ville) VALUES ('$nom', '$rue', '$cp', '$ville')";
        self::$monPdo->exec($req);
    }

    public function supprimerCommerce($id){
        $req = "DELETE FROM commerce WHERE id = $id";
        self::$monPdo->exec($req);
    }

    public function getInfosEmployeById($id){
        $req = "SELECT nom, prenom, login, dateEmbauche FROM Employe WHERE idEmploye = $id";
        $rs = self::$monPdo->query($req);
        $ligne = $rs->fetch();
        $ligne['dateEmbauche'] = dateAnglaisVersFrancais($ligne['dateEmbauche']);
        return $ligne;
    }
/**
     * Retourne la liste complète des produits avec le nombre total d'achats
     * @return array
     */
    public function getProduitsAvecTotalAchat() {
        $sql = "
            SELECT 
                p.reference,
                p.designation,
                COALESCE(SUM(lc.qte), 0) AS totalAchat
            FROM produit p
            LEFT JOIN ligne_commande lc ON lc.refProduit = p.reference
            GROUP BY p.reference, p.designation
            ORDER BY totalAchat DESC
        ";
        return self::$monPdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>