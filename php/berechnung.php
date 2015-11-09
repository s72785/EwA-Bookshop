<?php
//include("versand.php");
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
if (!empty($_POST["artikel"])){
	foreach($_POST["artikel"] as $val) {
		$summe = $summe + ($artikel[0]["Preis"] * $val);
		$gesamt_gewicht = $gesamt_gewicht + ($artikel[0]["Gewicht"] * $val);
	}
	
}
/*
$versand[1]="3.79";
$versand[3]="3.79";
$versand[8]="10";
*/
$gewicht = $gesamt_gewicht/1000;

foreach ($versand as $key => $val)
{
		echo $key . "<br />";
		
		//if ()
}
echo "<hr />";
echo "Zwischensummer:".$summe."<br />";
/*if ($summe>100)
	$summe*/
echo "Endsummer:". ($summe*1.07) . "<br />";
echo "Gesamtgewicht:".$gesamt_gewicht;
?>
