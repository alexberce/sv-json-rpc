<?php


namespace SmartValue\Database\QueryType;


use SmartValue\Database\MySQLConnection;
use SmartValue\Database\MySQLWrapperException;
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
	
	/**
	 * @return int
	 *
	 * @throws MySQLWrapperException
	 */
	public function run(){
		return MySQLConnection::getConnection()->query($this->getQuery())->rowCount();
	}
}