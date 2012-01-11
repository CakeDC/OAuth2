<?php
$basePath = CakePlugin::path('Oauth2') . 'Vendor' . DS .  'oauth2-php' . DS . 'lib'. DS;
require_once($basePath . 'Oauth2.php');
require_once($basePath . 'IOAuth2Storage.php');
require_once($basePath . 'IOAuth2GrantCode.php');
require_once($basePath . 'IOAuth2RefreshTokens.php');

/**
 * CakePHP DBAL storage engine for the OAuth2 Library.
 */
class OAuth2StorageCake implements IOAuth2GrantCode, IOAuth2RefreshTokens {

/**
 * Implements OAuth2::__construct().
 */
	public function __construct($options = array()) {
		$defaults = array(
			'models' => array(
				'AuthCode' => 'Oauth2.Oauth2AuthToken',
				'Client' => 'Oauth2.Oauth2Client',
				'Token' => 'Oauth2.Oauth2AccessToken',
				'RefreshToken' => 'Oauth2.Oauth2RefreshToken'));

		$this->options = Set::merge($defaults, $options);

		$this->salt = Configure::read('Oauth2.Salt');
	}

/**
 * Loads the required models on the fly
 */
	public function __get($name) {
		if (in_array($name, array_keys($this->options['models']))) {
			return ClassRegistry::init($this->options['models'][$name]);
		}
	}

/**
 * Handle PDO exceptional cases.
 */
	private function handleException($e) {
		echo 'Database error: '. $e->getMessage();
		exit;
	}

/**
 * Little helper function to add a new client to the database.
 *
 * Do NOT use this in production! This sample code stores the secret
 * in plaintext!
 *
 * @param $client_id
 *   Client identifier to be stored.
 * @param $client_secret
 *   Client secret to be stored.
 * @param $redirect_uri
 *   Redirect URI to be stored.
 */
	public function addClient($client_id, $client_secret, $redirect_uri) {
		$this->Client->save(array(
			$this->Client->alias => array(
				'id' => $client_id,
				'client_secret' > $client_secret,
				'redirect_uri' => $redirect_uri)));
	}

/**
 * Implements IOAuth2Storage::checkClientCredentials().
 *
 */
	public function checkClientCredentials($client_id, $client_secret = NULL) {
		$result = $this->Client->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$this->Client->alias . '.id' => $client_id),
			'fields' => array($this->Client->alias . '.secret')));

		if (empty($result)) {
			return false;
		}

		return $this->checkPassword($result[$this->Client->alias]['secret'], $client_secret, $client_id);
	}

/**
 * Implements IOAuth2Storage::getRedirectUri().
 */
	public function getClientDetails($client_id) {
		$result = $this->Client->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$this->Client->alias . '.id' => $client_id),
			'fields' => array($this->Client->alias . '.redirect_uri')));

		if (empty($result)) {
			return false;
		}

		return $result[$this->Client->alias]['redirect_uri'];
	}

/**
 * Implements IOAuth2Storage::getAccessToken().
 */
	public function getAccessToken($oauth_token) {
		return $this->getToken($oauth_token, FALSE);
	}

/**
 * Implements IOAuth2Storage::setAccessToken().
 */
	public function setAccessToken($oauth_token, $client_id, $user_id, $expires, $scope = NULL) {
		$this->setToken($oauth_token, $client_id, $user_id, $expires, $scope, FALSE);
	}

/**
 * @see IOAuth2Storage::getRefreshToken()
 */
	public function getRefreshToken($refresh_token) {
		return $this->getToken($refresh_token, TRUE);
	}

/**
 * @see IOAuth2Storage::setRefreshToken()
 */
	public function setRefreshToken($refresh_token, $client_id, $user_id, $expires, $scope = NULL) {
		return $this->setToken($refresh_token, $client_id, $user_id, $expires, $scope, TRUE);
	}

/**
 * @see IOAuth2Storage::unsetRefreshToken()
 */
	public function unsetRefreshToken($refresh_token) {
		$this->Token->deleteAll(array(
			$this->Token->alias . '.refresh_token' => $refresh_token));
	}

	/**
	 * Implements IOAuth2Storage::getAuthCode().
	 */
	public function getAuthCode($code) {
		$result = $this->AuthCode->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$this->AuthCode->alias . '.code' => $code)));

		if (empty($result)) {
			return null;
		}
		return $result[$this->AuthCode->alias];
	}

/**
 * Implements IOAuth2Storage::setAuthCode().
 */
	public function setAuthCode($code, $client_id, $user_id, $redirect_uri, $expires, $scope = NULL) {
		$this->AuthCode->save(array(
			$this->AuthCode->alias => compact('code', 'client_id', 'user_id', 'redirect_uri', 'expires', 'scope')));
	}

/**
 * @see IOAuth2Storage::checkRestrictedGrantType()
 */
	public function checkRestrictedGrantType($client_id, $grant_type) {
		return TRUE; // Not implemented
	}

/**
 * Creates a refresh or access token
 *
 * @param string $token - Access or refresh token id
 * @param string $client_id
 * @param mixed $user_id
 * @param int $expires
 * @param string $scope
 * @param bool $isRefresh
 */
	protected function setToken($token, $client_id, $user_id, $expires, $scope, $isRefresh = TRUE) {
		$model = 'Token';
		if ($isRefresh == true) {
			$model = 'RefreshToken';
		}

		$this->{$model}->save(array(
			$this->{$model}->alias => compact('token', 'client_id', 'user_id', 'expires',
				'scope')));
	}

/**
 * Retreives an access or refresh token.
 *
 * @param string $token
 * @param bool $refresh
 */
	protected function getToken($token, $isRefresh = true) {
		$model = $isRefresh ? 'RefreshToken' : 'Token';
		$tokenName = $isRefresh ? 'refresh_token' : 'oauth_token';

		$result = $this->{$model}->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$this->{$model}->alias . '.' . $tokenName => $token)));

		if (empty($result)) {
			return null;
		}
		return $result[$this->AuthCode->alias];
	}

	/**
	 * Change/override this to whatever your own password hashing method is.
	 *
	 * @param string $secret
	 * @return string
	 */
	protected function hash($client_secret, $client_id) {
		return hash('sha256', $client_id . $client_secret . self::salt);
	}

/**
 * Checks the password.
 * Override this if you need to
 *
 * @param string $client_id
 * @param string $client_secret
 * @param string $actualPassword
 */
	protected function checkPassword($try, $client_secret, $client_id) {
		return $try == $this->hash($client_secret, $client_id);
	 }
}
