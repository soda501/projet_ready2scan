
<?php
session_start();
if($_POST['intituleajout']){
  $inti_choisi=htmlspecialchars(addslashes($_POST['intituleajout']));
  $pseudo = $_SESSION['login'];
}

$mysqli = new mysqli(...);
$sql="SELECT * FROM t_sujet_sjt;";
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
      $sql4="INSERT INTO t_sujet_sjt
      VALUES (NULL,'".$inti_choisi."',curdate(),'".$pseudo."');";
       
        if (!$resultat3=$mysqli->query($sql4)) //Erreur lors de l’exécution de la requête
        { 
         echo "Error: La requête a echoué \n";
         echo "Query: ".$sql4."\n";
         echo "Errno: " . $mysqli->errno . "\n";
         echo "Error: " . $mysqli->error. "\n";
        exit();
       }
      else{
      header("Location:admin_sujets.php");
    }
}
  

$mysqli->close();

?>