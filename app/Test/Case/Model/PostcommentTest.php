<?php
App::uses('Postcomment', 'Model');

/**
 * Postcomment Test Case
 *
 */
class PostcommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.postcomment',
		'app.post',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Postcomment = ClassRegistry::init('Postcomment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Postcomment);

		parent::tearDown();
	}

}
