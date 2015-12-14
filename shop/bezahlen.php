<?php


 function checkLuhn($number) {
     $sum = 0;
     $numDigits = strlen($number)-1;
     $parity = $numDigits % 2;
     for ($i = $numDigits; $i >= 0; $i--) {
         $digit = substr($number, $i, 1);
         if (!$parity == ($i % 2)) {$digit <<= 1;}
         $digit = ($digit > 9) ? ($digit - 9) : $digit;
         $sum += $digit;
     }
     return (0 == ($sum % 10));
 }

if(isset($_POST['send']) && $_POST['send']=='Bezahlen'){
	
}
 
?><html>
<head>
<title>Bezahlen
</title></head>
<body>
<form method="post">
	<label for="cc">Kreditkartennummer:</label><input type="text" name="cc" id="cc" />
	<label for="vcc">Prüfziffer:</label><input type="text" name="vcc" id="vcc" />
	<input type="submit" name="send" id="send" value="Bezahlen" />
</form></body></html>