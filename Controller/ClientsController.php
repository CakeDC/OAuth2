<?php
App::uses('Oauth2AppController', 'Oauth2.Controller');

class ClientsController extends Oauth2AppController {
/**
 * Name
 *
 * @var string
 */
	public $name = 'Clients';

/**
 * Models
 *
 * @var array
 */
	public $uses = array('Oauth2.Oauth2Client');

/**
 * Index
 *
 * @return void
 */
	public function admin_index() {
		$this->set('clients', $this->paginate());
	}

/**
 * Admin add
 *
 * @return void
 */
	public function admin_add() {
		try {
			if ($this->Oauth2Client->add($this->request->data)) {
				$this->redirect(array('action' => 'index'));
			}
		} catch(Exception $e) {
			$this->Session->setFlash($e->getMessage());
		}
	}

/**
 * Adds a new client
 *
 * @return void
 */
	public function add() {
		try {
			if ($this->Oauth2Client->add($this->request->data)) {
				$this->redirect(array('action' => 'index'));
			}
		} catch(Exception $e) {
			$this->Session->setFlash($e->getMessage());
		}
	}

}