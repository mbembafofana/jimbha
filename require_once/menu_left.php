<?php require_once('require_once/db.php') ?>
<div id="menu_left" class="col-md-3">
<button id="closeHamburger"><img src="images/burger.png" style="width: 40px;"></i></button>
	<ul>
	    <li><a href="categorie.php" style="font-size:30px; text-align: left; color: rgb(0, 174, 239);"> Categorie d'objet </a></li>
	    <?php 
	        $req = $pdo->query('select * from categorie order by nom')->fetchAll();
	        foreach ($req as $row) {
	            echo "<li><button><a href=\"categorie.php?id=".$row['id']."\"> ".$row['nom']."</a></button></li>";
	        }
	    ?>
	</ul>
</div> <!--Fin div id="menu_left"-->