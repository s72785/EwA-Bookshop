<?php
	session_start();
?>

<?php
	if(!isset($_SESSION["username"]))
	{
		echo "Bitte erst <a href=\"login.html\">einloggen</a>";
		exit;
	}
	echo "Das ist der geschützte Bestellformular-Bereich!";
?> 
