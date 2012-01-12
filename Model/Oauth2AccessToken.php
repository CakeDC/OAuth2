<?php
App::uses('Oauth2AppModel', 'Oauth2.Model');

class Oauth2AccessToken extends Oauth2AppModel {
/**
 * Name
 *
 * @var string
 */
	public $name = 'Oauth2AccessToken';

/**
 * Primary key
 *
 * @var string
 */
	public $primaryKey = 'oauth_token';
 	
}