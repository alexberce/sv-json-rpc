<?php


namespace SmartValue\Database\Traits;


use SmartValue\Database\MySQLWrapperException;

trait LimitTrait {
	
	protected $limits = [];
	
	/**
	 * @param $lowerLimit
	 * @param $upperLimit
	 *
	 * @return $this
	 * @throws MySQLWrapperException
	 */
	public function limit($lowerLimit, $upperLimit = null){
		if(!is_numeric($lowerLimit)){
			throw new MySQLWrapperException('Invalid lower limit value', MySQLWrapperException::INVALID_PARAM_TYPE);
		}
		
		if(!is_numeric($upperLimit) && $upperLimit !== null){
			throw new MySQLWrapperException('Invalid upper limit value', MySQLWrapperException::INVALID_PARAM_TYPE);
		}
		
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