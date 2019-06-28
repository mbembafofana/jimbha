<?php 

session_start();
require_once('require_once/db.php');

//json_decode(): conversion d'un objet String JSON au format PHP
$idPanier = json_decode($_POST['idPanier']);

foreach($idPanier as $panier){
    $pdo->exec('update panier set statut = 1 where id = '.$panier);   
    $idArticle = $pdo->query('select id_article from panierarticle where id_panier = '.$panier)->fetch();
    $article = $pdo->query('select * from article where id='.$idArticle[0])->fetch();
    $pdo->exec('update article set etatVente = "Vendu" where id = '.$idArticle[0]);
    $pdo->exec('insert into commande( montant, date, id_panier) values('.$article['prix'].', NOW(),'.$panier.')');  
    
    //Si l'id du vendeur n'existe pas dans la table profilmembre, on y l'insert. id_profil = 3(vendeur)
    $profilmembre_vendeur=$pdo->query('select * from profilmembre where id_profil!=2 and id_membre = '.$article['id_membre'])->fetch();
    if(!$profilmembre_vendeur){
        $pdo->exec('insert into profilmembre( id_profil,id_membre)values(3,'.$article['id_membre'].')');
    }
}

//Si l'id de l'acheteur n'existe pas dans la table profilmembre, on y l'insert. id_profil = 2(acheteur)
$profilmembre_acheteur=$pdo->query('select * from profilmembre where id_profil!=3 and id_membre = '.$_SESSION['id'])->fetch();
if(!$profilmembre_acheteur){
    $pdo->exec('insert into profilmembre( id_profil,id_membre)values(2,'.$_SESSION['id'].')');
}

?>