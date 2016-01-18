<?php

if(
	(
		empty($_POST['send'])
		|| $_POST['send']!='Bezahlen'
		|| empty($_POST['cc'])
	)
	||
	//{}elseif
	(
		$_POST['send']!=['Bankabfrage']
		|| empty($_POST['blz'])
	)
){
?>
<html>
<head>
<title>Bezahlen
</title></head>
<body>
<form method="post">
	<label for="cc">Kreditkartennummer:</label><input type="text" name="cc" id="cc" value="41111" />
	<input type="submit" name="send" id="send" value="Bezahlen" />
</form>
<form method="post">
	<label for="blz">BLZ:</label><input type="text" name="blz" id="blz" value="12096597" />
	<input type="submit" name="send" id="send" value="Bankabfrage" />
</form>
</body></html>
<?php
} else {
	$cc = (int)$_POST['cc'];
/*
	$options = array(
		'location' => 'http://ivm108.informatik.htw-dresden.de/ewa/g05/ws/server.php',
		'uri'      => 'http://ivm108.informatik.htw-dresden.de/ewa/g05/ws/'
	);

	echo "Get new SoapClient "; 

	$SOAPClient = new SoapClient(null, $options);

	echo "<BR>Web service - called  : " ;  
*/
error_reporting(-1);
ini_set('display_errors', TRUE);
	$wsdl         = 'http://www.thomas-bayer.com/axis2/services/BLZService?wsdl';
	$bankleitzahl = '12070000';
	$SOAPClient = new SoapClient($wsdl);
	$result     = $soapclient->getBank($bankleitzahl);
	print_r($result);

/*	echo $SOAPClient->sagHallo('Tom') . "<br>\n";
	$r=$SOAPClient->checkLuhn($cc);
	echo 'CS: stimmt' . (($r==0) ? '!' : ' nicht') . "<br>\n";
/**
	echo "<BR><BR>SOAP-Datenstruktur : <B>";
	print_r ( $SOAPClient ); 
/**/
}

?>