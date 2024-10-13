<?php

//Ouverture d'une session
session_start();
/*Affectation dans des variables du pseudo/mot de passe s'ils existent,
affichage d'un message sinon*/

//echo $_POST["pseudo"];
//echo $_POST["mdp"];
if ($_POST["pseudo"] && $_POST["mdp"]){
$id=htmlspecialchars(addslashes($_POST['pseudo']));
$motdepasse=htmlspecialchars($_POST['mdp']);
// A COMPLETER...
}

// Connexion à la base MariaDB
$mysqli = new mysqli(...);
if ($mysqli->connect_errno) {
// Affichage d'un message d'erreur
echo "Error: Problème de connexion à la BDD \n";
// Arrêt du chargement de la page
exit();
}

/* 1) Requête SQL n° 1) incomplète de recherche du compte utilisateur à partir
des pseudo / mot de passe saisis */
$sql="SELECT * FROM t_compte_cpt JOIN t_profil_pfl USING(cpt_pseudo) WHERE
cpt_pseudo='" . $id . "' AND cpt_mot_de_passe=MD5('" . $motdepasse . "') AND pfl_validite='A';";
//echo($sql);
/* 1bis) A NOTER : on préparera plutôt une requête SQL n° 1bis) complète avec
une jointure pour rechercher si un compte utilisateur valide (‘A’) existe dans
la table des données des profils et récupérer aussi son rôle à partir des
pseudo / mot de passe saisis */


/* Exécution de la requête pour vérifier si le compte (=pseudo+mdp) existe !*/
$resultat = $mysqli->query($sql);
if ($resultat==false) {
// La requête a echoué
echo "Error: Problème d'accès à la base \n";
exit();
}
else {
        
         $ligne=$resultat->fetch_assoc();
         if($resultat->num_rows == 1 && $ligne["pfl_validite"]=='A')
                 {echo"profil valide";}

        /* A NOTER : si on a complété la requête n° 1) proposée, on peut aussi
        récupérer et tester la validité du profil, en faisant, par exemple :
        $ligne=$resultat->fetch_assoc();
        if($resultat->num_rows == 1 && $ligne["pfl_validite"]=='A'){...}
        */
        /* Dans le cas de la requête n° 1) non complétée ou n° 1bis), on teste si
        une ligne de résultat a été renvoyée, c'est à dire si le compte
        existe bien (n° 1)) et est activé (n° 1bis)) :
        */
        if($resultat->num_rows == 1) {
        //Mise à jour des données de la session

        $_SESSION['login']=$id;

        /* A prévoir et finaliser : récupérer puis vérifier
        le rôle du profil dans la base MariaDB,
        puis affecter la valeur du rôle à $_SESSION['role']
        $_SESSION['role']=...;
        */

        $_SESSION['role']=$ligne["pfl_statut"];

        header("Location:admin_accueil.php");

        }

        else {
        // aucune ligne retournée
        // => le compte n'existe pas ou n'est pas valide
        echo "pseudo/mot de passe incorrect(s) ou profil inconnu profil desactiver !";
        echo "<br /><a href=\"./session.php\">Cliquez ici pour réafficher
        le formulaire</a>";
        }

//Fermeture de la communication avec la base MariaDB
$mysqli->close();


}
?>