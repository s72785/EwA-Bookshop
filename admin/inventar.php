<!doctype html>
<html>
	<head>
		<title>Bookshop - Inventar</title>
		<meta charset="UTF-8">
		<style>
			td {
				border: 1px solid black;
				padding: 0.3ex;
			}
			.red {
				color: red;
			}
			table {
				padding: 0;
				margin: 0;
			}
			.right-align {
				text-align: right;
			}
		</style>
	</head>
	<body><?php

//echo( '' );

/* access data in config file (data not inside repo) */
include_once( '' /**/ . '../shop/' /**/ . 'dbconf.php' );

$dblink = mysql_connect( $dbhost, $dbuser, $dbpass ) or
	die( 'Keine Verbindung möglich: ' . mysql_error() );
mysql_select_db( $dbname );

$result = mysql_query( 'SELECT	b.id AS id,
								b.barcode AS barcode,
								b.titel AS titel,
								b.lager AS lager,
								b.netto AS preis,
								a.name AS autor
							FROM buecher b JOIN autor a ON a.id = b.autorid;' );

if( $result === FALSE ) {
	die( mysql_error() ); // TODO: better error handling
}

echo(
	'<h1>Inventar</h1>'
	. '<table border="1" cellspacing="0">'
	. '<tr><td>Barcode</td><td>Titel</td><td>Autor</td><td>Bestand</td><td>Einzepreis</td><td>Gesamtpreis</td></tr>'
);
$sumbestand = 0;
$sumpreis = 0;
while ( $row = mysql_fetch_array( $result ) ) {
	$bestand = (int)$row['lager'];
	$epreis = (float)$row['preis'];
	$gpreis = $bestand * (float)$row['preis'];
	$sumbestand += $bestand;
	$sumpreis += $gpreis;
	echo( '<tr>'
	. '<td class="barcode">' . utf8_encode( $row['barcode'] ) . '</td>'
	. '<td class=""><a href="details.php?id=' . utf8_encode( $row['id'] ) . '">' . utf8_encode( $row['titel'] ) . '</a></td>'
	. '<td class="">' . utf8_encode( $row['autor'] ) . '</td>'
	. '<td class="right-align ' . ( ( $bestand < 10 )? 'red' : '' ) . '">' . utf8_encode( $bestand ) . '</td>'
	. '<td class="right-align">' . utf8_encode( round( $epreis, 2 ) ) . '</td>'
	. '<td class="right-align">' . utf8_encode( round( $gpreis, 2 ) ) . '</td>'
	. '</tr>' );
}
echo(
	'<tr><td colspan="3">Summe</td><td class="right-align">' . $sumbestand . '</td><td>&nbsp;</td><td class="right-align">' . $sumpreis . '</td></tr>'
	. '</table>'
);

mysql_free_result( $result );

mysql_close( $dblink );

//echo('');

?>
</body>
</html>