<?php
if(isset($_SESSION)){
    session_start();}

if(!isset($displayed)){
    $displayed = false;}

include_once "sql.php";
require "kint.phar";

$res = $conn->query('Select * from chambres');
$nbchambres = mysqli_num_rows($res);
$chambres = mysqli_fetch_all($res);


if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['choixchr'])){
    for($ii = 0; $ii < $nbchambres+1 ; $ii++){
        if(!empty($_POST[$ii])){
            $chambrechoisie = $ii;
            $_SESSION['idchr']=$chambrechoisie;
            header('Location : reservation.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Reservation</title>
</head>
<body>
<?php  $numchr = 0;
//affichage des prix "$chambres[x][2]" et du nb de places "$chambres[x][1]" 
// id de la chambre $chambres[x][0]

if($displayed == false){
    for($i = 0; $i < $nbchambres ; $i++){
    
        if($chambres[$i][4] == null){
        $numchr++;
        echo "
            <form  action='' method='post'>
                Chambre:".$numchr."<br>
                Prix:".$chambres[$i][2]."<br>
                Nombre de places :".$chambres[$i][1]." <br>
                <input name='".$chambres[$i][0]."' type='submit' name='choixchr' value='Reserver'>
            </form>
        ";
        }
    }$displayed = true;
}
?>
</body>
</html>