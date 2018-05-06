<?php


namespace SmartValue\Database\QueryType;


use SmartValue\Database\MySQLConnection;
use SmartValue\Database\Traits\FromTrait;
use SmartValue\Database\Traits\LimitTrait;
use SmartValue\Database\Traits\WhereTrait;

class DeleteType implements QueryTypeInterface {
	
	use FromTrait, WhereTrait, LimitTrait;
	
	/**
	 * @return string
	 */
	public function getQuery(){
		
		$query = 'DELETE ';
		$query .= $this->getFromQuery();
		$query .= $this->getWhereQuery();
		$query .= $this->getLimitQuery();
		
		return $query;
	}
	
	public function run(){
		MySQLConnection::getConnection()->query($this->getQuery());
	}
}