<?php
	$standalone=(strpos($_SERVER["PHP_SELF"], 'ergebnisse.php')!=='');
/* access data in config file (data not inside repo) */
include_once( (($standalone)?'':'shop/').'dbconf.php' );

$dblink = mysql_connect( $dbhost, $dbuser, $dbpass ) or
	die( 'Keine Verbindung möglich: ' . mysql_error() );
mysql_select_db( $dbname );
$suche = (isset($_POST['suche'])) ? $_POST['suche'] : '' ;

//~ echo('<pre>test:'."\n");
//~ print_r( mysql_escape_string('ö') );
//~ echo('</pre>');

$sql = 'SELECT bu.id AS id, barcode, titel, ve.name AS verlag, netto, au.name AS autor FROM 
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
//~ echo("<pre>");
//~ print_r($caller);
//~ print_r($callers);
//~ echo("</pre>");
$action='?show=berechnung';
if((!isset($caller) || !in_array($caller,$callers))) {
$action='berechnung.php';
}
echo( '<form action="'.$action.'" method="post">
<table border="1"><tr>'.'<th>Gewünschte Anzahl</th>'
//.'<th>ISBN</th>'
.'<th>Titel</th>'
.'<th>Autor</th>'
.'<th>Verlag</th>'
.'<th>Einzelpreis exkl. USt</th>'
.'</tr>' );
while ( $row = mysql_fetch_array( $result ) ) {
	$anzahl=0;
	if( isset($_SESSION["artikel"][$row['barcode']]) ){
		$anzahl = $_SESSION["artikel"][$row['barcode']];
		$anzahl = ( $anzahl < 0 ) ? 0 : $anzahl;
	}
	echo( '<tr>'
	. '<td><input size="4" type="text" class="anzahl" name="artikel['.$row['barcode'].']" value='.$anzahl.' ></td>'
//	. '<td>' . utf8_encode( $row['barcode'] ) . '</td>'
	. '<td><h2><a href="'
.($standalone?'details.php?':'?show=details&amp;')
.'id='.utf8_encode( $row['id'] ) . '">' . utf8_encode( $row['titel'] ) . '</a></h2></td>'
	. '<td>' . utf8_encode( $row['autor'] ) . '</td>'
	. '<td>' . utf8_encode( $row['verlag'] ) . '</td>'
	. '<td align="right">' . utf8_encode( number_format($row['netto'], 2, ',', '.') ) . '&nbsp;€</td>'
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
