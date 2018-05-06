<?php

namespace SmartValue\Database;

use PDO;
use PDOException;

class MySQLConnection {
	
	private static $instance;
	
	private $connection = null;
	
	/**
	 * MySQLConnection constructor.
	 *
	 * @throws MySQLWrapperException
	 */
	protected function __construct() {
		try {
			$this->connection = new PDO(
				"mysql:host=" . getenv( 'DATABASE_HOST' ) . ";dbname=" .  getenv( 'DATABASE_NAME' ),
				getenv( 'DATABASE_USERNAME' ),
				getenv( 'DATABASE_PASSWORD' )
			);
		} catch (\Exception $exception) {
			throw new MySQLWrapperException('Invalid connection');
		}
	}
	
	/**
	 * @return PDO
	 * @throws MySQLWrapperException
	 */
	public static function getConnection() {
		if(self::$instance === null)
			self::$instance = new static();
		
		return self::$instance->connection;
	}
}