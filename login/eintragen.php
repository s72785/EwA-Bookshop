<!doctype html><html><head><title>Bookshop - Login</title><meta charset="UTF-8">
<?php
	/* access data in config file (data not inside repo) */
	include_once( '' /**/ . '../shop/' /**/ . 'dbconf.php' );
	include_once( '' /**/ . '../login/' /**/ . 'functions.php' );

	$verbindung = mysql_connect($dbhost, $dbuser, $dbpass)
	or die("Verbindung zur Datenbank konnte nicht hergestellt werden");

	mysql_select_db($dbname) or die ("Datenbank konnte nicht ausgewählt werden");

	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$name = $_POST['name'];
	$address = $_POST['address'];

	if($password != $password2 OR $username == "" OR $password == "" OR $name == "" OR $address == "") {
		echo)( 'Eingabefehler. Bitte alle Felder korekt ausfüllen. <a href="eintragen.html">Zurück</a>' );
		exit;
	}
	$password = pwd_hash_old( $password );

	$result = mysql_query("SELECT UserID FROM User WHERE Username = '".$username."';");
	$menge = mysql_num_rows($result);

	if( $menge == 0 ) {
		$eintrag = "INSERT INTO User (Username, Userpwmd5, UserAnrede, UserAdresse) VALUES ('".$username."', '".$password."', '".$name."', '".$address."');";
		$eintragen = mysql_query( $eintrag );

		if($eintragen == true) {
			echo( 'Benutzername <b>'.$username.'</b> wurde erstellt. <a href="login.html">Login</a>' );
		} else {
			echo( 'Fehler beim Speichern des Benutzernames. <a href="eintragen.html">Zurück</a>' );
		}
	} else {
		echo( 'Benutzername schon vorhanden. <a href="eintragen.html">Zurück</a>' );
	}

	mysql_close( $verbindung );
?>
