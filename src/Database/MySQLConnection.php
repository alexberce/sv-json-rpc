<?php

namespace SmartValue\Database;

use PDO;
use PDOException;

class MySQLConnection {
	
	private static $instance;
	
	private $connection = null;
	
	protected function __construct() {
		$this->connection = new PDO(
			"mysql:host=" . getenv( 'DATABASE_HOST' ) . ";dbname=" .  getenv( 'DATABASE_NAME' ),
			getenv( 'DATABASE_USERNAME' ),
			getenv( 'DATABASE_PASSWORD' )
		);
	}
	
	/**
	 * @return PDO
	 * @throws PDOException
	 */
	public static function getConnection() {
		return (self::getInstance())->connection;
	}
	
	/**
	 * @return MySQLConnection
	 */
	private static function getInstance(  ) {
		return self::$instance === null
			? new static()
			: self::$instance;
	}
	
}