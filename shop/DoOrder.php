<?php
@session_start();
/* access data in config file (data not inside repo) */
include_once( 'dbconf.php' );

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
		
		$dblink = mysql_connect( $dbhost, $dbuser, $dbpass ) or
			die( 'Keine Verbindung möglich: ' . mysql_error() );
		mysql_select_db( $dbname );


		$summe=0;
		foreach( $_SESSION["artikel"] as $key => $val ) {
			if (!empty($val))
			{
				$sql = 'SELECT bu.id AS id, barcode, netto, gewicht, titel, au.name AS autor FROM 
						buecher AS bu JOIN autor AS au ON au.id = bu.autorid
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
		
				$summe += $row["netto"] * $val;
				$OrderPosition[] = array("ISBN" => $row["barcode"], "Quantity" => $val);			
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
