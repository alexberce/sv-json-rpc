<?php


namespace SmartValue\Database\Traits;


trait GroupByTrait {
	protected $groupBy = [];
	
	/**
	 * @param $groupByValue
	 *
	 * @return $this
	 */
	public function groupBy($groupByValue){
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