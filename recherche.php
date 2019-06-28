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
	<title>Recherche</title>
</head>
<body class="d-flex flex-column h-100">
	<header>
		<?php require_once('require_once/db.php') ?>
		<?php require_once("require_once/menu.php") ?>
	</header>

	<?php
		if(isset($_POST['input_recherche'])) $rech = htmlspecialchars(trim($_POST['input_recherche']));
		if(isset($_GET['input_recherche'])) $rech = htmlspecialchars(trim($_GET['input_recherche']));
	?>
	
	<div class="container-fluid">
		<div class="row">
			<?php require_once("require_once/menu_left.php") ?>
			<div id="sideButton" class="col-md-3">
				<button id="hamburger"><img src="images/burger.png" style="width: 40px;"></i></button>
			</div> <!--Fin div id="sideButton"-->
			<div id="recherche_content" class="d-flex flex-column col-md-9">
				<h1>Recherche</h1>
				<h2>" <?= $rech; ?> "</h2>
				<h2>Résultat</h2>
					<?php $trouve = false;
							$afficheaucun = false;

							$reqa = $pdo->query('SELECT a.nomArticle, a.prix, a.etatVente, a.id, o.nom as nomO, c.nom as nomC
												FROM article a INNER JOIN objet o ON a.id_objet = o.id 
													INNER JOIN categorie c ON o.id_categorie = c.id 
													WHERE a.nomArticle LIKE "%'.$rech.'%" OR 
														o.nom LIKE "%'.$rech.'%" OR c.nom LIKE "%'.$rech.'%"')->fetchAll();
					if($reqa != null){
					?>

					<table>
						<thead>
								<tr>
								<th scope="col">Nom Article</th>
								<th scope="col">Objet</th>
								<th scope="col">Categorie</th>
								<th scope="col">Prix</th>
								<th scope="col">Lien</th>
								</tr>
							</thead>
							<tbody>
						<?php }

							foreach($reqa as $row)
							{
								if($row['etatVente'] == "En vente" AND !empty($rech) AND $rech != "")
									{?>
									<tr>
										<td><strong><?= $row['nomArticle']; ?></strong></td>
										<td><?= $row['nomO']; ?></td>
										<td><?= $row['nomC']; ?></td>
										<td><?= $row['prix']; ?></td>
										<td><a href="article.php?id=<?= $row['id'] ?>">Voir</a></td>
									</tr><?php 
									} 
									$trouve = true;
							}?>	
							</tbody>
						</table>

						<?php
							if(!$trouve AND !$afficheaucun)
							{
								//echo "Aucun résultat";
								echo"<div class=\"alert alert-danger text-center mt-5\" role=\"alert\">
  Aucun résultat ! Revenir à <a href=\"index_.php\" class=\"alert-link\">la page d'accueil</a>.
</div>";

								$afficheaucun = true;
							}
						?>

			</div> <!--Fin div id="recherche_content"-->
		</div> <!--Fin div class="row"-->
	</div> <!--Fin class="container-fluid"-->

	<footer class="footer mt-auto py-3">
        <div class="container-fluid">
            <div class="row">
                <?php require_once('require_once/footer.php');?>
            </div> <!--Fin div class="row"-->
        </div> <!--Fin class="container-fluid"-->
    </footer>
</body>
</html>