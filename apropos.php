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
	<title>A propos</title>
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
                    <button id="hamburger"><img src="images/burger.png" style="width: 40px;"></button>
                </div> <!--Fin div id="sideButton"-->
                <div id="apropos_content" class="d-flex flex-column col-md-9">
                    <h1>Mentions légales</h1>
                        </br>
                    <p><b>Forme de la société :</b> société anonyme</p>

                    <p><b>Capital social :</b> 50 000.00 €</p>

                    <p><b>RCS de Paris :</b> 750 000 000</p>

                    <p><b>Siège social :</b> 7 rue du du Louvre 75 001 Paris</p>

                    <p><b>Courrier électronique :</b><a href="mailto:contact@jimbha.com"> contact@jimbha.com</a></p>

                    <p><b>Numéro de TVA :</b> FR 26 750 000 000</p>

                    <p><b>Hébergeur du site</b> : Groupe JIMBHA</p>

                    <p><b>Directrice de la publication :</b> Jolin TSAI</p>

                    <p><b>Standard du siège social :</b><a href="tel: +33123456789"> 01 23 45 67 89</a></p>

                    <b>Numéro CNIL :</b> n°110000</p>

                    <p><b>Responsable du site web :</b> Jolin TSAI</p>

                    <p><b>Hébergeur du site :</b> Groupe JIMBHA</p>

                    <p><b>Directrice de la publication :</b> Jolin TSAI</p>
                    
                </div> <!--Fin div id="content"-->
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