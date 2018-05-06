<?php

use JsonRPC\Server;
use SmartValue\Database\MySQLWrapperException;
use SmartValue\JsonRPC\Server\CountriesApi;
use SmartValue\JsonRPC\Server\Middleware\AuthenticationMiddleware;
use Symfony\Component\Dotenv\Dotenv;

include_once "vendor/autoload.php";

//Load DotENV
(new Dotenv())->load(__DIR__ . '/../../.env');

$server = new Server();
$server->getMiddlewareHandler()->withMiddleware(new AuthenticationMiddleware());
$server->getProcedureHandler()->withClassAndMethod( "getCountriesInfoByCode", new CountriesApi);
$server->withLocalException(MySQLWrapperException::class);

echo $server->execute();