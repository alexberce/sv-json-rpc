<?php

namespace SmartValue\Tests;

use PDO;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->load(__DIR__ . '/../.env');


class DatabaseTestCase extends PHPUnit_Framework_TestCase {
	
	/**
	 * @return PDO
	 */
	public function getConnection(){
		return new PDO(
			"mysql:host=" . getenv( 'TEST_DATABASE_HOST' ) . ";dbname=" .  getenv( 'TEST_DATABASE_NAME' ),
			getenv( 'TEST_DATABASE_USERNAME' ),
			getenv( 'TEST_DATABASE_PASSWORD' )
		);
	}
}