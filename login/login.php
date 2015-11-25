<?php
	session_start();
?>

<?php

	/* access data in config file (data not inside repo) */
	include_once( '' /**/ . '../shop/' /**/ . 'dbconf.php' );
	
	$verbindung = mysql_connect($dbhost, $dbuser, $dbpass)
	or die("Verbindung zur Datenbank konnte nicht hergestellt werden");

	mysql_select_db($dbname) or die ("Datenbank konnte nicht ausgewählt werden");

	$username = $_POST["username"];
	$password = md5($_POST["password"]);

	$abfrage = "SELECT Username, Userpwmd5 FROM User WHERE Username LIKE '$username' LIMIT 1";
	$ergebnis = mysql_query($abfrage);
	$row = mysql_fetch_object($ergebnis);

	if($row->Userpwmd5 == $password)	
	{
		$_SESSION["username"] = $username;
		echo "Login erfolgreich. <br> <a href=\"bestellformular.php\">Geschützter Bereich</a>";
	}
	else
	{
		echo "Benutzername und/oder Passwort waren falsch. <a href=\"login.html\">Login</a>";
	}

?> 
