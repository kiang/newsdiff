<?php
App::uses('NewsTag', 'Model');

/**
 * NewsTag Test Case
 */
class NewsTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.news_tag',
		'app.news',
		'app.news_info',
		'app.news_raw',
		'app.tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NewsTag = ClassRegistry::init('NewsTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NewsTag);

		parent::tearDown();
	}

}
