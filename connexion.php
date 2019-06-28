<?php 

    if (!empty($_POST['login']) AND !empty($_POST['mdp']))
    {
        require('require_once/db.php');
            
        $req = $pdo->query('select * from membre where pseudo ="'.$_POST['login'].'"')->fetch(); 

            // les codes du cas sans Hash : if ($req['mdp']==$_POST['mdp'])
            if (password_verify($_POST['mdp'],$req['mdp']) OR ($_POST['mdp'] == $req['mdp']))
            {
                session_start();
                //var_dump($_SESSION['id']); exit();
                $_SESSION['id'] = $req['id'];
                $_SESSION['login'] = $req['pseudo'];
                $_SESSION['statut'] = $req['statut'];              
                      
                header("Location: index_.php");

?>
    <?php
                }
                else
                {
                    //var_dump($_SESSION['id']); exit();
                    echo "<p>Mauvais identifiant ou mot de passe.</p>";
                }
    } ?>

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
	<title>Connexion</title>	
</head>
<body class="d-flex flex-column h-100">
    <header>
        <?php require_once("require_once/menu.php"); ?>
    </header>
<div class="container-fluid">
    <div class="row">
        <?php require_once("require_once/menu_left.php") ?>
        <div id="sideButton" class="col-md-3">
            <button id="hamburger"><img src="images/burger.png" style="width: 40px;"></i></button>
        </div> <!--Fin div id="sideButton"-->
        <div id="inscription_content" class="d-flex flex-column col-md-9">
            <form method="post" action="connexion.php">
                    <br/>
                <h1>Connexion</h1>
                <div  class="form-group">
                    <label for="login">Pseudo</label>
                    <input type="text" name="login" class="form-control">  
                </div> <!--Fin div class="form-group"-->
                <div  class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" name="mdp" class="form-control">
                </div> <!--Fin div class="form-group"-->
                <button type="submit" class="btn btn-default" name="envoi" value="Se connecter" style="color: white; background-color: rgb(33, 67, 139);">Connectez-vous</button>
                    </br>
                        <p>Pas de compte ?</p>
                        <td><a href="inscription.php">S'inscrire</a></td>
            </form>


        </div> <!--Fin div id="inscription_content"-->
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
