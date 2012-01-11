<?php
/* Oauth2AccessToken Fixture generated on: 2012-01-11 15:56:56 : 1326293816 */

/**
 * Oauth2AccessTokenFixture
 *
 */
class Oauth2AccessTokenFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'oauth_token' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'client_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'user_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'expires' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'scope' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'oauth_token', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'oauth_token' => 'Lorem ipsum dolor sit amet',
			'client_id' => 'Lorem ipsum dolor sit amet',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'expires' => 1,
			'scope' => 'Lorem ipsum dolor sit amet'
		),
		array(
			'oauth_token' => 'Lorem ipsum dolor sit amet',
			'client_id' => 'Lorem ipsum dolor sit amet',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'expires' => 2,
			'scope' => 'Lorem ipsum dolor sit amet'
		),
		array(
			'oauth_token' => 'Lorem ipsum dolor sit amet',
			'client_id' => 'Lorem ipsum dolor sit amet',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'expires' => 3,
			'scope' => 'Lorem ipsum dolor sit amet'
		),
		array(
			'oauth_token' => 'Lorem ipsum dolor sit amet',
			'client_id' => 'Lorem ipsum dolor sit amet',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'expires' => 4,
			'scope' => 'Lorem ipsum dolor sit amet'
		),
		array(
			'oauth_token' => 'Lorem ipsum dolor sit amet',
			'client_id' => 'Lorem ipsum dolor sit amet',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'expires' => 5,
			'scope' => 'Lorem ipsum dolor sit amet'
		),
		array(
			'oauth_token' => 'Lorem ipsum dolor sit amet',
			'client_id' => 'Lorem ipsum dolor sit amet',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'expires' => 6,
			'scope' => 'Lorem ipsum dolor sit amet'
		),
		array(
			'oauth_token' => 'Lorem ipsum dolor sit amet',
			'client_id' => 'Lorem ipsum dolor sit amet',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'expires' => 7,
			'scope' => 'Lorem ipsum dolor sit amet'
		),
		array(
			'oauth_token' => 'Lorem ipsum dolor sit amet',
			'client_id' => 'Lorem ipsum dolor sit amet',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'expires' => 8,
			'scope' => 'Lorem ipsum dolor sit amet'
		),
		array(
			'oauth_token' => 'Lorem ipsum dolor sit amet',
			'client_id' => 'Lorem ipsum dolor sit amet',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'expires' => 9,
			'scope' => 'Lorem ipsum dolor sit amet'
		),
		array(
			'oauth_token' => 'Lorem ipsum dolor sit amet',
			'client_id' => 'Lorem ipsum dolor sit amet',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'expires' => 10,
			'scope' => 'Lorem ipsum dolor sit amet'
		),
	);
}
