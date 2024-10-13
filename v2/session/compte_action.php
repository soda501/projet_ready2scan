<?php
if($_POST['pseudo']){
	$pseudo_choisi=htmlspecialchars(addslashes($_POST['pseudo']));
}

$mysqli = new mysqli(...);
$sql="SELECT * FROM t_profil_pfl  WHERE cpt_pseudo='".$pseudo_choisi."';";

echo("<br>");

 if (!$resultat =$mysqli->query($sql)) //Erreur lors de l’exécution de la requête
    { 
      echo "Error: La requête a echoué \n";
      echo "Query: ".$sql."\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error. "\n";
      exit();
  }
  else{
  	$ligne=$resultat->fetch_assoc();
  	if($ligne['pfl_validite']=='A'){
  		$sql3="UPDATE t_profil_pfl SET pfl_validite='D' WHERE cpt_pseudo='".$pseudo_choisi."';";
  	}
  	else{
  		$sql3="UPDATE t_profil_pfl SET pfl_validite='A' WHERE cpt_pseudo='".$pseudo_choisi."';";

  	}
  	if (!$resultat2=$mysqli->query($sql3)) //Erreur lors de l’exécution de la requête
    { 
      echo "Error: La requête a echoué \n";
      echo "Query: ".$sql3."\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error. "\n";
      exit();
    }
    else{
  	  header("Location:admin_accueil.php");
    }
}
$mysqli->close();

?>