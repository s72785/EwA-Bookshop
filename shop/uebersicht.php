<?php

/* access data in config file (data not inside repo) */
include_once( 'dbconf.php' );

mysql_connect( $dbhost, $dbuser, $dbpass ) or
	die( 'Keine Verbindung möglich: ' . mysql_error() );
mysql_select_db( $dbname );

$result = mysql_query( 'SELECT bu.id AS id, barcode, titel, au.name AS autor FROM buecher AS bu JOIN autor AS au ON au.id = bu.autorid' );

if( $result === FALSE ) { 
	die( mysql_error() ); // TODO: better error handling
}

echo '<table border="1">';
while ( $row = mysql_fetch_array( $result ) ) {
	echo '<tr>';
	echo '<td>' . $row['barcode'] . '</td>';
	echo '<td><h2><a href="details.php?id=' . $row['id'] . '">' . $row['titel'] . '</a></h2></td>';
	echo '<td>' . $row['autor'] . '</td>';
	echo '</tr>';
}
echo '</table>';  

mysql_free_result( $result );

?>
