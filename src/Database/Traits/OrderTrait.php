<?php


namespace SmartValue\Database\Traits;


use SmartValue\Database\MySQLWrapperException;

trait OrderTrait {
	
	protected $order = [];
	
	/**
	 * @param string      $orderColumn
	 * @param string|null $orderType
	 *
	 * @return $this
	 * @throws MySQLWrapperException
	 */
	public function orderBy($orderColumn, $orderType = null){
		if(!is_string($orderColumn)){
			throw new MySQLWrapperException('Invalid order column value', MySQLWrapperException::INVALID_PARAM_TYPE);
		}
		
		if(!is_string($orderType) && $orderType !== null){
			throw new MySQLWrapperException('Invalid order type value', MySQLWrapperException::INVALID_PARAM_TYPE);
		}
		
		$this->order[] = [$orderColumn, $orderType];
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	protected function getOrderQuery(){
		$query = '';
		
		if(!empty($this->order)) {
			$query .= ' ORDER BY ';
			
			$orders = [];
			
			foreach ($this->order as $order){
				$currentOrder = $order[0];
				if($order[1])
					$currentOrder .= ' ' . $order[1];
				
				$orders[] = $currentOrder;
			}
			
			$query .= implode( ',', $orders);
		}
		
		return $query;
	}
}