<?php

session_start();

include_once "sql.php";


if(!isset($_SESSION['connected'])){
    $_SESSION['connected'] = "";
}

if(!isset($_GET['langue'])){
    $_GET['langue'] = 'default';
}

//recup des credentials admin depuis la bdd
$adminq = $conn->query('Select * from admin');
$resadmin = mysqli_fetch_all($adminq);

//recuperation des données clients
$res = $conn->query('Select * from clients');
$clientcount = mysqli_num_rows($res);
$row = mysqli_fetch_all($res);


// passe la langue en fr par default 
$langueformatsql = 'txt_'.$_GET['langue'];
if($_GET['langue'] == 'default'){
    $langueformatsql = 'txt_'.'fr';
}

// recuperation des textes 
$textes = $conn->query("Select texte from $langueformatsql;");
$txtcount = mysqli_num_rows($textes);
$restexte = mysqli_fetch_all($textes);

// verificiation des credentiaux pour le login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_SESSION['connected'] != true){
    if (empty($_POST["login"]) == false and empty($_POST["mdp"]) == false) {
        $login = test_input($_POST["login"]);
        $mdp = test_input($_POST["mdp"]);
        $mdp = hash('sha256',$mdp);
        $login = ucwords($login);
        if ($login == $resadmin[0][0] and $mdp == $resadmin[0][1]) {
            $_SESSION['connected'] = true;
        }}}}


function textes($restexte,$txtcount,$langue){

    echo "<div class='dropdown'>
  <button class='dropbtn' >Langue</button>
  <div class='dropdown-content'>
    <a href='index.php?langue=fr'>FR</a>
    <a href='index.php?langue=en'>EN</a>
    <a href='index.php?langue=es'>ES</a>
    <a href='index.php?langue=nl'>NL</a>
  </div>
</div>";

    for($i = 0; $i < $txtcount; $i ++ ){
        echo "<form method='post' action='./index.php?langue=".$langue."'>
    <ul>
        <li>
            <label>Your Message <span class='required'>*</span></label>
            <textarea name='texte".$i."' >".$restexte[$i][0]."</textarea>
        </li>
            <input type='submit' value='Modifier' />
    </ul>
</form>";}}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 0; $i < $txtcount; $i++) {
        $issou = "texte" . $i;
        if(isset($_POST[$issou])){
            $textasend = test_input($_POST[$issou]);}
        if (!empty($_POST[$issou])) {
            $t = $i + 1;
            $conn->query("delete from $langueformatsql where id_texte = $t;");
            $conn->query("INSERT INTO $langueformatsql (id_texte, texte) VALUES ( '$t', '$textasend');");
            header("Refresh:0");
        }
    }
}

	?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css.css">
    <title>Panel Admin</title>
</head>
<body>
<br><br>
<?php if($_SESSION['connected'] == false){
    echo "
<form method='post' action='./index.php'>
    <ul>
        <li>
            <label>Login</label><br>
            <input name='login' placeholder='Login' >
        </li>
        <li>
            <label>Mot de Passe</label><br>
            <input name='mdp' placeholder='Mot de Passe'>
        </li>

        <input type='submit' value='Entrer' />

    </ul>
</form>";}
    ?>


<?php if($_SESSION['connected'] == true){
    echo "<form action='index.php?langue=fr' method='post'>
    <input type='submit' name='someAction' value='Modifier les textes' />
</form>";}

if($_SESSION['connected'] == true  and (isset($_POST['someAction']) or $_GET['langue'] != 'default'))
{
    $langue = $_GET['langue'];
    textes($restexte,$txtcount,$langue);
}

    ?>
<ul>
<?php

$client2 = $conn->query('Select * from clients');


if($_SESSION['connected'] == true){
    echo "<form name='clientselect' action='index.php' method='POST'><select name='idclient'>";
    for ($i = 0; $i < $clientcount; $i++) {
        $row2 = mysqli_fetch_assoc($client2);
        if($row2['confirmer']==1){$confirmation = "confirmé";}
        if($row2['confirmer']==null){$confirmation = "non confirmé";}
        echo "<option value='".$row2['id_client']."'>".$row2['Nom']." : ".$row2['Prenom']."  :  ".$row2['id_client']."  :  ".$confirmation."</option>";

    }
    echo "</select><select name='action'>";
    echo "<option value='supprimer'>Supprimer</option>";
    echo "<option value='confirmer'>Confirmer</option></select>";
    echo "<input type='submit' name='clientselect' value='Sélectionner' /></form>";
}

if(isset($_POST['clientselect'])) {
    $idclient = $_POST['idclient'];
    $clientcible = $_POST['idclient'];
    $action = $_POST['action'];
    gerer_client($clientcible,$action,$conn);
    header("Refresh:0");
}

function gerer_client($clientcible,$action,$conn){
    if($action == 'supprimer'){
        $conn->query("update chambres set id_client = NULL where id_client=$clientcible;");
        $conn->query("delete from clients where id_client = $clientcible;"); 
    }
    if($action == 'confirmer'){
        $conn->query("update clients set confirmer = 1 where id_client = $clientcible;");
    }
}

?>
</ul>
</body>
</html>


<?php

mysqli_close($conn);

?>