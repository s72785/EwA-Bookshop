<?php

function getCheckLuhn($number) {
	$sum = 0;
	$numDigits = strlen($number)-1;
	$parity = $numDigits % 2;
	for ($i = $numDigits; $i >= 0; $i--) {
		$digit = substr($number, $i, 1);
		if (!$parity == ($i % 2)) {$digit <<= 1;}
		$digit = ($digit > 9) ? ($digit - 9) : $digit;
		$sum += $digit;
	 }
	return $sum;
}

function checkLuhn($number) {
	$sum = getCheckLuhn($number);
	return (($sum % 10));
}

function sagHallo($begruessung) {
	return 'Hallo ' . $begruessung;
}

//   $options = array('uri' => 'http://141.56.131.108/demos/ws/');

$options = array('uri' => 'http://ivm108.informatik.htw-dresden.de/ewa/g05/ws/');

$SOAPServer = new SoapServer(null, $options);

$SOAPServer->addFunction('sagHallo');
//$SOAPServer->addFunction('getCheckLuhn');
$SOAPServer->addFunction('checkLuhn');

$SOAPServer->handle();

//echo "Web service - added ...";  

?>