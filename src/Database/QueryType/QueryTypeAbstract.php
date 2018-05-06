<?php


namespace SmartValue\Database\QueryType;


use SmartValue\Database\MySQLConnection;

abstract class QueryTypeAbstract {
	
	private $databaseConnection;
	
	/**
	 * @return \PDO
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function getDatabaseConnection() {
		if(!isset($this->databaseConnection)){
			$this->databaseConnection = MySQLConnection::getConnection();
		}
		
		return $this->databaseConnection;
	}
	
	/**
	 * @param mixed $databaseConnection
	 */
	public function setDatabaseConnection(\PDO $databaseConnection ) {
		$this->databaseConnection = $databaseConnection;
	}
	
	
}