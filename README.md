# SmartValue practical test 

## Info

Tho code on this repository/archive implements the requirements from the techinical test, which are:

1. A database wrapper (can be found in /src/Database/). [Usage](/src/Database/README.md)
2. A JSON-RPC server (can be found in /public/server and /src/JsonRPC).
3. A JSON-RPC client (can be found in /public/client).
4. An improved version of the locations_countries table (can be found in /data/locations_countries.sql).
5. An html page where the user can search for countries (can be found in /public/index.php).
6. Some unit tests can be found in /tests

The database wrapper implementation is not complete and SHOULD NOT be used on a production server, 
it is just a simple implementation and has many flaws. 
It would take weeks to create a fully functional database wrapper, and I don't think this is the scope of the test.

The locations_countries table could be improved even more by dropping the `id` column and making the `code` column a primary key.
Given the limited (finite) number of countries in the world, I decided to keep it because it won't bring much more performance and I already had code using it.

There is no need for a web server to test this code, `composer` will take care of creating them on demand.

Approx. time to complete: 5 hours

## Prerequisites

* PHP 5.6 (CLI)
* composer

## Setup 

1. Create a .env file in the root directory having the variables from .env.example
2. Run `composer install` to get the required dependencies
3. Start the php servers using the scripts from the composer file
4. Import the new locations_countries table from /data/locations_countries.sql (optional)
5. Create a new database for the tests (optional)

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
