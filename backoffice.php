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
    <title>Back Office</title>
</head>

<body class="d-flex flex-column h-100">
	<header>
		<?php require_once('require_once/db.php') ?>
		<?php require_once("require_once/menu.php") ?>
	</header>
		<div class="container-fluid">
			<div class="row">
				<?php require_once("require_once/menu_left.php") ?>
				<div id="sideButton" class="col-md-3">
					<button id="hamburger"><img src="images/burger.png" style="width: 40px;"></i></button>
				</div> <!--Fin div id="sideButton"-->
				<div id="backoffice_content" class="d-flex flex-column col-md-9">
					<?php 
						if (isset($_SESSION['statut']) AND $_SESSION['statut'] == 1) {
					?>

					<h1>Interface d'administration</h1>
					<h2>Articles en attente de validation</h2>
						<table class="table table-striped table-dark">
							<thead>
								<tr>
								<th scope="col">Nom Article</th>
								<th scope="col">Pseudo</th>
								<th scope="col">Aperçu</th>
								<th scope="col">Valider</th>
								<th scope="col">Refuser</th>
								</tr>
							</thead>
							<tbody>
						<?php 
							$articles = $pdo->query('select * from article where etatVente = "A valider"');
							foreach ($articles as $article)
							{
								$auteur = $pdo->query('select * from membre where id = '.$article['id_membre'])->fetch();
						?>
							
							<tr>
								<td><strong><?= $article['nomArticle']; ?></strong></td>
								<td><?= $auteur['pseudo']; ?></td>
								<td><a href="article.php?id=<?= $article['id']; ?>">Voir</a></td>
								<td><a href="validearticle.php?id=<?= $article['id']; ?>&action=ac" style="color: #27ae60;">Accepter</a></td>
								<td><a href="validearticle.php?id=<?= $article['id']; ?>&action=re" style="color: #c0392b;">Rejeter</a></td>
							</tr>

					<?php 	} ?>
							</tbody>
						</table>
					<?php 
					} ?>
				</div> <!--Fin div id="backoffice_content"-->
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