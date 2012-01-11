<?php
class OauthMigration001 extends CakeMigration {
/**
 * Dependency array. Define what minimum version required for other part of db schema
 *
 * Migration defined like 'app.31' or 'plugin.PluginName.12'
 * 
 * @var array $dependendOf
 * @access public
 */
	public $dependendOf = array();
/**
 * Migration array
 * 
 * @var array $migration
 * @access public
 */ 
	var $migration = array(
		'up' => array(
			'create_table' => array(
				'oauth2_auth_codes' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'lenght' => 40),
					'oauth2_client_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'lenght' => 20),
					'redirect_uri' => array('type'=>'string', 'null' => false, 'default' => NULL, 'lenght' => 200),
					'expires' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11),
					'scope' => array('type'=>'string', 'null' => true, 'default' => NULL, 'lenght' => 200),
					'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
				),
				'oauth2_clients' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'lenght' => 20),
					'secret' => array('type'=>'string', 'null' => false, 'default' => NULL, 'lenght' => 20),
					'redirect_uri' => array('type'=>'string', 'null' => false, 'default' => NULL, 'lenght' => 200),
					'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
				),
				'oauth2_access_tokens' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'lenght' => 40),
					'oauth2_client_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'lenght' => 20),
					'user_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
					'expires' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11),
					'scope' => array('type'=>'string', 'null' => true, 'default' => NULL, 'lenght' => 200),
					'indexes' => array('PRIMARY' => array('column' => 'id',  'unique' => 1)),
				),
				'oauth2_refresh_tokens' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'lenght' => 40),
					'oauth2_client_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'lenght' => 20),
					'user_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 36),
					'expires' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11),
					'scope' => array('type'=>'string', 'null' => true, 'default' => NULL, 'lenght' => 200),
					'indexes' => array('PRIMARY' => array('column' => 'id',  'unique' => 1)),
				),
			)
		),
		'down' => array(
			'drop_table' => array('oauth2_auth_codes', 'oauth2_clients', 'oauth2_access_tokens', 'oauth2_refresh_tokens')
		)
	);
/**
 * before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @access public
 */
	function before($direction) {
		return true;
	}
/**
 * after migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @access public
 */
	function after($direction) {
		return true;
	}
	
	
}