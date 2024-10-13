<!DOCTYPE html>
<html lang="fr">
<head>
    <style >
        body {
    font-family: Arial, sans-serif;
    background-color: #333;
    margin: 0;
    padding: 0;

}

.container {
    width: 50%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
}

button:hover {
    background-color: #0056b3;
}

nav {
    background-color: #333; /* Couleur de fond de la barre de navigation */
}

ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex; /* Utilisation de flexbox pour placer les éléments sur une seule ligne */
    background-color: #333; /* Fond gris de la barre de navigation */
}

li {
    display: inline;
}

li a {
    display: block;
    padding: 10px 20px; /* Espacement autour du texte de lien */
    color: #fff; /* Couleur du texte */
    text-decoration: none;
}
   </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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
echo ("Connexion BDD réussie !");
?>
 <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="../recapitulatif/recapitulatif.php">recapitulatif</a></li>
                        <li class="nav-item"><a class="nav-link" href="inscription.php">inscription</a></li>
                        
                        <li class="nav-item"><a class="nav-link" href="../session/session.php">connexion</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    <div class="container">
        
        <form id="monFormulaire" action="action.php" method="POST">
            <h2>Inscription</h2>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" >
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" >
            </div>
            <div class="form-group">
                <label for="pseudo">Pseudo :</label>
                <input type="text" id="pseudo" name="pseudo">
            </div>
            <div class="form-group">
                <label for="mdp1">Mot de passe :</label>
                <input type="password" id="mdp1" name="mdp1">
            </div>
            <div class="form-group">
                <label for="mdp2">Confirmer le mot de passe :</label>
                <input type="password" id="mdp2" name="mdp2">
            </div>
            <button type="submit">S'inscrire</button>
        </form>
        <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("monFormulaire").reset();
    });
</script>
    </div>
    <?php
$mysqli->close();
?>
</body>
</html>






