<?php


namespace SmartValue\Database\QueryType;


interface QueryTypeInterface {
	
	public function getQuery();
	public function run();
	
}