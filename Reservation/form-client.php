<?php


?>
<script src='JQ/jquery.js' type='text/javascript'></script>
  
  <link href='JQ/jquery-ui.min.css' rel='stylesheet' type='text/css'>
  <script src='JQ/jquery-ui.min.js' type='text/javascript'></script>
  
  <script src='JQ/datepicker-fr.js' type='text/javascript'></script>
  <script src='JQ/selector.js' type='text/javascript'></script>

<form name="form" action="./reservation.php" method="post">

Choissisez la date de début: <input  name='datedebut' type='text' class='datepicker' autocomplete="off" ><br/>
Choissisez la date de fin:   <input  name='datefin' type='text' class='datepicker' autocomplete="off" ><br/>  
<br>
Nom :      <input  name='nom'      type='text' autocomplete="off" ><br/>
Prenom :   <input  name='prenom'   type='text' autocomplete="off" ><br/>
Email :    <input  name='email'    type='text' autocomplete="off" ><br/>
Telephone :<input  name='telephone'type='text' autocomplete="off" ><br/>
Adresse :  <input  name='adresse'type='text' autocomplete="off" ><br/>


<input type="submit" value="Valider" />
</form>
<script type='text/javascript' >
  $( function() {


    $('.datepicker').datepicker({format: "dd-mm-yyyy"} );

  });
  </script>
