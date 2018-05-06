<?php


namespace SmartValue\JsonRPC\Server;


use SmartValue\Database\MySQLWrapperException;
use SmartValue\Database\QueryBuilder;

class CountriesApi {
	
	/**
	 * @param string $code
	 *
	 * @return array
	 * @throws MySQLWrapperException
	 */
	public function getCountriesInfoByCode($code = ''){
		
		return QueryBuilder::getInstance()
			->select(['id', 'name', 'prefix'])
			->from('locations_countries')
			->where('code = "' . $code . '"')
			->limit(1)
			->run();
	}
	
}