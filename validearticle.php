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

<?php require_once('require_once/db.php') ?>
<?php require_once("require_once/menu.php") ?>
<?php require_once("require_once/menu_left.php") ?>
<div id="sideButton">
    <input src="js/webvp.js" onclick="openNav()" href="javascript:void(0);"><i class="fas fa-bars"></i>
</div>
<?php 

if (isset($_SESSION['statut']) AND $_SESSION['statut'] == 1 AND
	isset($_GET['id']) AND isset($_GET['action'])) {
	$id = $_GET['id'];
	$action = $_GET['action'];

	if ($action == "ac") {
		$pdo->exec('update article set etatVente = "En vente" where id = '.$id);
	} elseif ($action == "re") {
		$pdo->exec('update article set etatVente = "Refusé" where id = '.$id);
	} else {
		header("Location: index_.php");
	}
}
header("Location: backoffice.php");
?>
    <footer class="footer mt-auto py-3">
        <div class="container-fluid">
            <div class="row">
                <?php require_once('require_once/footer.php');?>
            </div> <!--Fin div class="row"-->
        </div> <!--Fin class="container-fluid"-->
    </footer>
</body>
</html>