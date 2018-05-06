<?php

namespace SmartValue\Database\QueryType;

use PDO;
use SmartValue\Database\MySQLWrapperException;
use SmartValue\Database\Traits\FromTrait;
use SmartValue\Database\Traits\GroupByTrait;
use SmartValue\Database\Traits\OrderTrait;
use SmartValue\Database\Traits\WhereTrait;
use SmartValue\Database\Traits\LimitTrait;

class SelectType extends QueryTypeAbstract implements QueryTypeInterface {
	
	use FromTrait, WhereTrait, OrderTrait, GroupByTrait, LimitTrait;
	
	/**
	 * @var array|string
	 */
	private $columns;
	
	/**
	 * SelectStatement constructor.
	 *
	 * @param array $columns
	 */
	public function __construct($columns = []) {
		$this->columns = $columns;
	}
	
	/**
	 * @return string
	 * @throws MySQLWrapperException
	 */
	public function getQuery() {
		$query = 'SELECT ';
		$query .= $this->getColumnsQuery();
		$query .= $this->getFromQuery();
		$query .= $this->getWhereQuery();
		$query .= $this->getGroupByQuery();
		$query .= $this->getOrderQuery();
		$query .= $this->getLimitQuery();
		
		return $query;
	}
	
	/**
	 * @return array
	 *
	 * @throws MySQLWrapperException
	 */
	public function run(){
		$result = $this->getDatabaseConnection()->query($this->getQuery());
		
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/**
	 * @return string
	 */
	private function getColumnsQuery(){
		switch(true){
			case is_array($this->columns) && !empty($this->columns):
				return implode(',', $this->columns);
			case (is_string($this->columns) || is_numeric($this->columns)) && !empty(trim($this->columns)):
				return $this->columns;
			default:
				return '*';
		}
	}
}