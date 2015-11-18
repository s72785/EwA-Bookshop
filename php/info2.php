<?php

$new_array['Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko']='MSIE';
$new_array['Mozilla/5.0 (Windows NT 6.3; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0']='FF';

//print_r($_SERVER["HTTP_USER_AGENT"]);
if ( !empty( $new_array[$_SERVER['HTTP_USER_AGENT']] ) ) {
	echo "Sie benutzen den Browser: ".$new_array[$_SERVER['HTTP_USER_AGENT']];
} else {
	echo 'keine eindeutige Broswerangabe';
}

?>
