<?php


namespace SmartValue\Database\Traits;


trait LimitTrait {
	
	protected $limits = [];
	
	/**
	 * @param $lowerLimit
	 * @param $upperLimit
	 *
	 * @return $this
	 */
	public function limit($lowerLimit, $upperLimit = null){
		$this->limits = [$lowerLimit, $upperLimit];
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	protected function getLimitQuery(){
		$query = '';
		
		if(!empty($this->limits)) {
			$query .= ' LIMIT ' . $this->limits[0];
			
			if ( !empty( $this->limits[1])){
				$query .= ', ' . $this->limits[1];
			}
		}
		
		return $query;
	}
}