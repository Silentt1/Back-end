<?php
//session_start();

include_once "sql.php";
require "kint.phar";

Kint::dump($_SESSION);

// calcul du nombre de nuits passées
$debut = str_replace('/','-', $_SESSION['dates'][0]);
$fin = str_replace('/','-', $_SESSION['dates'][1]);
$nb_days = dateDiffInDays($debut, $fin); 

//ajout de l'id de la chambre au a liste 'client'
$client =$_SESSION['client'];
$id_chambre = $_SESSION['chambre'][0][0];

$prixchambre = $_SESSION['chambre'][0][2];
$prixtotal = $prixchambre * $nb_days;
$acompte = $prixtotal * 0.40;

var_dump($nb_days);
var_dump($prixtotal,$acompte);

$idclient = $conn->query("select max(id_client) from clients;");
$id_nv_client = mysqli_fetch_all($idclient);


$id_client = $id_nv_client[0][0]+1;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
</head>
<body>

<?php
if (isset($_POST['confirm'])) {
    if ($_POST['confirm'] == 'Yes') {
		$conn->query("INSERT INTO clients (id_client, Nom, Prenom, Adresse, Numéro, confirmer) VALUES ( null,'$client[1]','$client[2]','$client[3]','$client[4]',null);");
    $conn->query("UPDATE chambres SET id_client = $id_client WHERE chambres.id_chambre = $id_chambre;");
    $conn->query("UPDATE chambres SET disponible = 0 WHERE chambres.id_chambre = $id_chambre;");
    }
    else if ($_POST['confirm'] == 'No') {
        session_destroy();
    } 
}
?>

<form method="post" action="./confirmation.php">

<input type="submit" name="confirm" value="Yes"><br/>
<input type="submit" name="confirm" value="No"><br/>

</form>
