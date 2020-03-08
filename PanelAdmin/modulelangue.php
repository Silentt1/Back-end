<?php

include_once "sql.php";

if(!isset($_GET['langue'])){
    $_GET['langue'] = 'fr';
    $langueformatsql = 'txt_'.'fr';
}

if(isset($_GET['langue'])) {
    $langueformatsql = 'txt_' . $_GET['langue'];
}

$textes = $conn->query("Select texte from $langueformatsql;");
$restexte = mysqli_fetch_all($textes);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css.css">
    <title>Test langues</title>
</head>
<body><div class='dropdown'>
    <button class='dropbtn' >Langue</button>
    <div class='dropdown-content'>
        <a href='modulelangue.php?langue=fr'>FR</a>
        <a href='modulelangue.php?langue=en'>EN</a>
        <a href='modulelangue.php?langue=es'>ES</a>
        <a href='modulelangue.php?langue=nl'>NL</a>
    </div>
</div>
<br><br><br>
<h1>Premier texte</h1><br><br>
<p><?= $restexte[0][0]?></p><br><br>
<h1>Deuxième texte</h1><br><br>
<p><?= $restexte[1][0]?></p><br><br>
<h1>Troisième texte</h1><br><br>
<p><?= $restexte[2][0]?></p><br><br>

</body>
</html>
