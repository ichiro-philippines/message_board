<?php
/**
 * User Fixture
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 220, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 220, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 220, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'picture' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 220, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'picture' => 'Lorem ipsum dolor sit amet',
			'created' => '2022-09-28 08:56:58',
			'updated' => '2022-09-28 08:56:58'
		),
	);

}
