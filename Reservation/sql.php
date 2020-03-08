<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function verif_mail($email){
	if(empty($email)== false){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) { 
			return $email;}
		else { 
			return null;}
}} 

function dateDiffInDays($date1, $date2)  
{ 
    $diff = strtotime($date2) - strtotime($date1); 
    return abs(round($diff / 86400)); 
} 




$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);


if(! $conn ) {
    echo 'Connected failure<br>';
}


if (!$conn->set_charset("utf8")) {
    printf("Erreur lors du chargement du jeu de caractères utf8 : %s\n", $conn->error);
    exit();
}

mysqli_select_db($conn,'mydb');

