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
	<title>Jimbha</title>
</head>
<body class="d-flex flex-column h-100">
	<header>
		<?php require_once('require_once/db.php') ?>
		<?php require_once("require_once/menu.php") ?><!--  -->
	</header>
		<div class="container-fluid">
			<div class="row">
				<?php require_once("require_once/menu_left.php") ?>
				<div id="sideButton" class="col-md-3">
					<button id="hamburger"><img src="images/burger.png" style="width: 40px;"></button>
				</div> <!--Fin div id="sideButton"-->
				<div id="content" class="d-flex flex-column col-md-9">
					<img src="images/logo homepage2.png" class="img-responsive">
					<button><a href="vendre.php">Commence à vendre</a></button>
				</div> <!--Fin div id="content"-->
			</div> <!--Fin div class="row"-->
		</div> <!--Fin class="container-fluid"-->

		<div id="corps">
		<div class="container">
			<div class="row">
				<div id="sales_pictures" class="col-md-10">
					<?php 
					       //Requête select sur la base de donnée afin d'aller chercher les données de la table objetvente trié par id limité à 20 ligne
					       $req = $pdo->query('select * from article where etatVente ="En vente" order by id desc limit 8')->fetchAll();
					       //boucle pour chaque requête sur les lignes
					       foreach ($req as $row)
					       {
					      // Si les l'état des lignes n'est pas null (en vente), on entre dans la boucle
						       if ($row['etatVente'])
						       {
							       ?> 
							               <div class="column">
							                   <a href="article.php?id=<?= $row['id']; ?>"><img src="images/article/<?= $row['id']; ?>.jpg"></a>
							                       <div class="detail">                                
							                           <span class="idArticle" style="color: rgb(0, 174, 239)"><b><?= $row['id']; ?></b>&nbsp</span>
							                           <span class="marque"><?= $row['marque']; ?></span>
							                           <span class="nomArticle"><?= $row['nomArticle']; ?></span><br> 
							                           <span class="description"><?= $row['description']; ?></span><br> 
							                           <span class="prix"><b><?= $row['prix']; ?>&nbsp€</b></span><br>
							                           <span class="lieu"><?= $row['lieu']; ?></span><br>
							                           <span class="etat" style="color: rgb(33, 67, 139);"><b><?= $row['etat']; ?></b></span><br>
							                       </div>

							               </div> 
							       <?php
						        }
					        }
					                ?>
				</div> <!--Fin div id="sales_pictures"-->
			</div> <!--Fin div class="row"-->
		</div> <!--Fin class="container"-->
		</div> <!--Fin div id="corps"-->

	<footer class="footer mt-auto py-3">
        <div class="container-fluid">
            <div class="row">
                <?php require_once('require_once/footer.php');?>
            </div> <!--Fin div class="row"-->
        </div> <!--Fin class="container-fluid"-->
    </footer>

</body>
</html>