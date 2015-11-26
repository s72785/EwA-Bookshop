<?php
	ob_start();	//start caching of output
	
	echo( '<!doctype html><html><head><title>Bookshop - Login</title><meta charset="UTF-8"></head><body>' );
	
	session_start();
?>

<?php

	/* access data in config file (data not inside repo) */
	include_once( '' /**/ . '../shop/' /**/ . 'dbconf.php' );
	include_once( '' /**/ . '../login/' /**/ . 'functions.php' );

	// handle should be put in a static object that can discontinue itself with a nother method AKA deconstructor after db_close
	$verbindung = mysql_connect( $dbhost, $dbuser, $dbpass )
	or die( "Verbindung zur Datenbank konnte nicht hergestellt werden" );
	mysql_select_db( $dbname ) or die ( "Datenbank konnte nicht ausgewählt werden" );

	$username = $_POST['username'];

	//never use LIKE for comparison of login credential, it can be alike, no difference with upper/lower cases
	$abfrage = "SELECT Username, Userpwmd5 FROM User WHERE LOWER( Username ) = LOWER( '" . $username . "' ) LIMIT 1;";
	$ergebnis = mysql_query( $abfrage );
	$row = mysql_fetch_object( $ergebnis );

	include_once( 'salt.php' );

	if(
		//new: 
		hashcmp( $_POST['password'], $row->Userpwmd5, $hashsalt )
		//after all are migrated: password_verify( $_POST['password'] . $hashsalt, $row->Userpwmd5 )
		//old: $row->Userpwmd5 == pwd_hash_old( $_POST['password'] )
	) {
		$_SESSION["username"] = $username;
		echo( 'Login erfolgreich.<br><a href="bestellformular.php">Geschützter Bereich</a>' );
	} else {
		echo( 'Benutzername und/oder Passwort waren falsch. <a href="login.html">Login</a>' );
	}

	mysql_close( $verbindung ); //close connections

	echo( '</body></html>' );

	ob_end_flush();
?>
