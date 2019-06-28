<?php 

session_start();
require_once('require_once/db.php');

$panier = $pdo->query('select * from panier where id = '.$_GET['id'])->fetch();

if ($panier['id_membre'] == $_SESSION['id']) {
        $idArticle = $pdo->query('select id_article from panierarticle where id_panier = '.$_GET['id'])->fetch();
        $pdo->exec('update article set etatVente="En vente" where id='.$idArticle[0]);
        $pdo->exec('delete from panierarticle where id_panier = '.$_GET['id']);
	$pdo->exec('delete from panier where id = '.$_GET['id']);
	header("Location: panier.php");
} else {
	echo "Vous n'avez pas l'autorisation de supprimer cet objet.<br>
	<a href=\"index_.php\">Retour à l'accueil</a>";
}
?>