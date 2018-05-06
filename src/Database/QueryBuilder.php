<?php


namespace SmartValue\Database;


use SmartValue\Database\QueryType\DeleteType;
use SmartValue\Database\QueryType\InsertType;
use SmartValue\Database\QueryType\SelectType;
use SmartValue\Database\QueryType\QueryType;

class QueryBuilder {
	
	/**
	 * @var QueryBuilder
	 */
	private static $instance;
	
	/**
	 * @param $query
	 *
	 * @return QueryType
	 */
	public function query($query) {
		return new QueryType($query);
	}
	
	/**
	 * @param array|string $columns
	 *
	 * @return SelectType
	 */
	public function select($columns) {
		return new SelectType( $columns);
	}
	
	/**
	 * @return InsertType
	 */
	public function insert(){
		return new InsertType();
	}
	
	/**
	 * @return DeleteType
	 */
	public function delete() {
		return new DeleteType();
	}
	
	/**
	 * @return QueryBuilder
	 */
	public static function getInstance() {
		return self::$instance === null
			? new static()
			: self::$instance;
	}
	
}