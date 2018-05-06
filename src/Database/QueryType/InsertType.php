<?php


namespace SmartValue\Database\QueryType;


use SmartValue\Database\MySQLConnection;

class InsertType {
	
	/**
	 * @var string
	 */
	private $tableName;
	
	/**
	 * @var array
	 */
	private $columns = [];
	
	/**
	 * @var array
	 */
	private $values = [];
	
	/**
	 * @var array
	 */
	private $valuesToBind = [];
	
	/**
	 * @param string $tableName
	 *
	 * @return $this
	 */
	public function into($tableName){
		$this->tableName = $tableName;
		
		return $this;
	}
	
	/**
	 * @param array $columns
	 *
	 * @return InsertType
	 */
	public function columns(array $columns = []){
		$this->columns = $columns;
		
		return $this;
	}
	
	/**
	 * @param array $values
	 *
	 * @return InsertType
	 */
	public function values(array $values = []){
		$this->values[] = $values;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getQuery(){
		$query = 'INSERT ';
		$query .= $this->getIntoQuery();
		$query .= $this->getColumnsQuery();
		$query .= $this->getValuesQuery();
		
		return $query;
	}
	
	/**
	 * @return string
	 */
	public function run(){
		$query = $this->getQuery();
		$pdoObject = MySQLConnection::getConnection();
		
		//Prepare our PDO statement.
		$pdoStatement = $pdoObject->prepare($query);
		
		//Bind our values.
		foreach($this->valuesToBind as $param => $val){
			$pdoStatement->bindValue($param, $val);
		}
		
		$pdoStatement->execute();
		
		return MySQLConnection::getConnection()->lastInsertId();
	}
	
	/**
	 * @return string
	 */
	private function getIntoQuery(){
		return ' INTO ' . $this->tableName;
	}
	
	private function getColumnsQuery(){
		return ' (' . implode(',', $this->columns) . ') ';
	}
	
	/**
	 * @return string
	 */
	private function getValuesQuery(){
		$query = ' VALUES ';
		
		$rowsSQL = array();
		
		foreach($this->values as $arrayIndex => $row){
			$params = array();
			foreach($row as $valueIndex => $value){
				$param = ":" . $this->columns[$valueIndex] . $arrayIndex;
				$params[] = $param;
				$this->valuesToBind[$param] = $value;
			}
			$rowsSQL[] = "(" . implode(", ", $params) . ")";
		}
		
		$query .= implode(", ", $rowsSQL);
		
		return $query;
	}
	
}