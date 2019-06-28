<?php session_start(); ?>

<!DOCTYPE html>
<html class="h-100" lang="fr">
<head>
    <meta charset="utf-8">
    <meta HTTP-EQUIV="pragma" content="no-cache">
    <meta name="viewport" content="width-device-width, init-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery3.4.0.js"></script>
    <script src="js/onclick.js"></script>
    <script src="menu4.js"></script>
	<title>Article</title>
</head>
<body class="d-flex flex-column h-100">
<header>
    <?php require_once('require_once/db.php'); ?>
    <?php require_once("require_once/menu.php"); ?>
</header>    
    

        <!-- Si id_article est présenté dans URL, on utilise cet id pour récupérer les données de 3 tables: article, categorie, membre -->
        <?php if(isset($_GET['id'])){
        $article=$pdo->query('Select * from article where id='.$_GET['id'])->fetch();
        $objetcateg=$pdo->query('select * from objet where id='.$article['id_objet'])->fetch();
        $nomCateg=$pdo->query('select * from categorie where id='.$objetcateg['id_categorie'])->fetch();
        $pseudoMembre=$pdo->query('select * from membre where id='.$article['id_membre'])->fetch();
        ?>

        <div class="container-fluid">
            <div class="row">
                <?php require_once("require_once/menu_left.php") ?>
                <div id="sideButton" class="col-md-3">
                    <button id="hamburger"><img src="images/burger.png" style="width: 40px;"></button>
                </div> <!--Fin div id="sideButton"-->
                <div id="titre_article" class="d-flex flex-column col-md-3">
                    <h1><?=$article['marque'].' '.$article['nomArticle']; ?></h1>
                        <br>
                    <p><a style="color: black;" href="objet.php?id=<?= $objetcateg['id']; ?>">Voir tous les articles en vente pour le même type d'objet</a></p>
                    <h2><a href="categorie.php?id=<?= $nomCateg['id']; ?>"><?= $nomCateg['nom']; ?></a></h2>
                    <img width=200 height=200 src="images/article/<?= $article['id']; ?>.jpg">
                </div> <!--Fin div class="titre_article"-->

                <div id="description_article" class="d-flex flex-column col-md-2" style="margin-top: auto; margin-bottom: auto;">
                    <strong>Description :</strong><br><?= $article['marque'].' '.$article['nomArticle'].''.$article['description'] ?> <br><br>
                    <strong>Prix :</strong> <?= $article['prix'] ?> € <br><br>
                    <strong>Lieu :</strong> <?= $article['lieu'] ?> <br><br>
                    <strong>Etat :</strong> <?= $article['etat'] ?> <br><br>
                    <strong>Etat de vente:</strong> <?= $article['etatVente'] ?> <br><br>
                    <strong>Vendu par :</strong> <a href="vendeurarticle.php?id=<?= $pseudoMembre['id'] ;?>"><?= $pseudoMembre['pseudo']?></a> <br><br><br>                    <p>
                        <!-- Si la variable $_SESSION['id'] n'est pas vide : la session est demarrée -->
                    <?php if (!empty($_SESSION['id'])) {

                        // Si l'état de l'article est déclarée et il n'est pas égal à "Vendu"
                        if(isset($article['etatVente'])&&($article['etatVente']="En vente")) {

                        //On met dans la variable $infoPanier les données concernant l'article récupérées depuis la table panier
                        //avec un filtre id_achateur = id_visiteur
                        $infoPanier = $pdo->query(
                            'select * from panier as p inner join panierarticle as c on p.id=c.id_panier where c.id_article = '.$_GET['id'])->fetch();

                        $produitVendeur = $pdo->query('select * from article where id = '.$_GET['id'])->fetch();

                        //si c'est un acheteur (id_vendeur != id_visiteur)
                        if ($produitVendeur['id_membre'] != $_SESSION['id']) {
                            // Si la variable $infoPanier ne contient rien
                            if (!$infoPanier) {
                                ?>
                                <button id="bouton_article_pannier" class="btn btn-default" style="color: white; background-color: rgb(33, 67, 139);"><a id="ajoutpanier">Ajouter au panier</a></button> <?php
                            } else {
                                if($infoPanier['id_membre']== $_SESSION['id']){?>
                                    <a id="ajoutpanier" style="color: rgb(0, 174, 239)">Article ajouté</a> <?php
                                }else{ ?>
                                <a id="ajoutpanier">En attente</a>
                                <h4 style="color:red;"><b>Déjà sélectionné par un autre acheteur</b></h4><?php
                                }
                            }
                        }
                // Sinon on affiche que l'article est vendu
                        } else { ?> <a id="ajoutpanier">Déjà vendu</a> <?php }

                    } else { ?>
                        <a href="connexion.php">Connectez-vous pour acheter cet article</a>
                <?php } ?>
                    </p>
                </div> <!--Fin div class="description_article"-->



                <div id="commentaire" class="col-md-4">
                    <h1>Commentaires</h1>
                    <h2>Posez vos questions au vendeur !</h2>
                    <!-- Si on s'est connecté, on affiche le formulaire de commentaire -->
                    <?php if (isset($_SESSION['id'])) { ?>
                        <form action="article.php?id=<?= $_GET['id']; ?>" method="post">
                            <textarea name="com" cols="50" rows="3" class="form-control"></textarea><br>


                    <?php
                    $commentaires = $pdo->query('select * from commentaire where id_article = '.$_GET['id'].' order by id desc')->fetchAll();
                    //On parcourt le tableau $commentaires pour mettre les données de chaque ligne dans la variable $row
                    foreach ($commentaires as $row) {

                        $pseudo = $pdo->query('select * from membre where id = '.$row['id_membre'])->fetch();
                        ?>
                        <!-- Afficher dans un bloc les données: 'pseudo' lié avec le fichier profil.php (A construire)-->
                        <p><strong><a href=""><?= $pseudo['pseudo']; ?></a></strong>
                            <em><?= $row['date']; ?></em> <br>
                            <span><?= $row['message']; ?></span></p>
                        <?php
                    }
                    ?>

                            <button type="submit" class="btn btn-default" value="Envoyer" name="envoi" style="color: white; background-color: rgb(33, 67, 139);">Envoyer</button>
                        </form>
                        <?php //Sinon, il faut se connecter.
                    } else {
                        echo "<a href=\"connexion.php\">Connectez-vous pour poster un commentaire</a>";
                    }
                    // Si on s'est connecté et le formulaire est bien validé, on insert le commentaire dans la bdd
                    if (isset($_SESSION['id']) AND isset($_POST['envoi']) AND isset($_POST['com']) AND !empty($_POST['com'])) {
                        //Le message saisi est protégé par htmlspecialchars() contre la faille XSS
                        $pdo->exec('insert into commentaire(id_membre, id_article, message, date) values('.$_SESSION['id'].', '.$_GET['id'].', "'.htmlspecialchars($_POST['com']).'", NOW())');
                    }
                    ?>
                        </br></br>
                    <?php
                        $commentaires = $pdo->query('select * from commentaire where id_article = '.$_GET['id'].' order by id desc')->fetchAll();
                        //On parcourt le tableau $commentaires pour mettre les données de ligne dans la variable $row
                        foreach ($commentaires as $row)
                        {
                            $pseudo = $pdo->query('select * from membre where id = ' .$row['id_membre'])->fetch();
                    ?>
                            <!--Afficher dans un bloc les données : 'pseudo' lié avec le fichier profil.php (A construire)-->
                            <p><strong><a href="profil.php?id=<?= $row['id_membre']; ?>"><?= $pseudo['pseudo']; ?></a></strong><em><?= $row['date']; ?></em>
                                </br>
                            <span><?= $row['message']; ?></span>
                            </p>
                        <?php
                        }
                        ?>
                    




                </div> <!--Fin div id="commentaire"-->
            </div> <!--Fin div class="row"-->
        </div> <!--Fin class="container-fluid"-->
        
        <?php //require_once('require_once/footer.php');?>

        <script>
            // Création d'un object DOM avec la méthode getElementById qui traite la balise dont id est "ajoutpanier"
            var ajoutpanier = document.getElementById("ajoutpanier");
            var idArt = <?php echo $_GET['id']; ?>;
            <?php if(!empty($_SESSION['id'])){ ?>
                var idAcheteur = <?php echo $_SESSION['id']; }?>;
            var prix = <?php echo $article['prix']; ?>;
            var idVendeur = <?php echo $article['id_membre']; ?>;


            //On ajoute un evenement click sur l'objet 'ajoutpanier', puis on envoie la requête HTTP au serveur
            ajoutpanier.addEventListener("click", function(){

                if (ajoutpanier.innerHTML == "Ajouter au panier") {

                    var xhr = new XMLHttpRequest();
                    // On utilise la méthode onreadystatechange pour récupérer l'état de transmission de requête entre Client et Serveur
                    xhr.onreadystatechange = function() {
                        // Si l'état de requête = 4 (le navigateur a reçu la réponse du serveur) et status = 200(OK)
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            ajoutpanier.innerHTML = "Article ajouté";
                            ajoutpanier.style.color = "#ecf0f1";
                            bouton_article_pannier.style.backgroundColor = "rgb(0, 174, 239)";

                        }};
                    // L'objet xhr ouvre le fichier ajoutpanier.php en utilisant la méthode Post de manière asynchrone
                    xhr.open("POST", "ajoutpanier.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    // Envoi la requête au serveur
                    xhr.send("idArt="+idArt+"&idAcheteur="+idAcheteur+"&prix="+prix+"&idVendeur="+idVendeur);
                }
            });


        </script>
        <?php } else {
            echo "L'article n'existe pas.";
        } ?>
    <footer class="footer mt-auto py-3">
        <div class="container-fluid">
            <div class="row">
                <?php require_once('require_once/footer.php');?>
            </div> <!--Fin div class="row"-->
        </div> <!--Fin class="container-fluid"-->
    </footer>
</body>