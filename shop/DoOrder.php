<?php
@session_start();

$artikel[0]["Name"]="Self-PHP";
$artikel[0]["Preis"]="25.40";
$artikel[0]["Gewicht"]="800";
$artikel[0]["ISBN"]="76e5453800";

$artikel[1]["Name"]=" PHP-Referenz";
$artikel[1]["Preis"]="18.00";
$artikel[1]["Gewicht"]="600";
$artikel[1]["ISBN"]="76e54545330";

$artikel[2]["Name"]="PHP-Kochbuch";
$artikel[2]["Preis"]="18.00";
$artikel[2]["Gewicht"]="1300";
$artikel[2]["ISBN"]="76e6345654500";

$refresh=15;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>OnlineShop - Book Orders (Client)</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="refresh" content="<?=$refresh;?>; URL=/ewa/g05/?show=success">
	</head>
	<body>
<?php
	echo('<h1>Vielen Dank - Seite <a href="/ewa/g05/?show=success">lädt nach '.$refresh.' Sekunden neu</a>.</h1>');
	//////////////////////////////////////////////////////////////
	// Author: Michael Heydeck, 04.12.2013
	
	echo "<h1>Web Service Client: BookTrade - DoOrder</h1>";

	//////////////////////////////////////////////////////////////
	// WSDL and Web-Service addresses
	$wsdlAddr = 'http://141.56.131.108:8080/Reseller/BookTrade/?wsdl';
	$wsAddr = 'http://141.56.131.108:8080/Reseller/BookTrade/';
	
	echo "Creating SOAP-Client for ".$wsAddr." with wsdl: ".$wsdlAddr."<br/><br/>";
	//////////////////////////////////////////////////////////////
	// Web Service Client
	$client = new SoapClient($wsdlAddr, array('location' => $wsAddr, 'trace' => 1));

	// PHP: wrong xml encoding in Request (uses ISO-8859-1 instead of UTF-8, see http://stackoverflow.com/questions/5317858/nusoap-and-content-type)
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$OrderPosition = array();
	$summe=0;
	if ( !empty( $_SESSION["artikel"] ) ){
		$summe=0;
		foreach( $_SESSION["artikel"] as $key => $val ) {
			if (!empty($val))
			{
				$summe += $artikel[$key]["Preis"] * $val;
				$OrderPosition[] = array("ISBN" => $artikel[$key]["ISBN"], "Quantity" => $val);			
			}
		}
	}

	try
	{
		// Call operation with parameter
		$result = $client->DoOrder(array(
			"orderID" => uniqid(),
			"traderID" => "G05",
			"customer" => "Gruppe 05",
			"totalPrice" => $summe,
			"positions" => array(
				"OrderPosition" => $OrderPosition
				)
			));

		echo "DoOrder(...) called successfully - TrackingID: ".$result->DoOrderResult;
		
		// Debug ouptput
		soapDebug($client);
	}
	catch(SoapFault $exception)
	{
		soapDebug($client);
		
		echo "<h3>Error</h3>";
		throw $exception;
	}
	
	
	//////////////////////////////////////////////////////////////
	// Functions
	function prettyXml($xmlText)
	{
		$dom = new DOMDocument("1.0");
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xmlText);
		
		return $dom->saveXML();
	}

	function soapDebug($client)
	{
		$requestHeaders = $client->__getLastRequestHeaders();
		$request = prettyXml($client->__getLastRequest());
		$responseHeaders = $client->__getLastResponseHeaders();
		$response = prettyXml($client->__getLastResponse());

		echo "<h3>Request</h3>";
		echo '<code>' . nl2br(htmlspecialchars($requestHeaders, true)) . '</code>';
		echo highlight_string($request, true) . "<br/>\n";

		echo "<h3>Response</h3>";
		echo '<code>' . nl2br(htmlspecialchars($responseHeaders, true)) . '</code>' . "<br/>\n";
		echo highlight_string($response, true) . "<br/>\n";
	}
?>
	</body>
</html>
