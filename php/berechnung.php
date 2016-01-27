<?php
@session_start();
$standalone=(strpos($_SERVER["PHP_SELF"], 'ergebnisse.php'));
include_once( (($standalone)?'':'shop/').'dbconf.php' );
/* Übung: U5_php_vp1ok.pdf */

/* 4. Erstellen Sie ein HTML- Bestellformular (bestellg0.html) mit drei Eingabefeldern
für die gewünschte Anzahl von 3 Bücher-Sonderangeboten (Self-PHP / PHP-
Referenz / PHP-Kochbuch ) und ermöglichen Sie über eine Auswahl
(Selektorbox) die Angabe, wie der Nutzer auf diese Seite aufmerksam wurde (Ich
bin Stammkunde/TV Werbung/ Telefonbuch/ Mundpropaganda).
 * */

/* 5. Lassen Sie durch eine PHP-Ergebnisdatei berechnung.php die Zwischen-
summen und das Gesamtgewicht der bestellten Artikel ausrechnen. Geben Sie
bei negativen Eingabewerten der Menge eine entsprechende Fehlermeldung in
rot aus ! Die Nettopreise und Gewichte sind wie folgt definiert :

	Buch		|	Preis	| Gewicht
	:-----------|----------:|-----:
	Self-PHP	|	25,40 €	|	800 g
 	PHP-Referenz|	18,00 €	|	600 g
 	PHP-Kochbuch|	39,00 €	|	1300 g
 
Die Mehrwertsteuer beträgt auf alle Bücher immer 7%.
Berechnen Sie anschliessend die Versandkosten und den Bruttogesamtpreis
unter Annahme des billigsten DHL-Paketes bis max. 20 kg (sieh www.post.de).
Bei einem Gesamtpreis über 100 € sollen die Versandkosten erlassen werden.
 * */

include(((!isset($caller)||!in_array($caller,$callers))?'':'php/').'versand.php');
include(((!isset($caller)||!in_array($caller,$callers))?'':'php/').'werbung.php');

//print_r($_POST);

$artikel[0]["Name"]="Self-PHP";
$artikel[0]["Preis"]="25.40";
$artikel[0]["Gewicht"]="800";

$artikel[1]["Name"]=" PHP-Referenz";
$artikel[1]["Preis"]="18.00";
$artikel[1]["Gewicht"]="600";

$artikel[2]["Name"]="PHP-Kochbuch";
$artikel[2]["Preis"]="18.00";
$artikel[2]["Gewicht"]="1300";

if ( !empty( $_POST["werbung"] ) ) {
	$adpos=$_POST["werbung"];
} else {
	$adpos=99;
}
$summe=0;
$gesamt_gewicht=0;
$vat = 0.07; //7% USt auf Bücher

	$steuer=0;
if ( !empty( $_POST["artikel"] ) ){
	$_SESSION['artikel'] = $_POST["artikel"];

	$dblink = mysql_connect( $dbhost, $dbuser, $dbpass ) or
	die( 'Keine Verbindung möglich: ' . mysql_error() );
	mysql_select_db( $dbname );

	foreach( $_POST["artikel"] as $key => $val ) {
		$sql = 'SELECT bu.id AS id, barcode, netto, gewicht, titel, au.name AS autor
						FROM buecher AS bu
						JOIN autor AS au ON au.id = bu.autorid
						JOIN verlag AS ve ON ve.id = bu.verlagsid
						where (
							barcode = \'' . mysql_escape_string( $key ) . ' \'
						)';
		//echo $sql;
		$result = mysql_query( $sql );
		if( $result === FALSE ) {
			die( mysql_error() ); // TODO: better error handling
		}

		$row = mysql_fetch_array( $result );
 
		//echo $key . "<br>";
		if (!empty($row["netto"])) {
			$summe += $row["netto"] * $val;
			$steuer += $row["netto"] * $val * $vat;
			$gesamt_gewicht += $row["gewicht"] * $val;
		}
	}
	
}

$gewicht = $gesamt_gewicht/1000;
$vkosten=0;
foreach ($versand as $key => $val) {
		if ( $gewicht <= $key ) {
			$vkosten += $val;
			break;
		}
}
$steuer += $vkosten * $vat;

echo( "<hr />\n"
	.'<span style="width:9em;display:inline-block;">Zwischensummer</span><span style="width:3em;display:inline-block;text-align:right;">'. number_format($summe, 2, ',', '.') ."</span>€<br>\n"
	.'<span style="width:9em;display:inline-block;">Versandkosten</span><span style="width:3em;display:inline-block;text-align:right;">' . number_format($vkosten, 2, ',', '.') . "</span>€<br>\n"
	.'<span style="width:9em;display:inline-block;">Umsatzsteuer:</span><span style="width:3em;display:inline-block;text-align:right;">' . number_format($steuer, 2, ',', '.') . "</span>€<br>\n"
	."<hr>\n"
	.'<span style="width:9em;display:inline-block;">Endsummer</span><span style="width:3em;display:inline-block;text-align:right;">'. number_format( ( $vkosten + $summe + $steuer ), 2, ',', '.') . "</span>€<br>\n"
	.'<span style="width:9em;display:inline-block;">Gesamtgewicht</span><span style="width:3em;display:inline-block;text-align:right;">' .number_format(($gewicht), 3, ',', '.') . "</span>kg<hr>\n"
	.'<span style="width:9em;display:inline-block;">Lieferzeit</span><span><span style="width:3em;display:inline-block;text-align:right;">'
);

include_once(((!isset($caller)||!in_array($caller,$callers))?'../':'').'shop/getDeliveryTime.php');

echo '</span>Tage<hr><span style="width:9em;display:inline-block;">Fand Shop über</span>'
	. (!empty($werbung[$adpos])?$werbung[$adpos]:"keine Angaben") . "\n";

/* 6. Zeigen Sie nach erfolgter Berechnung das Eingabeformular aus 4. erneut an und
vermerken Sie die bereits ermittelten Preis und Gewichtsangaben als verborgene
Felder im Hintergrund des Formular und addieren Sie diese bei einer zusätzlichen
Bestellung hinzu. .

 * Zusatzaufgabe (6.) ist fail!
 * Verborgene Felder kann der Kunde manipulieren, deshalb rechnet man damit nicht weiter
 * */
$plz=(isset($_POST['plz']))?$_POST['plz']:'01069';//std:dresden
$blz=(isset($_POST['blz']))?$_POST['blz']:'85050300';//std:sparkasse dd
$ccn=(isset($_POST['ccn']))?$_POST['ccn']:'41111';//std:irgendwas
$ctr=/*(isset($_POST['ctr']))?$_POST['ctr']:*/'Deutschland';//std:irgendwas

// action="'. ( ((!isset($caller)||!in_array($caller,$callers))?'../':'').'shop/DoOrder.php').'"
echo( '<form type="post">
<div>
<label for="plz">PLZ</label><input type="text" size="5" name="plz" id="plz" value="'.$plz.'">
</div><div>
<label for="ctr">Land</label><input type="text" size="32" name="ctr" id="plz" disabled value="'.$ctr.'">
</div><div>
<label for="blz">BLZ</label><input type="text" size="8" name="blz" id="blz" value="'.$blz.'"><a target="_blank" href="http://ivm108.informatik.htw-dresden.de/ewa/g05/ws/client2.php">Prüfen der BLZ</a>
</div><div>
<label for="ccn">Kreditkarte</label><input type="text" size="32" name="ccn" id="ccn" value="'.$ccn.'"><a target="_blank" href="http://ivm108.informatik.htw-dresden.de/ewa/g05/ws/client2.php">Prüfen der Kreditkartennummer</a>
</div>
<input type="submit" value="Verbindlich bestellen">
</form>
<script type="text/javascript">

	function testStr( tString, type )
	{
		switch (type) {
			case "plz":
				return !(tString.match(/^[0-9]{5}$/))? false:true;   
			break;
			case "blz":
				return !(tString.match(/^[0-9]{8}$/))? false:true;   
			break;
			default:
				return !(tString.match(/([a-z0-9.,;:öäüß _-])/gi))? false:true;
		}
	}

	$("#plz").keyup(function(){
		$e=$("#plz");
		$bg="#f00";
		if ( testStr( $e.val(), "plz" ) ) {
			$bg="#0f0";
		}
		$e.css("background-color", $bg)
	});

	$("#blz").keyup(function(){
		var k="blz";
		$e=$("#"+k);
		$bg="#f00";
		if ( testStr( $e.val(), k ) ) {
			$bg="#0f0";
		}
		$e.css("background-color", $bg)
	});

 </script>
');

?>