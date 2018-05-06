<?php

namespace SmartValue\Tests\Database\QueryType;

use SmartValue\Database\QueryType\SelectType;
use SmartValue\Tests\DatabaseTestCase;

class SelectTypeTest extends DatabaseTestCase {
	
	/**
	 * @var SelectType
	 */
	private $selectTypeObject;
	
	public function setUp() {
		parent::setUp();
		
		$this->selectTypeObject = new SelectType(['id', 'name', 'country']);
		$this->selectTypeObject->setDatabaseConnection($this->getConnection());
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 * @expectedException \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithEmptyTableName(){
		$this->selectTypeObject->getQuery();
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithoutColumns(){
		$this->selectTypeObject = new SelectType([]);
		
		$response = $this->selectTypeObject->from('locations_countries')->getQuery();
		
		$this->assertEquals(
			"SELECT * FROM locations_countries",
			$response
		);
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithColumnsAsArray(){
		$response = $this->selectTypeObject->from('locations_countries')->getQuery();
		
		$this->assertEquals(
			"SELECT id,name,country FROM locations_countries",
			$response
		);
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithColumnsAsString(){
		$this->selectTypeObject = new SelectType('id, name, country as tara');
		
		$response = $this->selectTypeObject->from('locations_countries')->getQuery();
		
		$this->assertEquals(
			"SELECT id, name, country as tara FROM locations_countries",
			$response
		);
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithOrderByAndDefaultOrder(){
		$response = $this->selectTypeObject
			->from('locations_countries')
			->orderBy('id')
			->getQuery();
		
		$this->assertEquals(
			"SELECT id,name,country FROM locations_countries ORDER BY id",
			$response
		);
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithOrderByAndOrder(){
		$response = $this->selectTypeObject
			->from('locations_countries')
			->orderBy('id', 'DESC')
			->getQuery();
		
		$this->assertEquals(
			"SELECT id,name,country FROM locations_countries ORDER BY id DESC",
			$response
		);
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithGroupBy(){
		$response = $this->selectTypeObject
			->from('locations_countries')
			->groupBy('name')
			->getQuery();
		
		$this->assertEquals(
			"SELECT id,name,country FROM locations_countries GROUP BY name",
			$response
		);
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 * @expectedException \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithInvalidGroupBy(){
		$this->selectTypeObject
			->from('locations_countries')
			->groupBy([])
			->getQuery();
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithLowerLimit(){
		$response = $this->selectTypeObject
			->from('locations_countries')
			->limit(10)
			->getQuery();
		
		$this->assertEquals(
			"SELECT id,name,country FROM locations_countries LIMIT 10",
			$response
		);
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithBothLimits(){
		$response = $this->selectTypeObject
			->from('locations_countries')
			->limit(0, 100)
			->getQuery();
		
		$this->assertEquals(
			"SELECT id,name,country FROM locations_countries LIMIT 0, 100",
			$response
		);
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 * @expectedException \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithInvalidLowerLimits(){
		$this->selectTypeObject
			->from('locations_countries')
			->limit([])
			->getQuery();
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 * @expectedException \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithInvalidUpperLimits(){
		$this->selectTypeObject
			->from('locations_countries')
			->limit(10, "LIMIT")
			->getQuery();
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testGetQueryWithAllMethods(){
		$response = $this->selectTypeObject
			->from('locations_countries')
			->where('code="RO"')
			->orderBy('name', 'DESC')
			->orderBy('prefix')
			->groupBy('name')
			->limit(1)
			->getQuery();
		
		$this->assertEquals(
			"SELECT id,name,country FROM locations_countries WHERE code=\"RO\" GROUP BY name ORDER BY name DESC,prefix LIMIT 1",
			$response
		);
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testRun(){
		
		$this->selectTypeObject = new SelectType(['id', 'code', 'prefix']);
		
		$expectedArray = [
			[
				'id'     => 1,
				'code'   => 'RO',
				'prefix' => '+40',
			],
		];
		
		$response = $this->selectTypeObject
			->from('locations_countries')
			->where('code="RO"')
			->limit(1)
			->run();
		
		$this->assertEquals( $expectedArray, $response);
	}
	
}