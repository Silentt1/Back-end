<?php

session_start();

include_once "sql.php";
require "kint.phar";

Kint::dump($_SESSION);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST["datedebut"]) == false AND empty($_POST["datefin"]) == false){
        if($_POST['nom'] and $_POST['prenom'] and $_POST['telephone'] and $_POST['adresse'] and $_POST['email']){
            // encapsulation
            $datedebut = test_input($_POST['datedebut']);
            $datefin = $_POST['datefin'];
            $_SESSION['dates'] = [$datedebut,$datefin];
            Kint::dump($datedebut);
            Kint::dump($_SESSION);

            //encapsulation des données clients en redirection vers la page de confirmation
            $nom = test_input($_POST["nom"]);
            $prenom = test_input($_POST["prenom"]);
            $email = test_input($_POST["email"]);
            $adresse = test_input($_POST["adresse"]);
            $telephone = test_input($_POST["telephone"]);
            $issou = [null,$nom,$prenom,$adresse,$telephone,$email,null];
            $_SESSION['client'] = $issou;
            //header('Location: confirmation.php');
    }}}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Reservation</title>
</head>


<body>
<?= include_once "form-client.php"; ?>

</body>
</html>