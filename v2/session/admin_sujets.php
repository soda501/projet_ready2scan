<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!--entête du fichier HTML-->
<style>
        body {
            background-color: #CCCCCC;
        }
        
        h1 {
            text-align: center;
        }
        .navbar {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- Vous pouvez ajouter d'autres liens de navigation ici si nécessaire -->
                    <li class="nav-item">
                        <a class="nav-link" href="admin_accueil.php">Accueil&profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">gestion des actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_sujets.php">gestions des sujets et fiches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">gestions des hyperliens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deconnexion.php">Se déconnecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-4">
<!--contenu du fichier HTML-->
<h1>sujet</h1>
<?php
$mysqli = new mysqli(...);
if ($mysqli->connect_errno)
{
 // Affichage d'un message d'erreur
 echo "Error: Problème de connexion à la BDD \n";
 echo "Errno: " . $mysqli->connect_errno . "\n";
 echo "Error: " . $mysqli->connect_error . "\n";
 // Arrêt du chargement de la page
 exit();
}
// Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
if (!$mysqli->set_charset("utf8")) {
 printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
 exit();
}
//echo ("Connexion BDD réussie !");
?>

<?php
//Préparation de la requête récupérant tous les profils
$requete="SELECT * FROM t_sujet_sjt LEFT JOIN t_fiche_fch USING(sjt_id) GROUP BY sjt_id;";
//Affichage de la requête préparée
//echo ($requete);
$result1 = $mysqli->query($requete);
if ($result1 == false) //Erreur lors de l’exécution de la requête
{ // La requête a echoué
 echo "Error: La requête a echoué \n";
 echo "Errno: " . $mysqli->errno . "\n";
 echo "Error: " . $mysqli->error . "\n";
 exit();
}
else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
{

 echo"<fieldset>";
          echo"<form action='sujet_ajout_action.php' method='post'>
            <input type='text' name='intituleajout' placeholder='intitule'><br>
          <button type='submit'>Ajout</button>";
          echo "</form>";
        echo"</fieldset>";
//echo($result1->num_rows); //Donne le bon nombre de lignes récupérées
 echo "<br />";
 echo"<table><tr><th>ID</th><th>SUJET</th><th>CPT8PSEUDO</th><th>FICHE</th><th>action</th></tr>";
 while ($actu = $result1->fetch_assoc())
 {
echo ('<tr><td>'.$actu['sjt_id'] .'</td><td>'.$actu['sjt_intitule'] .'</td><td>'. $actu['cpt_pseudo'] .'</td>');
echo('<td>');
echo "<br />";
$sql_fich="SELECT * FROM t_fiche_fch WHERE sjt_id=".$actu['sjt_id'].";";
$result_fich=$mysqli->query($sql_fich);
if($result_fich==false){
    echo "erreur";}
else{
    while($fiche=$result_fich->fetch_assoc()){
        echo("*");
        echo ($fiche['fch_label']);
        echo "<br />";
        

    }
}
echo('</td>');



echo("<td>");
echo"<fieldset>";
          echo"<form action='sujet_supp_action.php' method='post'>";
            echo"<input type='hidden' name='sujetchoix' placeholder='Sujet' value='".$actu['sjt_id'] ."'>";
          echo"<button type='submit'>Supprimer</button>";
          echo "</form>";
        echo"</fieldset>";

    echo("</td>");
           echo("</tr>");
echo "<br />";
 }
 echo('</table>');
echo "<br />";


}
$mysqli->close();

?>





</div>

    <!-- Intégration de Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>