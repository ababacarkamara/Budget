<?php 
	session_start();// Démarrer la session
?>

<html>
	<body>	
		<h2>Ajouter une transaction</h2>
		<br><br>
		<form class="ajouter" method="post" action="">
			Description<br>
			<input type="text" name="description" placeholder="Description"> <br>Montant<br>
			<input type="number" name="montant" > <br>Date<br>
			<input type="date" name="date" > <br>Type<br>
			<select name="type" type="text">
				<option value="revenu"> Revenu </option>
				<option value="depense"> Dépense </option>
			</select>
			<input type="submit" value="Ajouter" name="submit"><br><br>
		</form>
		<?php 
		if(isset($_POST["submit"]))
			{
				
				$description = $_POST["description"];
				$montant = $_POST["montant"];
				$type = $_POST["type"];
				$date=$_POST["date"];
				
				if($description&&$montant&&$type&&$date)
				{
					
							$connect=mysqli_connect('localhost','root','vieux5223','gestion_budget')or die('Erreure connexion ');
							$id=$_SESSION["id"];
							$inserer="INSERT INTO transactions(description, montant, type, date, idBudget) 
								VALUES ('$description',$montant,'$type', '$date', $id);";
							$req=mysqli_query($connect, $inserer);
							if($req)
							{
								echo "transaction ajouter avec succes";
								$requete = "select * from budget where idUser=$id;";
								if($resultat=mysqli_query($connect, $requete))
								{
									if(mysqli_num_rows($resultat)==0)
										echo "erreur!!!";
									else
									{
										$ligne = mysqli_fetch_array($resultat);	
										$valeur_actuelle=$ligne["valeur_actuelle"];
									}
								} 
								else echo "erreur";

								if($type=='depense')
								{
									$nouvelle_valeur=$valeur_actuelle-$montant;
									$requete="UPDATE budget SET valeur_actuelle= '$nouvelle_valeur'  where idUser=$id;";
                    				$req=mysqli_query($connect, $requete);
								}
								else
								if($type=='revenu')
								{
									$nouvelle_valeur=$valeur_actuelle+$montant;
									$requete="UPDATE budget SET valeur_actuelle= '$nouvelle_valeur'  where idBudget=$id";
                    				$req=mysqli_query($connect, $requete);
								}


							}
							else 
								echo "erreure requette";
					
				}else
					echo"Veuillez remplir tous les champs";
			}
		?>
	
	</body>

</html>	