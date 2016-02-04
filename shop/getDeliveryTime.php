<?php

function objectToArray($d)
{
	if(is_object($d)){
		$d=get_object_vars($d);
	}
	if(is_array($d)){
		return array_map(__FUNCTION__,$d);
	}else{
			return $d;
	}
}

if( isset($_GET['isbn']) && is_numeric($_GET['isbn']) ){
	$isbn=(int)$_GET['isbn'];
} elseif (isset($_GET['isbn']) && $_GET['isbn']=='rnd') {
	print( rand( 1, 30 ) );
	return;
} else {
	$isbn='4456458475';

	// Create SoapClient with wsdl address
	$client = new SoapClient("http://141.56.131.108:8080/Reseller/BookTrade/?wsdl");
	// Create parameter array
	$param_arr = array ( 'traderID' => 'G05', "ISBN" => $isbn ); 
	// Call operation with parameter
	$response=$client->GetDeliveryTime($param_arr);
	// Convert response to useable array
	//echo $response;
	$response_arr=objectToArray($response);
	// Extract array from response structure
	$getRandomResult=$response_arr['GetDeliveryTimeResult'];
	echo $getRandomResult;
	// Helper functionto convert an object to an array
}

?>
