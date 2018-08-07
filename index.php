 <?php 
	session_start();// Démarrer la session
?>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="style.css" type="text/css" rel="stylesheet"/>
	</head
	<body>
		<header>
		<br/><h1> <a href="index.php"title="Gérer votre budget vous meme!"> Mon budget<sub></sub></a> </h1><br/>
		</header>
		 <?php 
			if(isset($_REQUEST['msg']))
			echo $_REQUEST['msg'];
			if(isset($_REQUEST["login"])){
				$lg = $_REQUEST["login"];
				$mdp = $_REQUEST["pwd"];	
				if($connect=mysqli_connect("localhost","root","vieux5223","gestion_budget"))
				{
					$mdpencrypt = md5($mdp);
					$requete = "select * from users where phone='$lg' and password='$mdpencrypt';";
						if($resultat=mysqli_query($connect, $requete))
						{
							if(mysqli_num_rows($resultat)==0)
								{
									echo " numéro ou mot de passe incorrect";	
								}
							else
							{
								$ligne = mysqli_fetch_array($resultat);	
								$_SESSION["id"]=$ligne["idUser"];
								$id=$ligne["idUser"];
								$_SESSION["numero"]=$lg;
								$_SESSION["mail"]=$ligne["mail"];
								$_SESSION["prenom"]=$ligne["prenom"];
								$_SESSION["nom"]=$ligne["nom"];
								$_SESSION["adrIP"]=$_SERVER['HTTP_HOST'];
							}

						}
						else
							echo"Impossible d'executer la requete!";
					
				}else
					echo"Impossible de connecter au serveur de bd!";
			}
		?>
		<div>
			<?php
			if(isset($_SESSION["prenom"]))
			{?>
				<div class="connexion">
					<br /><br /><br /><br />
					<?php echo ("Bienvenu ".$_SESSION["prenom"]." ".$_SESSION["nom"]);?>
				
					<li id="deconnection"> <a href="deconnection.php"><h4>Se deconnecter</h4></a> </li>
				</div>
					<ul class="menu">
							<li> <a href="afficherbudget.php" target="vitrine" title="Afficher la Valer de mon budget"> <b>Afficher budget </a></li>
							<li> <a href="definirbudget.php" target="vitrine" title="Définir la valeur de mon budget"> <b>Définir budget </a></li>
							<li> <a href="ajoutertransaction.php" target="vitrine" title="Ajouter transaction"> <b>Ajouter une transaction </a></li>
							<li> <a href="listetransaction.php" target="vitrine" title="Liste de mes transactions"> <b>Mes transactions </a></li>
					</ul>
					<div class="contenu">
						<iframe   class= "vitrine" name="vitrine" src="afficherbudget.php" >
							<?php 
								include('afficherbudget.php');
							?>	
						</iframe>
					</div>
			<?php } else{?>
		</div>
							<div class="connexion">
								<form  method="post" action="index.php">
									Numéro téléphone<br/> 
									<input type="number" name="login" placeholder= " numero téléphone"><br/>  
									 Mot de passe <br/> 
									<input type="password" name="pwd" placeholder= " Mot de passe"> <br/> 
									<input type="submit" value="Connexion" name="submit">
								</form>
								Pas encore de compte?
								<a href="inscription.php"> <b>Inscrivez-vous</b></a>
								<a href="restaurer.php"><h4>Restaurer mot de passe</h4></a>
								<br /><br /><br />
							</div>
		<?php }
	
		?>

		
		<?php
			include('pied.php');
		?>
	</body>
</html>