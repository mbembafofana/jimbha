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
    <title>Vendeur</title>
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
        <div id="vendeurarticle_content" class="d-flex flex-column col-md-9">
            <?php if (isset($_GET['id'])) {
                $req = $pdo->query('select * from membre where id = '.$_GET['id'])->fetch();
                ?>
                <h1><?= $req['pseudo']; ?></h1>
                <h2>Articles mis en vente par ce membre</h2>
                <p>
                <table>
                    <tr>
                        <th>Article</th>
                        <th>Prix (€)</th>
                        <th>Lieu</th>
                        <th>Etat</th>
                        <th>Fiche</th>
                    </tr>
                    <?php

                    $req = $pdo->query('select * from article where id_membre = '.$_GET['id'].'
                                        and (etatVente="En vente" or etatVente="En attente") order by id desc')->fetchAll();
                    foreach ($req as $row) {
                        ?>
                        <tr>
                            <td><?= $row['nomArticle'] ?></td>
                            <td><?= $row['prix'] ?></td>
                            <td><?= $row['lieu'] ?></td>
                            <td><?= $row['etat'] ?></td>
                            <td class="etatVente"><?= $row['etatVente'] ?></td>
                            <td><a href="article.php?id=<?= $row['id'] ?>">Voir</a></td>
                        </tr>
                        <?php
                    }

                    ?>
                </table>
                </p>
            <?php } ?>
        </div> <!--Fin div id="vendeurarticle_content"-->
    </div> <!--Fin div class="row"-->
</div> <!--Fin class="container-fluid"-->

<footer class="footer mt-auto py-3">
    <div class="container-fluid">
        <div class="row">
            <?php require_once('require_once/footer.php');?>
        </div> <!--Fin div class="row"-->
    </div> <!--Fin class="container-fluid"-->
</footer>
<script>

    var etatVente = document.getElementsByClassName("etatVente");
    for (var i = 0 ; i < etatVente.length ; i++) {
        if (etatVente[i].innerHTML == "En vente") {
            etatVente[i].style.backgroundColor = "rgba(39, 174, 96,0.7)";
        }

        if(etatVente[i].innerHTML == "En attente"){
            etatVente[i].style.backgroundColor = "rgba(243, 156, 18,0.7)";
        }
    }

</script>
</body>
</html>