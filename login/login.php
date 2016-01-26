<?php
	ob_start();	//start caching of output
	if(!isset($caller)||!in_array($caller,$callers)){
		echo( '<!doctype html><html><head><title>Bookshop - Login</title><meta charset="UTF-8"></head><body>' );
	}

	/* access data in config file (data not inside repo) */
	include_once( ((!isset($caller)||!in_array($caller,$callers))?'.':'') .'./shop/dbconf.php' );
	include_once( ((!isset($caller)||!in_array($caller,$callers))?'.':'') .'./login/functions.php' );

	if ( isset($_SESSION['userid']) && !empty($_SESSION['userid']) ) {
		//~ echo( 'Login erfolgreich.<br><a href="'.((!isset($caller)||!in_array($caller,$callers))?'bestellformular.php':'?show=shop').'">Geschützter Bereich</a>' );
		header('location: '.((!isset($caller)||!in_array($caller,$callers))?'../shop/suche.php':'?show=shop'));
	} elseif (empty($_POST['username']) &&  empty($_POST['username'])) {
		echo('<div id="login">
<fieldset form="login-form"><legend>Login</legend>
<form name="login-form" id="login-form" action="'
		);
		if( !isset($caller) ) {
			echo('login.php');
		} else {
			echo('?show=login');
		}
		echo('" method="post">
	<label for="username">Dein Username</label>
	<input type="text" size="14" maxlength="50"
	name="username" id="username"><br>

	<label for="password">Dein Passwort</label>
	<input type="password" size="14" maxlength="50"
	name="password" id="password"><br>

	<input type="submit" value="Login">
</form>
</fieldset>
</div>'
		);
		echo('<small style="margin-left: 3em;"><a href="');
		if (!isset($caller)||!in_array($caller,$callers)) {
			echo('eintragen.php">Registrieren');
		} else {
			echo('?show=eintragen">Registrieren');
		}
		echo('</a></small>');

	} else {

		if (!empty($_POST['username']))
			$username = $_POST['username'];
			
		if (!empty($_POST['password']))
			$password = $_POST['password'];
		
		
		// handle should be put in a static object that can discontinue itself with a nother method AKA deconstructor after db_close
		$verbindung = mysql_connect( $dbhost, $dbuser, $dbpass )
		or die( "Verbindung zur Datenbank konnte nicht hergestellt werden" );
		mysql_select_db( $dbname ) or die ( "Datenbank konnte nicht ausgewählt werden" );

		$username = $_POST['username'];

		//never use LIKE for comparison of login credential, it can be alike, no difference with upper/lower cases
		$abfrage = "SELECT UserID, Username, Userpwmd5 FROM User WHERE LOWER( Username ) = LOWER( '" . mysql_escape_string( $username ). "' ) LIMIT 1;";
		$ergebnis = mysql_query( $abfrage );
		$row = mysql_fetch_object( $ergebnis );

		include_once( 'salt.php' );

		if(!empty($row->Userpwmd5) && // ! there aint no md5, for what is in a name ...
			//new: 
			hashcmp( $_POST['password'], $row->Userpwmd5, $hashsalt )
			//after all are migrated: password_verify( $_POST['password'] . $hashsalt, $row->Userpwmd5 )
			//old: $row->Userpwmd5 == pwd_hash_old( $_POST['password'] )
		) {
			$_SESSION['username'] = $username;
			$_SESSION['userid'] = $row->UserID;
			header('Location: '.((!isset($caller)||!in_array($caller,$callers))?'./login.php':'?show=login'));
		} else {
			header('Location: '.((!isset($caller)||!in_array($caller,$callers))?'./login.php':'?show=login').'#wrong_password'); /* Redirect browser */
			echo( 'Benutzername und/oder Passwort waren falsch. <a href="login.php">Login</a>' );
		}
		mysql_close( $verbindung ); //close connections
	}

	if(!isset($caller)||!in_array($caller,$callers)){
		echo( '</body></html>' );
	}
	ob_end_flush();
?>
