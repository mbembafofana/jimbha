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
    <title>Vendre</title>
</head>
<style>

</style>
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

                <!-- S'il y a une session ouverte -->
                <?php if (isset($_SESSION['id'])) { ?>
                <div id="vendre_content" class="d-flex flex-column col-md-9">
                    <!-- Bannière de la page -->
                        <img src="images/ecommerce.jpg">
                        <h1>Mettre un objet en vente</h1>
                        <p>Commencez par trouver l'objet que vous voulez vendre dans notre base de données.</p>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <label>Objet</label>
                                </br>
                            <select name="objet" id="objet">
                            <?php
                                // Requête PHP pour lister les objets
                                $req = $pdo->query('select * from objet order by nom')->fetchAll();

                            foreach ($req as $row)
                            {
                                echo "<option value=\"".$row['id']."\">".$row['nom']."</option>";
                            }

                            ?>
                            </select>
                                </br>
                            <label for="nomArticle">Nom de l'article</label>
                            <input type="text" name="nomArticle" class="form-control">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control">
                            <label for="marque">Marque de l'article</label>
                            <input type="text" name="marque" class="form-control">
                            <label for="etat">Etat</label>
                            <select name="etat" id="etat">
                                <option value="Neuf" >Neuf</option>
                                <option value="Reconditionné" >Reconditionné</option>
                                <option value="D'occasion" selected>D'occasion</option>
                            </select>
                            <label for="prix">Prix €</label>
                            <input type="text" name="prix" class="form-control"> 
                            <label for="lieu">Lieu</label>
                            <input type="text" placeholder="Ville" name="lieu" class="form-control">
                            <label for="file">Fichier Image</label>
                                        
                                        
                            <div class="form-group">
                                            
                                <input onchange="showFileName()" type="file"  class="form-control-file bg-transparent text-dark" name="photo_upload" id="exampleFormControlFile1">
                            </div>
                            <script>
                                function showFileName()
                                {
                                    var photo = document.getElementById("exampleFormControlFile1");
                                    document.getElementById("exampleFormControlFile1").innerHTML = photo.files.item(0).name;
                                }
                            </script>

                            <button type="submit" value="Valider" name="envoi" class="btn btn-default" style="color: white; background-color: rgb(33, 67, 139);">Valider</button>
                        </form>
                        <?php
                        // Condition d'envoi avec isset(si la variable existe) et !empty(different de null)
                            if(
                                isset($_POST['envoi']) AND
                                isset($_POST['objet']) AND !empty($_POST['objet']) AND
                                isset($_POST['nomArticle']) AND !empty($_POST['nomArticle']) AND
                                isset($_POST['description']) AND !empty($_POST['description']) AND
                                isset($_POST['lieu']) AND !empty($_POST['lieu']) AND
                                isset($_POST['marque']) AND !empty($_POST['marque']) AND
                                isset($_POST['prix']) AND !empty($_POST['prix'])
                                ) 
                            {
                                    $valide="ok";
                            } 
                            elseif (isset($_POST['envoi'])) 
                            {
                                echo "erreur";
                            }
                                
                                    

                            }else
                            { ?>

                                <div id="pas_connecte">
                                    <p>Vous n'êtes pas connecté(e). <a href="connexion.php">Se connecter</a>
                                        <br>
                                    Pas de compte ? <a href="inscription.php">Inscrivez-vous</a></p>
                                </div> <!--Fin div id="pas_connecte"-->

                            <?php }
                                
                            ?>
                </div> <!--Fin div id="vendre_content"-->
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