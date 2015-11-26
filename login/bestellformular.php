<?php
	ob_start();	//start caching of output
	
	echo( '<!doctype html><html><head><title>Bookshop - Login</title><meta charset="UTF-8"></head><body>' );
	
	session_start();
?>

<?php
	if( !isset( $_SESSION['username'] ) ) {
		echo( 'Bitte erst <a href="login.html">einloggen</a>' );
		exit;
	}
	echo( 'Das ist der geschützte Bestellformular-Bereich!' );
?>

<?php
	echo( '</body></html>' );

	ob_end_flush();
?> 
