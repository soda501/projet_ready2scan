<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    </head>
<body>
<?php
session_start(); 
session_destroy(); 
unset($_session[login]);
header("Location:session.php"); 
?>
</body>
</html>
