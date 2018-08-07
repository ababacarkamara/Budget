<?php 
	session_start();// Démarrer la session
?>

<html>
	<head>
		<meta charset="utf-8" />
		<link href="style.css" type="text/css" rel="stylesheet"/>
	</head
	<body>
    <form class="ajouter" method="post" action="">	
			Définir mon budget<br>
			<input type="number" name="budget" > FCFA <br><br>
			<input type="submit" value="Definir budget" name="submit"><br><br>
	</form>
<?php
        if(isset($_POST["submit"]))
        {
            $budget = $_POST["budget"];
            $id=$_SESSION["id"];
            if($budget)
            {
                $connect=mysqli_connect('localhost','root','vieux5223','gestion_budget')or die('Erreure connexion ');                
                {
                    $requete="UPDATE budget SET valeur_initiale='$budget'  where idUser=$id;";
                    $req=mysqli_query($connect,$requete);
                        if($req)
                             {
                                 ?>
                                 <div class="valeur">
                                    <?php
                                        echo "budget redéfini à : ".$budget."  FCFA";
                                        $requett="UPDATE budget SET valeur_actuelle='$budget' WHERE idUser=$id";
                                        $req=mysqli_query($connect, $requett);
                                    ?>
                                </div>
                                <?php                                
                            }
                        else
                            echo "msg=Impossible d'executer la requete!"; 
                }
                
            }
        }         
?>
		
	</body>
</html>