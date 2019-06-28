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
    <title>Objet</title>
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
                    <button id="hamburger"><img src="images/burger.png" style="width: 40px;"></button>
                </div> <!--Fin div id="sideButton"-->
                <div id="objet_content" class="d-flex flex-column col-md-9">
                    <?php
                     $articlesVente=$pdo->query('select * from article where etatVente="En vente"')->fetchAll();
                    if($articlesVente)
                    {   
                             if (isset($_GET['id']))
                            {
                                $objet = $pdo->query('select * from objet where id = '.$_GET['id'])->fetch(); ?>
                                <h1><?= $objet['nom']; ?></h1>
                                <h2>Articles en vente</h2>
                                <table>
                                <?php                   
                                    foreach ($articlesVente as $article)
                                    { 
                                        if($article['id_objet']==$objet['id']){?> 
                                        <tr>
                                            <td><img src="images/article/<?= $article['id']; ?>.jpg" alt="" width="100px"></td>
                                            <td><strong><?= $article['nomArticle']; ?></strong></td>
                                            <td><?= $article['description']; ?></td>
                                            <td><strong>&nbsp<?= $article['prix']; ?>€</strong></td>
                                            <td>&nbsp<?= $article['lieu']; ?></td>
                                            <td><a href="article.php?id=<?= $article['id'] ?>">Voir</a></td>
                                        </tr>
                                        <?php }                    
                                    }           
                            }
                    }?>
                                </table>
                </div> <!--Fin div id="objet_content"-->
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