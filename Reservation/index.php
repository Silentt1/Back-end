<?php
session_start();

include_once "sql.php";

if(!isset($_SESSION['datedone'])){
    $_SESSION['datedone'] = "";
}

//selection de la chambre en fonction du nb de personnes et de la disponibilité
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST["datedebut"]) == false AND empty($_POST["quantity"]) == false AND empty($_POST["datefin"]) == false){
		$datedebut = $_POST['datedebut'];
		$datefin = $_POST['datefin'];
		$_SESSION['dates'] = [$datedebut,$datefin];
		$nb_personnes =  $_POST['quantity'];
		
		$chambres = $conn->query("Select id_chambre,nb_places,prix from chambres where disponible=1 and nb_places=$nb_personnes limit 1");
		$repchambres = mysqli_fetch_all($chambres);
		
		if($repchambres == null){
			$chambres2 = $conn->query("Select id_chambre,nb_places,prix from chambres where disponible=1 and nb_places>=$nb_personnes limit 1");
			$repchambres2 = mysqli_fetch_all($chambres2);
			if($repchambres != null) {$_SESSION['chambre']= $repchambres;}
			if($repchambres2 != null) {$_SESSION['chambre']= $repchambres2;}	
		}
		if($repchambres != null or $repchambres2 != null){
			$_SESSION['datedone'] = 'done';}
}}

// sécurise les données , vérifie le mail et encapsule les données client dans l'array $_SESSION['client']
if(empty($_POST['email'])== false){
	$email = verif_mail($_POST['email']);
	if($email != null){
		if($_POST['nom'] and $_POST['prenom'] and $_POST['telephone'] and $_POST['adresse']){
			$nom = test_input($_POST["nom"]);
			$prenom = test_input($_POST["prenom"]);
			$email = test_input($_POST["email"]);
			$adresse = test_input($_POST["adresse"]);
			$telephone = test_input($_POST["telephone"]);
			$issou = [null,$nom,$prenom,$adresse,$telephone,$email,null];
			$_SESSION['client'] = $issou;
			header('Location: confirmation.php');
			//on envoie vers une page confirmation avec un recap des infos , on passe une array dans l'ordre bdd dans la variable session
		}}
} 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Module Reservation</title>
</head>
<script src='JQ/jquery.js' type='text/javascript'></script>
  
<link href='JQ/jquery-ui.min.css' rel='stylesheet' type='text/css'>
<script src='JQ/jquery-ui.min.js' type='text/javascript'></script>

<script src='JQ/datepicker-fr.js' type='text/javascript'></script>
<script src='JQ/selector.js' type='text/javascript'></script>

<body>
<style>.qtyminusGrey{background: red}</style>

<?php if($_SESSION['datedone']=="done"){ include_once "form-client.php";} 

 if($_SESSION['datedone']==""){ include_once "dates-nb-personnes.php";} ?>

  <script type='text/javascript' >
  $( function() {


    $('.datepicker').datepicker({format: "dd-mm-yyyy"} );

  });
  </script>
 

</body>
</html>	