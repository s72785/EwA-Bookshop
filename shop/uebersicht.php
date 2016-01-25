<?php
//todo: auf einbindung prüfen
echo( '<!doctype html><html><head><title>Bookshop - Übersicht</title><meta charset="UTF-8"></head><body>' );

/* access data in config file (data not inside repo) */
include_once( 'dbconf.php' );

$dblink = mysql_connect( $dbhost, $dbuser, $dbpass ) or
	die( 'Keine Verbindung möglich: ' . mysql_error() );
mysql_select_db( $dbname );

$result = mysql_query( 'SELECT bu.id AS id, barcode, titel, au.name AS autor FROM buecher AS bu JOIN autor AS au ON au.id = bu.autorid' );

if( $result === FALSE ) {
	die( mysql_error() ); // TODO: better error handling
}

echo( '<table border="1">' );
while ( $row = mysql_fetch_array( $result ) ) {
	echo( '<tr>'
	. '<td>' . utf8_encode( $row['barcode'] ) . '</td>'
	. '<td><h2><a href="details.php?id=' . utf8_encode( $row['id'] ) . '">' . utf8_encode( $row['titel'] ) . '</a></h2></td>'
	. '<td>' . utf8_encode( $row['autor'] ) . '</td>'
	. '</tr>' );
}
echo( '</table>' );

mysql_free_result( $result );

mysql_close( $dblink );

echo('</body></html>');

?>
