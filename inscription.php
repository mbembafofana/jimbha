<?php session_start(); ?>
<!DOCTYPE html>

<?php require_once('require_once/db.php') ?>

<?php 
//Vérifie si le submit a été préssé
	if (isset($_POST['inscrivez_vous']))
	{
		//Evite d'injecter du HTML et hache les mots de passe dans la BD
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$nom = htmlspecialchars($_POST['nom']);
		$email = htmlspecialchars($_POST['email']);
		$email2 = htmlspecialchars($_POST['email2']);
		$mdp = htmlspecialchars($_POST['mdp2']);
		$mdp_crypt=password_hash($_POST['mdp'], PASSWORD_BCRYPT);
		$mdp2 = htmlspecialchars($_POST['mdp2']);
		

		//Vérifie si les champs sont vide
		if (!empty($_POST['pseudo']) AND
			!empty($_POST['prenom']) AND
			!empty($_POST['nom']) AND
			!empty($_POST['email']) AND
			!empty($_POST['email2']) AND
			!empty($_POST['mdp']) AND
			!empty($_POST['mdp2']) )
		{       
            $statut=0;
			//Vérifie la longueur du pseudo
			$pseudolength = strlen($pseudo);
			if($pseudolength <= 255)
			{
				if($email == $email2)
				{
					//Vérifie si il s'agit bien d'un E-mail
					if(filter_var($email, FILTER_VALIDATE_EMAIL))
					{
						$reqemail = $pdo->prepare("SELECT * FROM membre WHERE email = ?");
						$reqemail->execute(array($email));
						$mailexist = $reqemail->rowCount();
						if($mailexist == 0)
						{
							if($mdp == $mdp2)
							{
								$insertmbr = $pdo->prepare("INSERT INTO membre(pseudo, mdp, nom, prenom, email, statut) VALUES(?, ?, ?, ?, ?,?)");
								$insertmbr->execute(array($pseudo, $mdp_crypt, $nom, $prenom, $email,$statut));
								$erreur = "Votre compte a bien été crée ! <a href=\"connexion.php\">Me connecter</a>";
							}
							else
							{
								$erreur = "Vos mots de passes ne correspondent pas !";
							}	
						}
						else
						{
							$erreur = "Adresse E-mail déja utilisée !";
						}
					}
					else
					{
						$erreur = "Votre adresse E-mail n'est pas valide !";
					}
				}
				else
				{
					$erreur = "Vos adresse mail ne correspondent pas !";
				}
			}
			else
			{
				$erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
			}
		}
		else
		{
			$erreur = "Tous les champs doivent être complétés !";
		}
	}
?>

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
	<title>Inscription</title>
</head>
<body class="d-flex flex-column h-100">
	<header>
		<?php require_once("require_once/menu.php") ?>
	</header>
		<div class="container-fluid">
			<div class="row">
				<?php require_once("require_once/menu_left.php") ?>
				<div id="sideButton" class="col-md-3">
					<button id="hamburger"><img src="images/burger.png" style="width: 40px;"></button>
				</div> <!--Fin div id="sideButton"-->
				<div id="inscription_content" class="d-flex flex-column col-md-9">
					<form method="post" action="inscription.php">
						<h1>Inscription</h1>
						<div class="form-group">
							<label for="pseudo">Pseudo</label>
							<input type="text" name="pseudo" id="pseudo" class="form-control" required data-error="Pseudo" value="<?php if(isset($pseudo)) {echo $pseudo; } ?>">
						</div> <!--Fin div class="form-group"-->
						<div class="form-group">
							<label for="prenom">Prenom</label>
							<input type="text" name="prenom" id="prenom" class="form-control"  required data-error="Prenom" value="<?php if(isset($prenom)) {echo $prenom; } ?>">
						</div> <!--Fin div class="form-group"-->
						<div class="form-group">
								<label for="nom">Nom de Famille</label>
								<input type="text" name="nom" id="nom" class="form-control"  required data-error="Nom de Famille" value="<?php if(isset($nom)) {echo $nom; } ?>">
						</div> <!--Fin div class="form-group"-->
						<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" name="email" id="email" class="form-control"  required data-error="E-mail" value="<?php if(isset($email)) {echo $email; } ?>">
						</div> <!--Fin div class="form-group"-->
						<div class="form-group">
								<label for="email2">Confirmation de votre E-mail</label>
								<input type="email" name="email2" id="email2" class="form-control"  required data-error="Confirmation de votre e-mail" value="<?php if(isset($email2)) {echo $email2; } ?>">
						</div> <!--Fin div class="form-group"-->
						<div class="form-group">
								<label for="mdp">Mot de passe</label>
								<input type="password" name="mdp" id="mdp" class="form-control"  required data-error="Mot de passe">

						</div> <!--Fin div class="form-group"-->
						<div class="form-group">
								<label for="mdp2">Confirmation de mot de passe</label>
								<input type="password" name="mdp2" id="mdp2" class="form-control"  required data-error="Confirmation de votre mot de passe">				
						</div> <!--Fin div class="form-group"-->
								<br/>
									<button type="submit" class="btn btn-default"  name="inscrivez_vous" value="Inscrivez-vous" style="color: white; background-color: rgb(33, 67, 139);">Inscrivez-vous</button>
									<!-- <input type="submit" class="btn btn-default"  name="inscrivez_vous" value="Inscrivez-vous"> -->

					</form>
					<?php
						//Ecris $erreur si tous les champs ne sont pas complétés
						if(isset($erreur))
						{
							echo '<font color="red" >'.$erreur.'</font>';
						}
					?>
				</div> <!--Fin div id="inscription_index"-->
			</div> <!--Fin div class="row"-->
		</div> <!--Fin div class="container-fluid"-->
	<footer class="footer mt-auto py-3">
		<div class="container-fluid">
			<div class="row">
				<?php require_once("require_once/footer.php") ?>
			</div> <!--Fin div class="row"-->
		</div> <!--Fin class="container-fluid"-->
	</footer>
</body>
</html>