# SmartValue Practical test 

## Info


## Prerequisites

* PHP 5.6 (CLI)
* composer

## Setup 

1. Create a .env file in the root directory having the variables from .env.example
2. Run `composer install` to get the required dependencies
3. Start the php servers using the scripts from the composer file

## Scripts

PHP Servers

```
    composer run web --timeout=0
    composer run client --timeout=0
    composer run server --timeout=0
```

## Servers

[http://127.0.0.1:8080](http://127.0.0.1:8080) - Web Application
[http://127.0.0.1:8081](http://127.0.0.1:8081) - JSON-RPC client
[http://127.0.0.1:8082](http://127.0.0.1:8082) - JSON-RPC server

## Tests