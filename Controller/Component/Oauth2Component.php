<?php
App::uses('Component', 'Controller');

class Oauth2Component extends Component {

/**
 * Oauth2
 *
 * @var OAuth2 Object
 */
	public $Oauth2 = null;

/**
 * Constructor
 *
 * @param Component Collection
 * @param array $settings
 * @return void
 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings); 

		$defaults = array(
			'storage' => 'OAuth2StorageCake');

		$this->settings = Set::merge($defaults, $settings);
		$this->libPath = CakePlugin::path('Oauth2') . 'Vendor' . DS .  'oauth2-php' . DS . 'lib'. DS;
		$this->__loadLibs();
		$this->Oauth2 = $this->getOauthInstance();
	}

/**
 * Proxy for the oauth2 lib methods
 *
 * @param string $name
 * @param array $arguments
 * @return mixed
 */
	public function __call($name, $arguments) {
		$this->getOauthInstance();
		if (isset($this->Oauth2) && method_exists($this->Oauth2, $name)) {
			return call_user_func_array(array($this->Oauth2, $name), $arguments);
		}
	}

/**
 * Initialize
 *
 * @param Controller
 * @return void
 */
	public function initialize(Controller $Controller) {
		$this->Oauth2 = $this->getOauthInstance();
	}

/**
 * Creates a new Oauth2 lib instance with the configured storage adapter
 *
 * @return Oauth instance
 */
	public function getOauthInstance() {
		if ($this->settings['storage'] == 'OAuth2StorageCake') {
			App::uses('OAuth2StorageCake', 'Oauth2.Lib');
		}
		$this->Storage = new $this->settings['storage'];
		$this->Oauth2 = new OAuth2($this->Storage);
	}

/**
 * Loads all required libs
 *
 * @return void
 */
	protected function __loadLibs() {
		require_once($this->libPath . 'Oauth2.php');
		require_once($this->libPath . 'IOAuth2Storage.php');
		require_once($this->libPath . 'IOAuth2GrantCode.php');
		require_once($this->libPath . 'IOAuth2GrantClient.php');
		require_once($this->libPath . 'IOAuth2GrantImplicit.php');
		require_once($this->libPath . 'IOAuth2RefreshTokens.php');
		require_once($this->libPath . 'OAuth2Exception.php');
		require_once($this->libPath . 'OAuth2RedirectException.php');
		require_once($this->libPath . 'OAuth2ServerException.php');
	}

}