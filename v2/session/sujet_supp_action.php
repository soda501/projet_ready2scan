<?php
echo $_POST['sujetchoix'];
if($_POST['sujetchoix']){
	$sujet_choisi=htmlspecialchars(addslashes($_POST['sujetchoix']));
}
$mysqli = new mysqli(...);
$sql="SELECT * FROM t_sujet_sjt LEFT JOIN t_fiche_fch USING(sjt_id) WHERE sjt_id='".$sujet_choisi."';";
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
      $sql3="DELETE FROM t_hyperlien_fiche WHERE fch_id IN(SELECT fch_id FROM t_fiche_fch JOIN t_sujet_sjt USING(sjt_id) WHERE sjt_id='".$sujet_choisi."');";
      $sql4="DELETE FROM t_fiche_fch WHERE sjt_id IN(SELECT sjt_id FROM t_sujet_sjt WHERE sjt_id='".$sujet_choisi."');";
      $sql2="DELETE FROM t_sujet_sjt WHERE sjt_id='".$sujet_choisi."';";
  	
  	if (!$resultat2=$mysqli->query($sql3)) //Erreur lors de l’exécution de la requête
    { 
      echo "Error: La requête a echoué \n";
      echo "Query: ".$sql3."\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error. "\n";
      exit();
    }
      if (!$resultat3=$mysqli->query($sql4)) //Erreur lors de l’exécution de la requête
    { 
      echo "Error: La requête a echoué \n";
      echo "Query: ".$sql4."\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error. "\n";
      exit();
    } 
      if (!$resultat4=$mysqli->query($sql2)) //Erreur lors de l’exécution de la requête
    { 
      echo "Error: La requête a echoué \n";
      echo "Query: ".$sql2."\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error. "\n";
      exit();
    }
  	  header("Location:admin_sujets.php");
    }
  
  
      
  
  
$mysqli->close();


?>