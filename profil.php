<?php session_start(); ?>
<!DOCTYPE html>

<html class="h-100">
<head>
    <meta charset="utf-8">
    <meta HTTP-EQUIV="pragma" content="no-cache">
    <meta name="viewport" content="width-device-width, init-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="js/jquery3.4.0.js"></script>
    <script src="js/onclick.js"></script>
	<title>Profil</title>
</head>

<body class="d-flex flex-column h-100">
<header>
    <?php require_once('require_once/db.php'); ?>
    <?php require_once("require_once/menu.php"); ?>
</header>
<div class="container-fluid">
    <div class="row">
        <?php require_once("require_once/menu_left.php") ?>
        <div id="sideButton" class="col-md-3">
            <button id="hamburger"><i class="fas fa-bars"></i></button>
        </div> <!--Fin div id="sideButton"-->
        <div id="mon_compte" class="d-flex flex-column col-md-9">
<?php if (!empty($_SESSION['id'])) { ?>
    <!-- <div class="container" style="width:1000px; margin-left:300px;"> -->
    <h1>Mon compte</h1>
    <?php
        $idprofil = $pdo->query('select p.id from profil as p
                                        inner join profilmembre as pm on pm.id_profil=p.id
                                        inner join membre as m on m.id=pm.id_membre
                                        where m.id=' . $_SESSION['id'])->fetchAll();
        foreach($idprofil as $row)
        {
            if($row['id']=="2")
            {
                $isAcheteur=true;
            }
            if($row['id']=="3")
            {
                $isVendeur=true;
            }
        }
    ?>
    <?php if(!empty($isVendeur)){ ?>
        <h2>Mes objets en vente</h2>
        <p>
        <table class="objetsVente">
            <tr>
                <th>Article</th>
                <th>Description</th>
                <th>Prix (€)</th>
                <th>Etat</th>
                <th>Etat de Vente</th>
                <th>Fiche</th>
            </tr>
            <?php
            $req = $pdo->query('select * from article where id_membre = ' . $_SESSION['id'] . ' order by id desc');
            $cpt = $req->rowCount();
            if ($cpt > 0)
            {
                foreach ($req as $row)
                {
                    ?>
                    <tr>
                        <td><?= $row['nomArticle'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['prix'] ?></td>
                        <td><?= $row['etat'] ?></td>
                        <td class="etatVente"><?= $row['etatVente'] ?></td>
                        <td><a href="article.php?id=<?= $row['id'] ?>">Voir</a></td>
                    </tr>
                    <?php
                }
            }
            else
            {
                echo "<tr><td colspan=\"5\">Aucun objet en vente.</td></tr>";
            }
            ?>
        </table>
        </p>

        <h2>Vos statistiques</h2><?php

        $articleVente=$pdo->query('select * from article where id_membre='.$_SESSION['id']. ' and (etatVente = "En vente" or etat = "En attente")')->fetchAll();
        
        $compteur=0;
        foreach($articleVente as $row){
           
            $nbComs =$pdo->query('select * from commentaire where id_article='.$row['id'])->rowCount();
            $compteur=$compteur+$nbComs;
        }

        $nbObjets = $req->rowCount();
        $nbCommandes = $pdo->query('select c.id from commande as c
                                    inner join panier as p on p.id=c.id_panier
                                    inner join panierarticle as pa on pa.id_panier=p.id
                                    inner join article as a on a.id=pa.id_article
                                    inner join membre as m on m.id=a.id_membre
                                    where m.id=' . $_SESSION['id'])->rowCount();
        ?>
        <p>Objets mis en vente : <?= $nbObjets; ?><br>
            Commandes passées : <?= $nbCommandes; ?><br>
            Messages postés : <?= $compteur; ?>
        </p>

        <h2>Messages posés pour les objets en vente ou en l'attente</h2>
        <p>
        <table id="message">
            <tr>
                <th>Article</th>
                <th>Message</th>
                <th>Demandeur</th>
                <th>Date</th>
            </tr>
            <?php
            
                foreach($articleVente as $row){   
                $articles=$pdo->query('select a.nomArticle , c.message , c.date, m.pseudo
                                                from article a                                             
                                                inner join commentaire c on a.id=c.id_article
                                                inner join membre m on c.id_membre=m.id
                                                where a.id='.$row['id']
                                                )->fetchAll(); 
                foreach($articles as $article){

                ?>
                <tr>
                    <td><?= $article['nomArticle']?></td>
                    <td><?= $article['message'] ?></td>
                    <td><?= $article['pseudo'] ?></td>
                    <td><?= $article['date'] ?></td>
                    </tr>

                <?php 
                }
                }

            ?>
   
        </table>
        </p>
    <?php } ?>
    <?php  if(!empty($isAcheteur)) { ?>
        <h2>Mon panier en l'attente de commande: </h2> <a href='panier.php'>Voir</a>
        <?php ;
    }  ?>


    <h2>Identifiant</h2>
    <p>Votre identifiant est : <?= $_SESSION['login']; ?></p>
    <h4>Changer votre identifiant</h4>
    <form method="post" action="">
        <div class="form-group">
            <label>Votre nouvel identifiant</label>
            <input type="text" name="changelogin" class="form-control">
        </div> <!--Fin div class="form-group"-->
        <button type="submit" class="btn btn-default" name="envoi" value="OK" style="color: white; background-color: rgb(33, 67, 139);">OK</button>
    </form>

    <?php if (isset($_POST['changelogin']) AND !empty($_POST['changelogin']) AND isset($_POST['envoi'])) {

        $pdo->exec('update membre set pseudo = "' . $_POST['changelogin'] . '" where id = ' . $_SESSION['id']);
        echo "L'identifiant a été changé.";
        $_SESSION['login'] = $_POST['changelogin'];
        header('refresh:2; url="profil.php?id="' . $_SESSION['id']);
    } ?>

    <h2>Mot de passe</h2>
    <h4>Modifier votre mot de passe :</h4>
    <form method="post" action="">
            <div class="form-group">
                <label>Mot de passe actuel</label>
                <input name="oldmdp" class="form-control" type="password">
            </div> <!--Fin div class="form-group"-->
            <div class="form-group">
                <label>Nouveau mot de passe</label>
                <input name="newmdp" class="form-control" type="password">
            </div> <!--Fin div class="form-group"-->
            <div class="form-group">
                <label>Confirmation du nouveau mot de passe</label>
                <input name="newmdpconf" class="form-control" type="password">
            </div> <!--Fin div class="form-group"-->
                <button name="envoimdp" type="submit" class="btn btn-default" value="OK" style="color: white; background-color: rgb(33, 67, 139);">OK</button>
    </form>
</div> <!--Fin div id="mon_compte"-->
</div> <!--Fin div class="row"-->
</div> <!--Fin class="container-fluid"-->


    <?php if ( isset($_POST['envoimdp']) AND
        isset($_POST['oldmdp']) AND !empty($_POST['oldmdp']) AND
        isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND
        isset($_POST['newmdpconf']) AND !empty($_POST['newmdpconf']) AND $_POST['newmdpconf'] == $_POST['newmdp']
    ) {
        $req = $pdo->query('select * from membre where id = ' . $_SESSION['id'])->fetch();
        if ($req) {
            if (password_verify($_POST['oldmdp'],$req['mdp'])) {
                $newmdp_crypt=password_hash($_POST['newmdp'], PASSWORD_BCRYPT);
                $pdo->exec('update membre set mdp = "' . $newmdp_crypt . '" where id = ' . $_SESSION['id']);
                echo '<div id="mdp_modifie">Le mot de passe a bien été modifié.</div>';
            } else {
                echo '<div id="mdp_incorrect">Le mot de passe a bien été modifié.</div>';
            }
        }
    }?>

    <?php if ( isset($_POST['envoimdp']) AND
        isset($_POST['newmdpconf']) AND !empty($_POST['newmdpconf']) AND $_POST['newmdpconf'] != $_POST['newmdp']) {
        echo "La confirmation du mot de passe ne correspond pas.";
    }?>


<?php }
else { ?> <p>Vous n'êtes pas connecté(e). <a href="connexion.php">Se connecter</a></p> <?php } ?>
<!-- </div> -->

	<footer class="footer mt-auto py-3">
		<div class="container-fluid">
			<div class="row">
				<?php require_once("require_once/footer.php") ?>
			</div> <!--Fin div class="row"-->
		</div> <!--Fin class="container-fluid"-->
	</footer>
  <script>

	var etat = document.getElementsByClassName("etatVente");
	for (var i = 0 ; i < etat.length ; i++) {
		if (etat[i].innerHTML == "En vente") {
			etat[i].style.backgroundColor = "rgba(39, 174, 96,0.7)";
		} else if (etat[i].innerHTML == "Vendu" || etat[i].innerHTML == "Refusé") {
			etat[i].style.backgroundColor = "rgba(192, 57, 43,0.7)";		
		} else {
			etat[i].style.backgroundColor = "rgba(243, 156, 18,0.7)";
		}
	}

</script>
</body>
</html>
