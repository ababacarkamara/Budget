 <?php 
	session_start();// Démarrer la session
?>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="style.css" type="text/css" rel="stylesheet"/>
	</head
	<body>
<?php
		if($connect=mysqli_connect("localhost","root","vieux5223","gestion_budget"))
		{
			$id=$_SESSION["id"];
			$requete = "select * from budget where idBudget=$id;";
				if($resultat=mysqli_query($connect, $requete))
				{
					if(mysqli_num_rows($resultat)==0)
						header("Location:index.php?erreure!!!");
					else
					{
						$ligne = mysqli_fetch_array($resultat);	
						$_SESSION["valeur actuelle"]=$ligne["valeur_actuelle"];
						echo ("La valeur actuelle de votre budget est de :");
						?>
						<div class="valeur">
						   <?php
								echo $ligne["valeur_actuelle"]."  FCFA";
							?>
						</div>
						<?php 
					}

				}
				else
					header("Location:index.php?msg=Impossible d'executer la requete!");
			
		}else
			header("Location:index.php?msg=Impossible de connecter au serveur de bd!");
?>
		
	</body>
</html>