<?php


namespace SmartValue\Database\Traits;


use SmartValue\Database\MySQLWrapperException;

trait GroupByTrait {
	protected $groupBy = [];
	
	/**
	 * @param $groupByValue
	 *
	 * @return $this
	 * @throws MySQLWrapperException
	 */
	public function groupBy($groupByValue){
		if(!is_string( $groupByValue)){
			throw new MySQLWrapperException('Invalid GROUP BY value', MySQLWrapperException::INVALID_PARAM_TYPE);
		}
		
		$this->groupBy[] = $groupByValue;
		
		return $this;
	}
	
	protected function getGroupByQuery(){
		$query = '';
		
		if(!empty($this->groupBy)){
			$query .= ' GROUP BY ' . implode( ',', $this->groupBy);
		}
		
		return $query;
	}
}