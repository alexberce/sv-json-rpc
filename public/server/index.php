<?php

use JsonRPC\Server;
use SmartValue\JsonRPC\Server\CountriesApi;
use SmartValue\JsonRPC\Server\Middleware\AuthenticationMiddleware;
use Symfony\Component\Dotenv\Dotenv;

include_once "vendor/autoload.php";

//Load DotENV
(new Dotenv())->load(__DIR__ . '/../../.env');

$server = new Server();
$server->getMiddlewareHandler()->withMiddleware(new AuthenticationMiddleware());
$server->getProcedureHandler()->withClassAndMethod( "getCountriesInfoByCode", new CountriesApi);

echo $server->execute();