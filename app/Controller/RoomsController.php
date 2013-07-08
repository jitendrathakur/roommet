<?php
App::uses('AppController', 'Controller');
/**
 * Rooms Controller
 *
 * @property Room $Room
 */
class RoomsController extends AppController {


	  /**
   * method call before any action.
   *
   * return void
   */
  public function beforeFilter() {
    //parent::beforeFilter();
    // Call to the function to allow actions to non logged in users.
    $this->Auth->allow(
      'add', 
      'index'     
      /*'forgot_password', 
      'reset_password',
      'packager_account',
      'make_payment',
      'subscribe_package'*/
    );

    if ($this->Auth->user('id')) {
    	$this->Auth->allow('*');

    }

  }//end beforeFilter()

/**
 * index method
 *
 * @return void
 */
	public function index($code = null) {		
		$this->set('code', $code);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function view($id = null) {
		if (!$this->Room->exists($id)) {
			throw new NotFoundException(__('Invalid room'));
		}
		$options = array('conditions' => array('Room.' . $this->Room->primaryKey => $id));
		$this->set('room', $this->Room->find('first', $options));
	}*/

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->Auth->user('id')) {
	  		$this->redirect(array('controller' => 'products', 'action' => 'index'));
	  	}
		if ($this->request->is('post')) {
			$this->Room->create();

			$code = randomChars(8);

			$this->request->data['Room']['code'] = $code;
			if ($this->Room->save($this->request->data)) {
				$this->setFlash(__('Your room has been successfully created'), 'success');
				$this->redirect(array('action' => 'index', $code));
			} else {
				$this->setFlash(__('The room could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function edit($id = null) {
		if (!$this->Room->exists($id)) {
			throw new NotFoundException(__('Invalid room'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Room->save($this->request->data)) {
				$this->setFlash(__('The room has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setFlash(__('The room could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Room.' . $this->Room->primaryKey => $id));
			$this->request->data = $this->Room->find('first', $options);
		}
	}*/

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Room->id = $id;
		if (!$this->Room->exists()) {
			throw new NotFoundException(__('Invalid room'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Room->delete()) {
			$this->setFlash(__('Room deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->setFlash(__('Room was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Room->recursive = 0;
		$this->set('rooms', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Room->exists($id)) {
			throw new NotFoundException(__('Invalid room'));
		}
		$options = array('conditions' => array('Room.' . $this->Room->primaryKey => $id));
		$this->set('room', $this->Room->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Room->create();
			if ($this->Room->save($this->request->data)) {
				$this->setFlash(__('The room has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setFlash(__('The room could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Room->exists($id)) {
			throw new NotFoundException(__('Invalid room'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Room->save($this->request->data)) {
				$this->setFlash(__('The room has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setFlash(__('The room could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Room.' . $this->Room->primaryKey => $id));
			$this->request->data = $this->Room->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Room->id = $id;
		if (!$this->Room->exists()) {
			throw new NotFoundException(__('Invalid room'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Room->delete()) {
			$this->setFlash(__('Room deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->setFlash(__('Room was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
