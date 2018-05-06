<?php


namespace SmartValue\Database\Traits;


trait WhereTrait {
	
	/**
	 * @var string
	 */
	protected $condition;
	
	/**
	 * @param string $condition
	 *
	 * @return $this
	 */
	public function where($condition){
		$this->condition = $condition;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	protected function getWhereQuery(){
		$query = '';
		
		if(!empty($this->condition)){
			$query .= ' WHERE ' . $this->condition;
		}
		
		return $query;
	}
}