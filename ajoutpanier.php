<?php
require_once('require_once/db.php');

//Incrémentation des informations en fonctions des données récupérés
$idArt = isset($_POST['idArt']) ? $_POST['idArt'] : NULL;
$idAcheteur = isset($_POST['idAcheteur']) ? $_POST['idAcheteur'] : NULL;
$prix = isset($_POST['prix']) ? $_POST['prix'] : NULL;
$idVendeur = isset($_POST['idVendeur']) ? $_POST['idVendeur'] : NULL;

//Insertion des informations dans la table panier
$pdo->exec('insert into panier(prix, statut, id_membre) 
values('.$prix.',0, '.$idAcheteur.')');

//Insertion des informations dans la table d'association "panierarticle"
$idPanier=$pdo->query('select * from panier where id_membre = '.$idAcheteur.' order by id desc')->fetch();
$pdo->exec('insert into panierarticle(id_article, id_panier)
values('.$idArt.','.$idPanier['id'].')');

//Si l'acheteur a ajouté un article, "etatVente" de l'article doit être mis à jour (En vente => En attente)
if($idPanier){
    $pdo->exec('update article set etatVente="En attente" where id='.$idArt);
}

?>	

