<pre><?php

$a = Array(
	//"" => "MSIE",
	"Mozilla/5.0 (X11; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0" => "Firefox"
);

//echo phpinfo();


echo 'Die Kennzeichnung <code>' . $_SERVER['HTTP_USER_AGENT'] . '</code> wird ein ' . $a[ "Mozilla/5.0 (X11; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0" ] . ' sein.';

//echo();
/**/

?></pre>