<?php 
	session_start();// Démarrer la session
?>

<html>
	<?php 
		require_once('entete.php');
	?>
	<body>
		
		<h2>Formulaire d'inscription</h2>
		<br><br>
		<form class="ajouter" method="post" action="">
			Prénom<br>
			<input type="name" name="prenom" placeholder="Prénom"> <br>Nom<br>
			<input type="name" name="nom" placeholder="Nom"> <br>Telephone<br>
			<input type="number_format" name="phone" placeholder="Telephone "> <br>Adresse email<br>
			<input type="mail" name="mail" placeholder="Adresse email">  <br>Mot de passe<br>
			<input type="password" name="mdp" placeholder="Mot de passe">    <br>Confirmer mot de passe<br>
			<input type="password" name="confirmermdp" placeholder= "Confirmer mot de passe">  <br><br>
			<input type="submit" value="S'inscrire" name="submit"><br><br>
		</form>
		<?php 
		if(isset($_POST["submit"]))
			{
				
				$prenom = $_POST["prenom"];
				$nom = $_POST["nom"];
				$phone = $_POST["phone"];
				$mail=$_POST["mail"];
				$mdp=$_POST["mdp"];
				$confirmermdp=$_POST["confirmermdp"];
				if($prenom&&$nom&&$phone&&$mail&&$mdp&&$confirmermdp)
				{
					if($mdp==$confirmermdp)
					{
							$connect=mysqli_connect('localhost','root','vieux5223','gestion_budget')or die('Erreure connexion ');
							$mdpencrypt = md5($mdp);
							$inserer="INSERT INTO users (prenom,nom,mail,phone,password) 
									VALUES('$prenom','$nom','$mail',$phone,'$mdpencrypt')";
							$req=mysqli_query($connect, $inserer);
							if($req)
							{
								$requet = "select * from users where phone='$phone' and password='$mdpencrypt';";
								$resultat=mysqli_query($connect, $requet);
								$ligne = mysqli_fetch_array($resultat);
								$_SESSION["prenom"]=$prenom;
								$_SESSION["nom"]=$nom;
								$_SESSION["id"]=$ligne["idUser"];
								$id=$ligne["idUser"];
								$_SESSION["numero"]=$phone;
								$_SESSION["mail"]=$ligne["mail"];
								$_SESSION["adrIP"]=$_SERVER['HTTP_HOST'];
								$insere="INSERT INTO budget (idUSer) 
									VALUES($id)";
								$requete=mysqli_query($connect, $insere);
								if($requete)
								header("Location:index.php?");
							}
					}else
						echo"Mots de passe différents";
				}else
					echo"Veuillez remplir tous les champs";
			}
		?>
		<br><br><br><br><br><br><br><br>
	</body>
	<?php
		require_once('pied.php');
	?>
</html>	
