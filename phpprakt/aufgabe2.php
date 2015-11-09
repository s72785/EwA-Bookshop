
<?php
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE || strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false) {
    echo "Sie benutzen Microsofts Internet Explorer.<br />";
}
else {
	echo "Sie benutzen KEINEN Microsofts Internet Explorer.<br />";
}
	
?>
