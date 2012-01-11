<?php
App::uses('Oauth2AppModel', 'Oauth2.Model');

class Oauth2Client extends Oauth2AppModel {
/**
 * Name
 *
 * @var string
 */
	public $name = 'Oauth2Client';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'client_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Client Id can not be empty')),
		'secret' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Secret can not be empty')),
		'redirect_uri' => array(
			'notEmpty' => array(
				'rule' => 'url',
				'message' => 'The uri is invalid')));

/**
 * Add a client
 *
 * @param array
 * @return mixed
 */
	public function add($data) {
		if (!empty($data)) {
			$this->create();
			$result = $this->save($data);
			if ($result) {
				return true;
			}
		}
	}

}