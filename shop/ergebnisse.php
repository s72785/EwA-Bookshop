<?php
	$standalone=(strpos($_SERVER["PHP_SELF"], 'ergebnisse.php'));
/* access data in config file (data not inside repo) */
include_once( (($standalone)?'':'shop/').'dbconf.php' );

$dblink = mysql_connect( $dbhost, $dbuser, $dbpass ) or
	die( 'Keine Verbindung möglich: ' . mysql_error() );
mysql_select_db( $dbname );
$suche = (isset($_POST['suche'])) ? $_POST['suche'] : '' ;

$sql = 'SELECT bu.id AS id, barcode, titel, au.name AS autor FROM 
						buecher AS bu JOIN autor AS au ON au.id = bu.autorid
						JOIN verlag AS ve ON ve.id = bu.verlagsid
						where (
							titel like \'%' . mysql_escape_string( $suche ) . '%\' or 
							au.name like \'%' . mysql_escape_string( $suche ) . '%\' or
							ve.name like \'%' . mysql_escape_string( $suche ) . '%\'
						)';
//echo $sql;
$result = mysql_query( $sql );
if( $result === FALSE ) {
	die( mysql_error() ); // TODO: better error handling
}
echo( '<table border="1">' );
while ( $row = mysql_fetch_array( $result ) ) {
	echo( '<tr>'
	. '<td>' . utf8_encode( $row['barcode'] ) . '</td>'
	. '<td><h2><a href="'
.($standalone?'details.php?':'?show=details&amp;')
.'id='.utf8_encode( $row['id'] ) . '">' . utf8_encode( $row['titel'] ) . '</a></h2></td>'
	. '<td>' . utf8_encode( $row['autor'] ) . '</td>'
	. '</tr>' );
}
echo( '</table>' );
mysql_free_result( $result );
mysql_close( $dblink );

?>
