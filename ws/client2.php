<?php

if(
/*	(
		empty($_POST['send'])
		|| $_POST['send']!='Bezahlen'
		|| empty($_POST['cc'])
	)
	||
	//{}elseif*/
	(
		//$_POST['send'] != ['Bankabfrage']||
		!isset($_POST['blz'])
		||
		empty($_POST['blz'])
	)
){
?>
<html>
<head>
<title>Bezahlen
</title></head>
<body>
<form method="post" action="client.php">
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
/*
	$cc = (int)$_POST['cc'];
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
	$blz=(int)$_POST['blz'];
	$wsdl         = 'http://www.thomas-bayer.com/axis2/services/BLZService?wsdl';

	$options = array();
	$options['classmap']['getBankType']  = 'RequestType';

class RequestType
{
    public $blz;
}

	$bank         = new RequestType;
	$bank->blz    = $blz;

	$SOAPClient = new SoapClient($wsdl, $options);

try{
	$result     = $SOAPClient->getBank($bank);
	echo('<b>Abfrage für BLZ <i>'.$blz.'</i> Erfolgreich</b><pre>');
//	print_r($result);
	echo('
Bank	 : '.$result->details->bezeichnung.'
BIC	 : '.$result->details->bic.'
PLZ, Ort : '.$result->details->plz.', '.$result->details->ort
);
} catch(Exception $e){
	echo( $e->getMessage() . "\n" );
}

/*	echo $SOAPClient->sagHallo('Tom') . "<br>\n";
	$r=$SOAPClient->checkLuhn($cc);
	echo 'CS: stimmt' . (($r==0) ? '!' : ' nicht') . "<br>\n";
/**
	echo "<BR><BR>SOAP-Datenstruktur : <B>";
	print_r ( $SOAPClient ); 
/**/
}

?>