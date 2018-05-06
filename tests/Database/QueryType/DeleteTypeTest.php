<?php

namespace SmartValue\Tests\Database\QueryType;

use SmartValue\Database\QueryType\DeleteType;
use SmartValue\Tests\DatabaseTestCase;

class DeleteTypeTest extends DatabaseTestCase {
	
	/**
	 * @var DeleteType
	 */
	private $deleteTypeObject;
	
	public function setUp() {
		parent::setUp();
		
		$this->deleteTypeObject = new DeleteType();
		$this->deleteTypeObject->setDatabaseConnection($this->getConnection());
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testQetQueryWithAllParams(){
		$response = $this->deleteTypeObject
			->from('locations_history')
			->where('id > 5')
			->limit(1)
			->getQuery();
		
		$this->assertEquals( 'DELETE  FROM locations_history WHERE id > 5 LIMIT 1', $response);
	}
	
	/**
	 * @throws \SmartValue\Database\MySQLWrapperException
	 */
	public function testRun(){
		$response = $this->deleteTypeObject
			->from('locations_countries')
			->where('id > 1')
			->limit(1)
			->run();
		
		$this->assertEquals( 1, $response);
	}
}