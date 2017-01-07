<?php
/**
 * NewsTag Fixture
 */
class NewsTagFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'news_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true),
		'tag_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true),
		'count' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'news_id' => 1,
			'tag_id' => 1,
			'count' => 1
		),
	);

}
