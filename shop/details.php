<?php

echo( '<!doctype html><html><head><title>Bookshop - Übersicht</title><meta charset="UTF-8"></head><body>' );

/* access data in config file (data not inside repo) */
include_once( 'dbconf.php' );

$dblink = mysql_connect( $dbhost, $dbuser, $dbpass ) or
	die( 'Keine Verbindung möglich: ' . mysql_error() );
mysql_select_db( $dbname );

if( isset($_GET['id'] ) ) {

$result = mysql_query('SELECT bu.id, barcode, titel, au.name AS autor FROM buecher AS bu JOIN autor AS au ON au.id = bu.autorid'.( ( !isset($_GET['id'] ) )?'':" WHERE bu.id='" . intval($_GET['id']) ) . "'");

if($result === FALSE) { 
	die( mysql_error() ); // TODO: better error handling
}

echo( '<table border="1">' );
while ( $row = mysql_fetch_array( $result ) ) {
	echo( '<tr>'
	. '<td>' . utf8_encode( $row['barcode'] ) . '</td>'
	. '<td><h2>' . utf8_encode( $row['titel'] ) . '</h2></td>'
	. '<td>' . utf8_encode( $row['autor'] ) . '</td>'
	. '</tr>' );
}
echo( '</table><small><a href="">zurück</a></small>' );  

mysql_free_result($result);

} else {
	echo('Keine Details ohne <a href="details.php?id=1">ID</a>.');
}

mysql_close( $dblink );

echo('</body></html>');

?>
