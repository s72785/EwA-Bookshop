<?php

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

include('versand.php');
include('werbung.php');

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

$summe=0;
$gesamt_gewicht=0;
$vat = 0.07; //7% USt auf Bücher

if ( !empty( $_POST["artikel"] ) ){
	foreach( $_POST["artikel"] as $val ) {
		$summe += $artikel[0]["Preis"] * $val;
		$gesamt_gewicht += $artikel[0]["Gewicht"] * $val;
	}
	
}

$gewicht = $gesamt_gewicht/1000;
echo "<hr />\n";
echo "Zwischensummer:".$summe."<br />\n";

foreach ($versand as $key => $val)
{
		if ($gewicht<=$key)
		{
			$versand = $val;
			break;
		}
}

$summe += $versand;
echo "Versandkosten:" . $versand . "\n";
echo "<hr />\n";

echo "Endsummer:". ( $summe * ( 1 + $vat ) ) . "<br />\n";
echo "Gesamtgewicht:".$gesamt_gewicht . "<hr />\n";
/*print_R($werbung);
echo $_POST["werbung"];*/
echo "Fand Shop über: " . (!empty($werbung[$_POST["werbung"]])?$werbung[$_POST["werbung"]]:"keine Angaben") . "\n";

/* 6. Zeigen Sie nach erfolgter Berechnung das Eingabeformular aus 4. erneut an und
vermerken Sie die bereits ermittelten Preis und Gewichtsangaben als verborgene
Felder im Hintergrund des Formular und addieren Sie diese bei einer zusätzlichen
Bestellung hinzu. .

 * Zusatzaufgabe (6.) ist fail!
 * Verborgene Felder kann der Kunde manipulieren, deshalb rechnet man damit nicht weiter
 * */

?>
