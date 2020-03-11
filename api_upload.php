<?php 
$Binary_File = $_GET['Files_Binary_File'];
$description = $_GET['txtdescription'];
$resourceType = $_GET['resourceType'];
/*
$Binary_File = "a";
$description = "AAA";
$resourceType = "ASS";
*/
try {
    $opts = array(
        'http' => array(
            'user_agent' => 'PHPSoapClient'
        )
    );
    $context = stream_context_create($opts);
	$wsdlUrl = 'https://ws.ebs.health.gov.on.ca:1443/EDTService/EDTService?wsdl';
	
	$soapClientOptions = array(
    'cache_wsdl' => 0,
    'trace' => 1,
	'cache_wsdl' => WSDL_CACHE_NONE,
    'stream_context' => stream_context_create(array(
          'ssl' => array(
               'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => false
          )
    )));

    $client = new SoapClient($wsdlUrl, $soapClientOptions);
	
//print_r($client->__getFunctions());
//echo "<Br> ... <br>";
//print_r($client->__getTypes()); 
//die();
$checkVatParameters2 = array();
$checkVatParameters2 = array('upload' => 
							array('content' => '$Binary_File', 'description' => '$description', 'resourceType' => '$resourceType' ) 
							);
	//var_dump($client->upload($checkVatParameters2));
	$Result_output = $client->upload($checkVatParameters2);
	
}
catch(Exception $e) {
    $Result_output = $e->getMessage();
}
if($Result_output == 'success'){
	echo "Your Data is Uploaded Thanks";
//	header('Location: '.$newURL);

}else{
	echo $Result_output;	
}

?>