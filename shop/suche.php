<?php
echo( '<!doctype html><html><head><title>Bookshop - Übersicht</title><meta charset="UTF-8"></head><body>' );

/* access data in config file (data not inside repo) */
include_once( 'dbconf.php' );


?>
 <form action="suche.php" method="post">
	  <label for="suche">Suche</label><br>
	  <input type="text" name="suche" id="suche">
	  <br>
	  <input type="submit" value="Submit">	 
</form> 
<?php

$dblink = mysql_connect( $dbhost, $dbuser, $dbpass ) or
	die( 'Keine Verbindung möglich: ' . mysql_error() );
mysql_select_db( $dbname );

$sql = 'SELECT bu.id AS id, barcode, titel, au.name AS autor FROM 
						buecher AS bu JOIN autor AS au ON au.id = bu.autorid
						JOIN verlag AS ve ON ve.id = bu.verlagsid
						where (titel like \'%'.$_POST["suche"].'%\' or 
								au.name like \'%'.$_POST["suche"].'%\' or
								ve.name like \'%'.$_POST["suche"].'%\'	)';
#echo $sql;
$result = mysql_query($sql  );

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
