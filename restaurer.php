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
			include('entete.php');
	?>
	<header>
		<br/><h3> Restaurer mon mot de passe </h3><br/>
	</header>
	<div class="restaurer">
			<form method="post" action="restaurer.php">
					Numéro téléphone<br/> <input type="number" name="numero" placeholder= " numero téléphone"> <br/><br/>
					Adresse mail <br/><input type="mail" name="mail" placeholder= " mail"> <br/> <br/>
					<input type="submit" value="Restaurer" name="submit">
			</form>
			<?php 
		if(isset($_POST["submit"]))
			{
				
				$numero = $_POST["numero"];
				$mail = $_POST["mail"];
				
				if($numero&&$mail)
				{
					
							$connect=mysqli_connect('localhost','root','vieux5223','gestion_budget')or die('Erreure connexion ');							
							$req="select * from users where phone='$numero' and mail='$mail';";
							if($resultat=mysqli_query($connect, $req))
							{
								if(mysqli_num_rows($resultat)==0)
									{
										echo " numéro ou mail incorrect";	
									}
								else
									{
										$requete = "select * from users where phone='$numero' and mail='$mail';";
										if($result=mysqli_query($connect, $requete))
										{
											if(mysqli_num_rows($result)==0)
												echo "erreur!!!";
											else
											{
												$ligne = mysqli_fetch_array($result);	
												$motdepass=$ligne["password"];
												$sujet="Restaurer mot de passe mon budget";
												$message="Votre mot de passe est: ".$motdepass;
												
											}
										} 
										else echo "erreur";
									}									
							}
								else 
									echo "erreure requette";
						
					}else
						echo"Veuillez remplir tous les champs";
				}
		?>
	</div>
	</body>
</html>