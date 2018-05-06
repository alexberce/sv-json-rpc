<pre><?php

use JsonRPC\Client;
use Symfony\Component\Dotenv\Dotenv;

include_once "vendor/autoload.php";

//Load DotENV
(new Dotenv())->load(__DIR__ . '/../../.env');

try {
	$client = new Client('http://127.0.0.1:8082');
	$client->getHttpClient()
	       ->withUsername(getenv('JSON_RPC_SERVER_USERNAME'))
	       ->withPassword(getenv('JSON_RPC_SERVER_PASSWORD'))->withDebug();

	$result = $client->execute( "getCountriesInfoByCode", ['code' => 'RO']);
	
	echo json_encode($result);
	
} catch (\Exception $exception) {
	echo $exception->getMessage();
}