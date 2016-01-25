<?php
// Create SoapClient with wsdl address
$client = new SoapClient("http://141.56.131.108:8080/Reseller/SampleService/?wsdl");
// Create parameter array
$param_arr = array ( 'maxValue' => 123 ); 
// Call operation with parameter
$response=$client->GetRandom($param_arr);
// Convert response to useable array
$response_arr=objectToArray($response);
// Extract array from response structure
$getRandomResult=$response_arr['GetRandomResult'];

//echo($_SERVER['PHP_SELF']);
echo('SOAP::GetRandom(...) returns: '.$getRandomResult);

// Helper functionto convert an object to an array
function objectToArray($d){
	if(is_object($d)){
		$d=get_object_vars($d);
	}
	if(is_array($d)){
		return array_map(__FUNCTION__,$d);
		}else{
			return $d;
		}
}
?>
