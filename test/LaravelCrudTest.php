<?php

use Mockery as m;

class LaravelCrudTest extends PHPUnit_Framework_TestCase {

	public function tearDown()
	{
		m::close();
	}


	public function testCrudCreation()
	{
		$modelName = "Post";

		$Crud = m::mock('Codeklopper\LaravelCrud\LaravelCrud');

		$Crud->init($modelName);

		$this->assertEquals('Post', $Crud->model);

	}
}