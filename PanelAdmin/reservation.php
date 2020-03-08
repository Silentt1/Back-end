<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
</head>
<body>
<a href='reservation.php?chambre=1'>Chambre 1</a>
<a href='reservation.php?chambre=2'>Chambre 2</a>
<a href='reservation.php?chambre=3'>Chambre 3</a>
<a href='reservation.php?chambre=4'>Chambre 4</a>

<?php
if(isset($_GET['chambre'])){
    include_once "clientform.php";
}
?>

</body>
</html>
