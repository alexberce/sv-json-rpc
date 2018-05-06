<?php

use JsonRPC\Client;
use Symfony\Component\Dotenv\Dotenv;

header('Access-Control-Allow-Origin: http://127.0.0.1:8080');

include_once "vendor/autoload.php";

//Load DotENV
(new Dotenv())->load(__DIR__ . '/../../.env');

$countryCode = !empty($_REQUEST['countryCode']) ? $_REQUEST['countryCode'] : null;

try {
	$client = new Client('http://127.0.0.1:8082');
	$client->getHttpClient()
	       ->withUsername(getenv('JSON_RPC_SERVER_USERNAME'))
	       ->withPassword(getenv('JSON_RPC_SERVER_PASSWORD'))->withDebug();

	$result = $client->execute( "getCountriesInfoByCode", ['code' => $countryCode]);
	
	echo json_encode($result);
	
} catch (\Exception $exception) {
	echo $exception->getMessage();
}