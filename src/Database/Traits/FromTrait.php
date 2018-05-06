<?php


namespace SmartValue\Database\Traits;


use SmartValue\Database\MySQLWrapperException;

trait FromTrait {
	
	/**
	 * @var string
	 */
	protected $tableName;
	
	/**
	 * @param string $tableName
	 *
	 * @return $this
	 */
	public function from($tableName){
		$this->tableName = $tableName;
		
		return $this;
	}
	
	/**
	 * @return string
	 * @throws MySQLWrapperException
	 */
	protected function getFromQuery(){
		
		if(empty($this->tableName))
			throw new MySQLWrapperException('Invalid table name', MySQLWrapperException::INVALID_TABLE_NAME);
		
		return ' FROM ' . $this->tableName;
	}
}