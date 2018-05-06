<?php


namespace SmartValue\Database\Traits;


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
	 */
	protected function getFromQuery(){
		return ' FROM ' . $this->tableName;
	}
}