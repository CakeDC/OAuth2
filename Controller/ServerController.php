<?php
App::uses('Oauth2AppController', 'Oauth2.Controller');

class ServerController extends Oauth2AppController {
/**
 * Name
 *
 * @var string
 */
	public $name = 'Server';

/**
 * Components
 *
 * @var array
 */
	public $components = array('Oauth2.Oauth2');

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		if (isset($this->Auth)) {
			$this->Auth->allow('*');
		}
	}

/**
 * 
 */
	public function authorize() {
		// Clickjacking prevention (supported by IE8+, FF3.6.9+, Opera10.5+, Safari4+, Chrome 4.1.249.1042+)
		header('X-Frame-Options: DENY');

		if ($this->request->is('post')) {
			$userId = 42;
			//$this->Oauth2->finishClientAuthorization($this->request->data["accept"] == "Yep", $userId, $this->request->data);
		}

		try {
			$authParams = $this->Oauth2->getAuthorizeParams();
			$this->set('authParams', $authParams);
		} catch (OAuth2ServerException $oauthError) {
			$oauthError->sendHttpResponse();
			$this->_stop();
		}

	}

/**
 * 
 */
	public function token() {
		try {
			$this->Oauth2->grantAccessToken();
		} catch (OAuth2ServerException $oauthError) {
			$oauthError->sendHttpResponse();
		}
		$this->_stop();
	}

}