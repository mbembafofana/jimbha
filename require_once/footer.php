<div id="pied_de_page">
	<ul>
		<!-- Création d'une liste où on affichera par lien les informations de bas de page-->
		<li><a href="apropos.php">A propos</a></li>
		<li><a href="contact.php">Contacter un administrateur</a></li>
	                
        <!-- Verificaton du statut de l'utilisateur-->
		<?php
            if (isset($_SESSION['statut']) AND $_SESSION['statut'] == 1)
            	{ ?>
					<li><a href="backoffice.php">Back-Office</a></li>
			<?php } ?>
	</ul>
</div> <!--Fin div id="pied_de_page"-->
