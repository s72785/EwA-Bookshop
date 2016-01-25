<?php
	ob_start();	//start caching of output
	
	if(!isset($caller)||$caller!='index.php'){
		echo( '<!doctype html><html><head><title>Bookshop - Login</title><meta charset="UTF-8"></head><body>' );
	}

	/* access data in config file (data not inside repo) */
	include_once( ((!isset($caller)||$caller!='index.php')?'.':'') .'./shop/dbconf.php' );
	include_once( ((!isset($caller)||$caller!='index.php')?'.':'') .'./login/functions.php' );

	$username = (isset($_POST['username']))?$_POST['username']:'';
	$password = (isset($_POST['password']))?$_POST['password']:'';
	$password2 = (isset($_POST['password2']))?$_POST['password2']:'';
	$name = (isset($_POST['name']))?$_POST['name']:'';
	$address = (isset($_POST['address']))?$_POST['address']:'';

	if(false) {//login erfolgreich
	} elseif($password != $password2 OR $username == "" OR $password == "" OR $name == "" OR $address == "") {
		//echo( 'Eingabefehler. Bitte alle Felder korekt ausfüllen. <a href="'.((!isset($caller)||$caller!='index.php')?'eintragen.html':'?show=eintragen').'">Zurück</a>' );
		//exit;
		echo('<div id="login">
<fieldset form="reg-form"><legend>Registrieren</legend>

<form name="reg-form" id="reg-form" action="'
		);
		if( !isset($caller) ) {
			echo('eintragen.php');
		} else {
			echo('?show=eintragen');
		}
		echo('" method="post">
	<label for="username">Dein Username</label>
	<input type="text" size="14" maxlength="50"
	name="username" id="username"><br>

	<label for="password">Dein Passwort</label>
	<input type="password" size="14" maxlength="50"
	name="password" id="password"><br>

	<label for="password2">Pwt. wiederholen</label>
	<input type="password" size="14" maxlength="50"
	name="password2" id="password2"><br>
	
	<label for="name">Name</label>
	<input type="text" size="14" maxlength="50"
	name="name" id="name"><br>
	
	<label for="address">Adresse</label>
	<input type="text" size="14" maxlength="50"
	name="address" id="address"><br>

	<input type="submit" value="Abschicken">
</form>
</fieldset>
<!--<small style="margin-left: 3em;"><a href="login.html">Login</a></small>-->
</div>'
		);
		if ( !isset($caller) || $caller!='index.php' ) {
			echo('<small style="margin-left: 3em;"><a href="login.php">Login</a></small>');
		} else {
			echo('<small style="margin-left: 3em;"><a href="?show=login">Login</a></small>');
		}
	} else {

		$password = pwd_hash_old( $password );
		unset($password2);

		$verbindung = mysql_connect($dbhost, $dbuser, $dbpass)
		or die("Verbindung zur Datenbank konnte nicht hergestellt werden");

		mysql_select_db($dbname) or die ("Datenbank konnte nicht ausgewählt werden");

		$result = mysql_query("SELECT UserID FROM User WHERE Username = '".$username."';");
		$menge = mysql_num_rows($result);

		if( $menge == 0 ) {
			$eintrag = "INSERT INTO User (Username, Userpwmd5, UserAnrede, UserAdresse) VALUES ('".$username."', '".$password."', '".$name."', '".$address."');";
			$eintragen = mysql_query( $eintrag );

			if($eintragen == true) {
				echo( 'Benutzername <b>'.$username.'</b> wurde erstellt. <a href="'.((!isset($caller)||$caller!='index.php')?'login.php':'?show=login').'">Login</a>' );
			} else {
				echo( 'Fehler beim Speichern des Benutzernames. <a href="eintragen.html">Zurück</a>' );
			}
		} else {
			echo( 'Benutzername schon vorhanden. <a href="eintragen.html">Zurück</a>' );
		}

		mysql_close( $verbindung );
	}

	//~ if(!isset($caller)||$caller!='index.php'){
		//~ echo( '</body></html>' );
	//~ }
	//~ ob_end_flush();
?>