<div id="contenu">
  <h2>Nouvelle offre ou don</h2>
  <form method="post" action="index.php?uc=commercant&action=ajouterOffre">
    <label>Produit :</label>
    <select name="produit"><?php
      foreach($listeRef as $r){
          echo '<option value="'.$r['reference'].'">'.$r['designation'].'</option>';
      }?></select><br/>
    <label>Quantité :</label>
    <input type="number" min="1" name="qte" required/>
    <br/>
    <label>Prix d’origine :</label>
    <input type="text" name="prixOrigine" required/>
    <br/>
    <label>Prix solidaire (laisser vide si don) :</label>
    <input type="text" name="prixSolidaire"/>
    <br/>
    <label><input type="checkbox" name="estDon" value="1"/> Cochez si c’est un don</label>
    <br/>
    <input type="submit" name="valider" value="Enregistrer"/>
  </form>
</div>