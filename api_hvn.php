<?php 
ini_set('memory_limit','512M');
$hno = '9287170261';//$_GET['hno']; // Health Number
$vno = 'DK';//$_GET['vno']; // Version 

$user = "confsu+364@gmail.com";
$pass = "Password1!";
//phpinfo();
try {
    $opts = array(
        'http' => array(
            'user_agent' => 'PHPSoapClient'
        )
    );
    $context = stream_context_create($opts);
	$wsdlUrl = 'https://ws.ebs.health.gov.on.ca:1444/HCVService/HCValidationService?wsdl';

	
	$soapClientOptions = array(
    'trace' => 1,
	'login' => $user,
	'password' => $pass,
	'cache_wsdl' => WSDL_CACHE_NONE,
    'stream_context' => stream_context_create(array(
          'ssl' => array(
               'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => false
          )
    )));

    $client = new SoapClient($wsdlUrl, $soapClientOptions);
	
print_r($client->__getLastRequestHeaders());
echo "<br> :1:__getLastRequestHeaders <br>";

print_r($client->__getLastRequest()); // Returns XML from last request (Requires trace option)

echo "<br> :2:__getLastRequest <br>";
print_r($client->__getTypes()); // Returns array of types for service (WSDL mode only)
echo "<br> :3:__getTypes <br>";

print_r($client->__getLastResponse()); // Returns XML from last response (Requires trace option)
//());
echo "<br> :4:__getLastResponse <br>";

print_r($client->__getLastResponseHeaders()); // Returns XML from last response (Requires trace option)
echo "<br> :5:__getLastResponseHeaders <br>";

print_r($client->__getFunctions());
echo "<br> :6:__getFunctions<br>";

//die();
echo "<Br> ... <br>";
//print_r($client->__getTypes()); 
$checkVatParameters2 = array();
$checkVatParameters2 = array('requests' => 
							array('hcvRequest' => 
								array('healthNumber' => '$hno', 'versionCode' => '$vno' ) 
								)
							);
	//var_dump($client->validate($checkVatParameters2));
	$Result_output = $client->validate($checkVatParameters2);
	
}
catch(Exception $e) {
    $Result_output = $e->getMessage();
}
if($Result_output == 'success'){
	echo "Ok";
}else{
	echo $Result_output;	
}

?>