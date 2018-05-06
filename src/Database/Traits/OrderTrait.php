<?php


namespace SmartValue\Database\Traits;


trait OrderTrait {
	
	protected $order = [];
	
	/**
	 * @param string $orderColumn
	 * @param string|null $orderType
	 *
	 * @return $this
	 */
	public function orderBy($orderColumn, $orderType = null){
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