<?php

include_once "sql.php";

$textes = $conn->query('Select texte from textes');
$restexte = mysqli_fetch_all($textes);

?>
<form method='post' action='./index.php'>
    <ul>
        <li>
            <label>Your Message <span class='required'>*</span></label>
            <textarea name='message' ><?=$restexte[0][0] ?></textarea>
        </li>

            <input type='submit' value='Submit' />

    </ul>
</form>