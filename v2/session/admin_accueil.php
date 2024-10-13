<?php 
/* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
autorisé à un utilisateur connecté. */
session_start();
if(!isset($_SESSION['login'])) //A COMPLETER pour tester aussi le rôle...
{
    
 //Si la session n'est pas ouverte, redirection vers la page du formulaire
header("Location:session.php");
}

if( $_SESSION['role']!='M' && $_SESSION['role']!='G') //A COMPLETER pour tester aussi le rôle...
{
    
 //Si la session n'est pas ouverte, redirection vers la page du formulaire
header("Location:session.php");
}
?>
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
<h1>ESPACE ADMINISTRATION</h1>
<!--Suite du contenu du fichier HTML-->
<?php
/* Code PHP permettant de souhaiter la bienvenue à l’utilisateur connecté et
d’afficher le détail de son profil. */
$mysqli = new mysqli(...);
$requete="SELECT * FROM t_profil_pfl WHERE cpt_pseudo='".$_SESSION['login']."';";
$result1 = $mysqli->query($requete);
if ($result1 == false) //Erreur lors de l’exécution de la requête
{ // La requête a echoué
echo "Error: La requête a echoué \n";
echo "Errno: " . $mysqli->errno . "\n";
echo "Error: " . $mysqli->error . "\n";
exit();
}
else{
  $ligne = $result1->fetch_assoc();
  echo("<h2>votre profil:</h2>");
  echo "BONJOUR,";
echo $ligne['pfl_nom'];
echo"~~";
echo $ligne['pfl_prenom'];
echo"~~";
echo $ligne['cpt_pseudo'];
echo"~~";
echo $ligne['pfl_statut'];
    if($_SESSION['role']=='M'){
echo "'".$_SESSION['login']."', <br> vous etes membre";
echo "<br />";

}
else if($_SESSION['role']=='G'){
    echo "BONJOUR,'".$_SESSION['login']."', <br> vous etes un geestionnaire";
    echo "<br />";
    $requete2="SELECT * FROM t_profil_pfl JOIN t_compte_cpt USING(cpt_pseudo);";
$result2 = $mysqli->query($requete2);
if ($result2 == false) //Erreur lors de l’exécution de la requête
{ // La requête a echoué
echo "Error: La requête a echoué \n";
echo "Errno: " . $mysqli->errno . "\n";
echo "Error: " . $mysqli->error . "\n";
exit();
}
else{
    echo("<h2>comptes/profil:</h2>");
    echo "<br />";
    echo"<fieldset>";
          echo"Compte à modifier: ";
          echo"<form action='compte_action.php' method='post'>";
           echo" <p>Votre pseudo :";
            echo"<input type='text' name='pseudo' placeholder='Pseudo' >";
        echo"</p>";
         echo"<button type='submit'>Activer/Desactiver</button>";
       echo"</form>";
       echo"</fieldset>";
        echo("count profils:'".$result2->num_rows."'");
        echo"<table><tr><th>pseudo</th><th>nom</th><th>prenom</th><th>statut</th><th>Validite</th><th>Actions</th></tr>";
        while ($prof = $result2->fetch_assoc())
        {
           echo ('<tr><td>'.$prof['cpt_pseudo'] .'</td><td>'. $prof['pfl_nom'] .'</td>');
           echo ('<td>'.$prof['pfl_prenom'] .'</td><td>'. $prof['pfl_statut'] .'</td>');
           echo ('<td>'.$prof['pfl_validite'] .'</td>');
           echo("<td>");

            echo"<form action='compte_action.php' method='post'>";
            echo"<input type='hidden' name='pseudo' placeholder='Pseudo' value='".$prof['cpt_pseudo'] ."'>";
            echo"<button type='submit'>Activer/Desactiver</button>";
            echo"</form>";
            
        
            echo"<form action='compte_action1.php' method='post'>";
            echo"<input type='hidden' name='role' placeholder='Role' value='".$prof['cpt_pseudo'] ."'>";
            echo"<button type='submit'>Membre/Gestionnaire</button>";
            echo"</form>";
            
            echo("</td>");
           echo("</tr>");
           //echo "<br />";
        }
        echo('</table>');
    }
}

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