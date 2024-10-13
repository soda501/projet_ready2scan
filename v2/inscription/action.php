<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f0f0f0; /* Fond gris */
}

.container {
    background-color: #fff; /* Fond blanc pour le contenu */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page PHP centrée</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
Bonjour, 
<?php
$prenom=htmlspecialchars(addslashes($_POST['prenom']));
$nom=htmlspecialchars(addslashes($_POST['nom']));
$id=htmlspecialchars(addslashes($_POST["pseudo"]));
$mdp1=htmlspecialchars($_POST['mdp1']);
$mdp2=htmlspecialchars($_POST['mdp2']);

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
//Préparation de la requête à partir des chaînes saisies =>
//concaténation (avec le point) des différents éléments composant la 
//requête
if(!htmlspecialchars($_POST['prenom'])|| !htmlspecialchars($_POST['nom'])|| !htmlspecialchars($_POST['pseudo'])|| !htmlspecialchars($_POST['mdp1'])|| !htmlspecialchars($_POST['mdp2'])){
    echo('erreur!! veuiller bien remplir la formulaire');
    echo "<a href='index.php"."'>". "retoure accueil". "</a>";
    exit;
}
if(strcmp($mdp1,$mdp2)!=0){
    echo('mot de passe incorrect');
}

//requete d'ajout compte et profil

$sql_compte="INSERT INTO t_compte_cpt VALUES('" .$id. "',MD5('" .$mdp1. "'));";
$sql_profil="INSERT INTO t_profil_pfl VALUES('" .$nom. "','" .$prenom. "','M','D',CURDATE(),'" .$id. "');";
// Affichage de la requête constituée pour vérification
//echo($sql_compte);
//Exécution de la requête d'ajout d'un compte dans la table des comptes
$result3 = $mysqli->query($sql_compte); 
if ($result3 == false) //Erreur lors de l’exécution de la requête
{
 // La requête a echoué
 echo "Error: La requête a échoué \n";
 echo "Query: " . $sql_compte . "\n";
 echo "Errno: " . $mysqli->errno . "\n";
 echo "Error: " . $mysqli->error . "\n";
 echo "<a href='index.php"."'>". "retoure accueil". "</a>";
 exit;
}
else //Requête réussie
{
echo "<br />";
$result4=$mysqli->query($sql_profil);
if($result4==false){
    //requete echoue
 echo "Error: La requête a échoué \n";
 echo "Query: " . $sql_profil . "\n";
 echo "Errno: " . $mysqli->errno . "\n";
 echo "Error: " . $mysqli->error . "\n";
 $del="DELETE FROM t_compte_cpt WHERE cpt_pseudo='" .$id. "'";
 $res=$mysqli->query($del);
 exit;
}
echo "Inscription réussie !" . "\n";
echo"<br>";
echo "<a href='../index.php"."'>". "retoure accueil". "</a>";
}


?>
</div>
</body>
</html>