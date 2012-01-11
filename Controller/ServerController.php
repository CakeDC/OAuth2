<?php
require_once(CakePlugin::path('Oauth2') . 'Vendor' . DS . 'oauth2-php' . DS . 'lib' . DS . 'OAuth2.php');
App::uses('OAuth2StorageCake', 'Oauth2.Lib');

class ServerController extends AppController {
/**
 * Name
 *
 * @var string
 */
	public $name = 'Server';

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Storage = new OAuth2StorageCake();
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
	
		$oauth = new OAuth2($this->Storage);

		if ($this->request->is('post')) {
			$userId = 42;
			$oauth->finishClientAuthorization($this->request->data["accept"] == "Yep", $userId, $this->request->data);
		}

		try {
			$authParams = $oauth->getAuthorizeParams();
			$this->set(compact('authParams'));
		} catch (OAuth2ServerException $oauthError) {
			$oauthError->sendHttpResponse();
			$this->_stop();
		}

	}

/**
 * 
 */
	public function token() {
		$oauth = new OAuth2($this->Storage);
		try {
			$oauth->grantAccessToken();
		} catch (OAuth2ServerException $oauthError) {
			$oauthError->sendHttpResponse();
		}
		$this->_stop();
	}

}