<?php
	$standalone=(strpos($_SERVER["PHP_SELF"], 'ergebnisse.php'));
/* access data in config file (data not inside repo) */
include_once( (($standalone)?'':'shop/').'dbconf.php' );

$dblink = mysql_connect( $dbhost, $dbuser, $dbpass ) or
	die( 'Keine Verbindung möglich: ' . mysql_error() );
mysql_select_db( $dbname );
$suche = (isset($_POST['suche'])) ? $_POST['suche'] : '' ;

$sql = 'SELECT bu.id AS id, barcode, titel, netto, au.name AS autor FROM 
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
//~ <!--
	  //~ Self-PHP:<br>
	  //~ <input type="text" name="artikel[0]">
	  //~ <br>
	  //~ Referenz:<br>
	  //~ <input type="text" name="artikel[1]">
	  //~ <br>
	  //~ PHP-Kochbuch:<br>
	  //~ <input type="text" name="artikel[2]">
	  //~ <br><br>
	  //~ 
//~ 
//~ -->
echo( '<form action="'.((!isset($caller)||!in_array($caller,$callers))?'berechnung.php':'?show=berechnung').'" method="post">
<table border="1"><tr><th>Gewünschte Anzahl</th><th>ISBN</th><th>Preis</th><th>Titel</th><th>Autor</th></tr>' );
while ( $row = mysql_fetch_array( $result ) ) {
	$anzahl=0;
	if( isset($_SESSION["artikel"][$row['barcode']]) ){
		$anzahl=$_SESSION["artikel"][$row['barcode']];
	}
	echo( '<tr>'
	. '<td><input size="4" type="text" name="artikel['.$row['barcode'].']" value='.$anzahl.' ></td><td>' . utf8_encode( $row['barcode'] ) . '</td>'
	. '<td align="right">' . utf8_encode( number_format($row['netto'], 2, ',', '.') ) . '&nbsp;€</td>'
	. '<td><h2><a href="'
.($standalone?'details.php?':'?show=details&amp;')
.'id='.utf8_encode( $row['id'] ) . '">' . utf8_encode( $row['titel'] ) . '</a></h2></td>'
	. '<td>' . utf8_encode( $row['autor'] ) . '</td>'
	. '</tr>' );
}
echo( '</table><input type="submit" value="Bestellen"><select name="werbung">
		  <option value="1">Ich bin Stammkunde</option>
		  <option value="2">TV Werbung</option>
		  <option value="3">Telefonbuch</option>
		  <option value="4">Mundpropaganda</option>
	  </select>
</form>' );
mysql_free_result( $result );
mysql_close( $dblink );

?>
