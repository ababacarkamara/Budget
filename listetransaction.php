 <?php 
	session_start();// Démarrer la session
	$id=$_SESSION["id"];
				if($connect=mysqli_connect("localhost","root","vieux5223","gestion_budget"))
				{					
						$ch="<table>";
						$ch2="<table>";
						$ch.="<tr>
									<td>Description</td>
									<td>Montant(FCFA)</td>
									<td>Type</td>
									<td>Date</td>
								</tr>";
						
						$requete="Select * from transactions where idBudget=$id;";
						if (($resultat=mysqli_query($connect, $requete)))
						{
							while($ligne = mysqli_fetch_array($resultat)) 
							{
								$description = $ligne["description"];
								$montant = $ligne["montant"];
								$type = $ligne["type"];
								$date = $ligne["date"];
							
								
								$ch.="<tr>
									<td>$description</td>
									<td>$montant</td>
									<td>$type</td>
									<td>$date</td>
								</tr>";
							}
							$ch.= "</table>";
						}else
							echo "Impossible d'executer la requete!";
				}else
				echo "Impossible de choisir au serveur";	

?>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="style.css" type="text/css" rel="stylesheet"/>
	</head>
	<body>
	<br><br>
		<h2>Liste des transactions </h2>
				<?php echo $ch;?>
	</body>
</html>