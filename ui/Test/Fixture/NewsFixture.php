<?php
/**
 * NewsFixture
 *
 */
class NewsFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'url' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'normalized_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'normalized_crc32' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'source' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false),
		'created_at' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'last_fetch_at' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'last_changed_at' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'error_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
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
			'id' => 1,
			'url' => 'Lorem ipsum dolor sit amet',
			'normalized_id' => 'Lorem ipsum dolor sit amet',
			'normalized_crc32' => 1,
			'source' => 1,
			'created_at' => 1,
			'last_fetch_at' => 1,
			'last_changed_at' => 1,
			'error_count' => 1
		),
	);

}
