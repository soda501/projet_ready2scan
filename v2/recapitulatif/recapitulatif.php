<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
                body {
    background-color: #f2f2f2; /* couleur grise */
}
.navbar-dark {
                background-color: black !important; /* Couleur de fond noire */
            }

            .navbar-dark .navbar-nav .nav-link {
                color: white !important; /* Couleur du texte en blanc */
            }
            .img {
    width: 100px; /* Largeur souhaitée */
    height: auto; /* Hauteur automatique pour conserver les proportions */
}
        </style>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Agency - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https:..//use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https:..//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https:..//fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
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
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
               <a class="navbar-brand" href="#page-top"><img src="../assets/img/navbar-logo.svg" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="recapitulatif.php">recapitulatif</a></li>
                        <li class="nav-item"><a class="nav-link" href="../inscription/inscription.php">INSCRIPTION</a></li>
                        <li class="nav-item"><a class="nav-link" href="../session/session.php">connexion</a></li>
                        
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="blog">
            <div class="container">
                <div class="section-header text-center">
                    <br>
                    <h2>~~~Renaissance~~~</h2>
                    <br>
                </div>


                <?php

                                // Préparation de la requête 
                                $requete10 = "SELECT * FROM t_sujet_sjt";

                                // Appel de la fonction membre query() via l'objet $mysqli et exécution de la requête
                                $result10 = $mysqli->query($requete10);

                                if ($result10 == false) { // Erreur lors de l’exécution de la requête
                                    // La requête a échoué
                                    echo "Erreur : La requête a échoué \n";
                                    echo "Errno : " . $mysqli->errno . "\n";
                                    echo "Erreur : " . $mysqli->error . "\n";
                                    exit();
                                } else {
                                    // Boucle d'affichage ligne par ligne
                                    while ($res = $result10->fetch_assoc()) {
                                        echo ("<div class='section-header text' style='font-weight: bold;'><h3>" . $res['sjt_intitule'] . " </h3>
                                                    </div> ");

                                        // Préparation de la requête 
                                        $requete11 = "SELECT fch_fichier_img, fch_label,fch_code
                                         FROM t_fiche_fch WHERE fch_etat= 'L' 
                                         AND sjt_id = " . $res['sjt_id'];

                                        $result11 = $mysqli->query($requete11);

                                        if ($result11 == false) { // Erreur lors de l’exécution de la requête
                                            // La requête a échoué
                                            echo "Erreur : La requête a échoué \n";
                                            echo "Errno : " . $mysqli->errno . "\n";
                                            echo "Erreur : " . $mysqli->error . "\n";
                                            exit();
                                        } else {

                                            if ($result11 -> num_rows==0){
                                                echo "<br />";  
                                                echo ("<div class='col-lg-12'><p>Aucune fiche pour le moment </p></div>");                                            }
                                            else {

                                                echo "<br />";    
                                            // Boucle d'affichage ligne par ligne
                                            echo ("<div class='row row-cols-1 row-cols-md-3'>");
                                            while ($resu = $result11->fetch_assoc()) {
                                                echo ("
    <div class='col mb-4'>
        <a href='fiche.php?code=" . $resu['fch_code'] . "' style='text-decoration: none; color: inherit;'>
            <div class='card h-100'>
                <img src=" . $resu['fch_fichier_img'] . " class='card-img-top' alt='Card image'>
                <div class='card-body'>
                    <h4 class='card-title'>" . $resu['fch_label'] . "</h4>
                    <p class='card-text'></p>
                </div>
            </div>
        </a>
    </div>
");
                                            }
                                            echo ("</div>");
                                            

                                            }
                                        }
                                    }
                                }

                                // Ferme la connexion avec la base MariaDB
                                $mysqli->close();
                    ?>
                  
                  
                </div>
                
            </div>
        </div>
        <!-- Blog End -->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

 
    
    </body>
</html>






