<?php

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

if ( !empty( $_POST["artikel"] ) ){
	foreach( $_POST["artikel"] as $val ) {
		$summe = $summe + ($artikel[0]["Preis"] * $val);
		$gesamt_gewicht = $gesamt_gewicht + ($artikel[0]["Gewicht"] * $val);
	}
	
}

$gewicht = $gesamt_gewicht/1000;
echo "<hr />\n";
echo "Zwischensummer:".$summe."<br />\n";

foreach ($versand as $key => $val)
{
		if ($gewicht<=$key)
		{
			$summe = $summe + $val;
			echo "Versandkosten:" . $val . "\n";
			break;
		}
}
echo "<hr />\n";

echo "Endsummer:". ($summe*1.07) . "<br />\n";
echo "Gesamtgewicht:".$gesamt_gewicht . "<hr />\n";
/*print_R($werbung);
echo $_POST["werbung"];*/
echo "Fand Shop über: " . (!empty($werbung[$_POST["werbung"]])?$werbung[$_POST["werbung"]]:"keine Angaben") . "\n";

?>
