<div class="container-fluid">
	<div class="row">
		<div id="menu" class="col-md-12">
			<ul>
				<li><a href="index_.php"><span class="logo"><span class="titre_jim">Jim</span><span class="titre_bha">bha</span></br>Site de vente informatique</br><span class="titre_particulier">entre particulier</span></span></a></li>
				<li><a href="vendre.php">Vends un objet</a></li>
				<li>
					<form method="post" action="recherche.php">
						<a href="javascript:void(0)" id="search">Rechercher</a>
						<ul id="barre_recherche">
							<li><input id="input_search" type="text" name="input_recherche" style="width: 100px;"><button id="submit_search" name="envoie" style="border-radius: 50px;">Envoie</button></li>
							<!-- <li><input id="submit_search" type="submit" name="envoie" value="Send"></li> -->
						</ul>
					</form>
				</li>
               <?php if (!isset($_SESSION['id'])) { ?>
					<li><a href="inscription.php"><button id="aide" style="border-radius: 50px;">S'inscrire</button></a></li>
					<li><a href="connexion.php"><button style="border-radius: 50px;">Se connecter</button></a></li> 
               		 <?php } else { ?>
               		 <li><a href="profil.php?id=<?= $_SESSION['id']; ?>"><?php echo "Bonjour ". $_SESSION['login']; ?></a></li>
                	<!-- <li><a href=""></a></li> -->
					<li><a href="deconnexion.php">Déconnexion</a></li>
                <?php } ?>
					<li class="panierMenu">
                		<?php if (isset($_SESSION['id']))
                		{
                        	$req = $pdo->query('select * from panier where id_membre = '.$_SESSION['id'])->fetchAll();
                        	$cpt=0;
                        	foreach($req as $row)
                          	{
                            	$statutPanier=$row['statut'];
                            	if($statutPanier==0)
                            	{
                            		$cpt++;
                            	}
                        	} ?>
                		<a href="panier.php"><span class="icon-cart"></span> Panier (<?= $cpt; ?>)</a>
                		<?php
               			 }?>
                	</li>
				<!-- <li><button id="aide"><a href="inscription.php">S'inscrire</a><a href="">Se connecter</a></button></li> -->
			</ul>
		</div> <!--Fin div class="menu"-->
	</div> <!--Fin div class="row"-->
</div> <!--Fin div class="container-fluide"-->