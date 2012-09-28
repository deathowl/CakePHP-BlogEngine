<?php
App::uses('PostRating', 'Model');

/**
 * PostRating Test Case
 *
 */
class PostRatingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post_rating',
		'app.user',
		'app.post'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PostRating = ClassRegistry::init('PostRating');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PostRating);

		parent::tearDown();
	}

}
