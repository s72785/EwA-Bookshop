<?php

if(
	!isset($_POST['send'])
	|| $_POST['send']!='Bezahlen'
	|| !isset($_POST['cc'])
){
?>
<html>
<head>
<title>Bezahlen
</title></head>
<body>
<form method="post">
	<label for="cc">Kreditkartennummer:</label><input type="text" name="cc" id="cc" />
	<input type="submit" name="send" id="send" value="Bezahlen" />
</form></body></html>
<?php
} else {
	$cc = (int)$_POST['cc'];

	$options = array(
		'location' => 'http://ivm108.informatik.htw-dresden.de/ewa/g05/ws/server.php',
		'uri'      => 'http://ivm108.informatik.htw-dresden.de/ewa/g05/ws/'
	);

	echo "Get new SoapClient "; 

	$SOAPClient = new SoapClient(null, $options);

	echo "<BR>Web service - called  : " ;  

//	echo $SOAPClient->sagHallo('Tom') . "<br>\n";
	$r=$SOAPClient->checkLuhn($cc);
	echo 'CS: stimmt' . (($r==0) ? '!' : ' nicht') . "<br>\n";
/**
	echo "<BR><BR>SOAP-Datenstruktur : <B>";
	print_r ( $SOAPClient ); 
/**/
}

?>