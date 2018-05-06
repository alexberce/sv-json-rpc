<?php


namespace SmartValue\Database\QueryType;


use SmartValue\Database\MySQLConnection;
use SmartValue\Database\MySQLWrapperException;

class QueryType {
	
	/**
	 * @var string
	 */
	private $query;
	
	/**
	 * QueryType constructor.
	 *
	 * @param string $query
	 */
	public function __construct($query) {
		$this->query = $query;
	}
	
	/**
	 * @return string
	 */
	public function getQuery(){
		return $this->query;
	}
	
	/**
	 * @return bool|\PDOStatement
	 * @throws MySQLWrapperException
	 */
	public function run(){
		$result = MySQLConnection::getConnection()->query($this->getQuery());
		
		return $result;
	}
	
}