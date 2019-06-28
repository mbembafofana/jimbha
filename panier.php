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
	<title>Panier</title>
</head>
<body class="d-flex flex-column h-100">
    <header>
        <?php require_once('require_once/db.php') ?>
        <?php require_once("require_once/menu.php") ?>
    </header>
        <div class="container-fluid">
            <div class="row">
                <?php require_once("require_once/menu_left.php") ?>
                <div id="sideButton" class="col-md-2">
                    <button id="hamburger"><img src="images/burger.png" style="width: 40px;"></i></button>
                </div> <!--Fin div id="sideButton"-->
                <div id="panier_content" class="col-md-8">
                    <h1>Panier de <?= $_SESSION['login']; ?></h1>
                    <h2>Article(s) ajouté(s) à la commande :</h2>
                    <p><table width="700">
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Vendeur</th>
                            <th>Lieu</th>
                            <th>Prix</th>
                            <th>Suppr.</th>
                        </tr>
            <?php 
                        $total = 0;
                        $idPanier=array();
                        $paniers_Selectionne = $pdo->query('SELECT * FROM panier AS p INNER JOIN panierarticle AS pa ON p.id=pa.id_panier INNER JOIN article AS a ON pa.id_article=a.id WHERE p.statut = 0 and p.id_membre ='.$_SESSION['id'].'')->fetchAll();
                        //var_dump(count($paniers_Selectionne)); exit();
                        $cpt = count($paniers_Selectionne);
                    if ($cpt > 0)
                    {
                        foreach ($paniers_Selectionne as $panier_Selectionne)
                        {
                            array_push($idPanier, $panier_Selectionne['id_panier']);
                            $vendeur = $pdo->query('select * from membre where id = '.$panier_Selectionne['id_membre'])->fetch();
                            $total += floatval($panier_Selectionne['prix']);?>
                            <tr>
                                <td><img src="images/article/<?= $panier_Selectionne['id_article']; ?>.jpg" alt="" width="100"></td>
                                <td><?= $panier_Selectionne['nomArticle']; ?></td>
                                <td><?= $vendeur['pseudo']; ?></td>
                                <td><?= $panier_Selectionne['lieu']; ?></td>
                                <td><?= $panier_Selectionne['prix']; ?> €</td>
                                <td><a href="supprpanier.php?id=<?= $panier_Selectionne['id_panier']; ?>" class="supprpanier">x</a></td>
                            </tr>
                            <?php
                        }
                    ?>
                            <tr>
                                <td style="border: 0; background: rgb(218,218,218);">&nbsp;</td>
                                <td style="border: 0; background: rgb(218,218,218);">&nbsp;</td>
                                <td style="border: 0; background: rgb(218,218,218);">&nbsp;</td>
                                <td style="font-weight: bold;">TOTAL</td>
                                <td style="font-weight: bold;"><?= $total; ?> €</td>
                            </tr>
                    </table></p>    
                
                <?php if ($total != 0)
                { ?>
                     <button id="bouton_pannier" class="btn btn-default" style="color: white; background-color: rgb(33, 67, 139);"><a class="validecommande" id="validecommande">Payer la commande</a></button>
        <?php   } 
                    }
                    else
                    {
                        echo "<tr><td colspan=\"6\">Aucun objet ajouté au panier.</td></tr>";
                    }
                ?>
                </div> <!--Fin div id="panier_content"-->
            </div> <!--Fin div class="row"-->
        </div> <!--Fin class="container-fluid"-->





<?php //require_once('require_once/footer.php');?>


<script>

    var validecommande = document.getElementById("validecommande");
    //json_encode():conversion d'une variable php au format JS
    var idPanier = <?php echo json_encode($idPanier); ?>;
    //stringfy(): conversion d'un tableau JS en string
    var strIdPanier = JSON.stringify(idPanier);
    

    validecommande.addEventListener("click", function(){
            if (validecommande.innerHTML != "Commande validée") {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                      if (xhr.readyState == 4 && xhr.status == 200) {
                        validecommande.innerHTML = "Commande validée";
                        bouton_pannier.style.backgroundColor = "rgb(0, 174, 239)";
                      }
                    };
                    xhr.open("POST", "validecommande.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.send("idPanier=" + strIdPanier );
                    
               
            }
    });

</script>
    <footer class="footer mt-auto py-3">
        <div class="container-fluid">
            <div class="row">
                <?php require_once('require_once/footer.php');?>
            </div> <!--Fin div class="row"-->
        </div> <!--Fin class="container-fluid"-->
    </footer>
</body>
</html>