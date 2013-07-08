<?php
App::uses('Room', 'Model');

/**
 * Room Test Case
 *
 */
class RoomTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.room',
		'app.user',
		'app.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Room = ClassRegistry::init('Room');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Room);

		parent::tearDown();
	}

}
