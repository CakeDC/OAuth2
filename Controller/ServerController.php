<?php
require_once(CakePlugin::path('Oauth2') . 'Vendor' . DS . 'oauth2-php' . DS . 'lib' . DS . 'OAuth2.php');

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
		if (isset($this->Auth)) {
			$this->Auth->allow('*');
		}
	}

/**
 * 
 */
	public function authorize() {
		$oauth = new OAuth2();
		if ($this->request->is('post') && $this->request->data['Server']['grant'] == 1) {
			unset($this->request->data['Server']['grant']);
			$oauth->finishClientAuthorization(true, $this->request->data);
		}
		$this->set($authParams = $oauth->getAuthorizeParams());
	}

/**
 * 
 */
	public function token() {
		$oauth = new OAuth2();
		$this->set('response', $oauth->grantAccessToken());
	}

}