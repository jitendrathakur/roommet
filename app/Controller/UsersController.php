<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {



  /**
   * method call before any action.
   *
   * return void
   */
  public function beforeFilter() {
    //parent::beforeFilter();
    // Call to the function to allow actions to non logged in users.
    $this->Auth->allow(
      'login', 
      'signup',
      'logout'
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
	public function index() {
		$this->paginate = array(
	        'conditions' => array('User.room_id' => $this->Auth->user('room_id'))	       
	    );
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}



/**
 * add method
 *
 * @return void
 */
	public function signup() {

		if ($this->Auth->user('id')) {
	  		$this->redirect(array('controller' => 'products', 'action' => 'index'));
	  	}

        $flag = true;
		if ($this->request->is('post')) {

			$result = $this->User->Room->field('id', array('code' => $this->request->data['User']['code']));
			if ($result == false) {
				$this->setFlash(__('The code you inserted was not correct. Please, try again.'), 'error');
			    $flag = false;
			} else {
				$this->request->data['User']['room_id'] = $result;

			}
			
			$this->User->create();			
			if ($flag && $this->User->save($this->request->data)) {
				$this->setFlash(__('The user has been saved', 'success'));
				$this->redirect(array('action' => 'login'));
			} else if($flag) {
				$this->setFlash(__('The user could not be saved. Please, try again.'), 'error');
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
/*	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setFlash(__('The user could not be saved. Please, try again.'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


	  /**
   * login method
   *
   * @return void
   */
  function login() {

  	if ($this->Auth->user('id')) {
  		$this->redirect(array('controller' => 'products', 'action' => 'index'));
  	}
   
    if ($this->request->is('post')) {
      if ($this->Auth->login()) {
        $userId = (int)$this->Auth->user('id');
        // Call to the function to save users login log.
       // $this->User->LoginLog->saveLoginLog($userId);
        // Call to the function to set login flag to true.
       // $this->User->setLoggedIn($userId, true);

       // $groupInfo = $this->getParentGroup($userId);
       /// if (!empty($groupInfo['parent_group'])) {
         // $this->Session->write('Auth.User.userGroup', $groupInfo['parent_group']);
       // }
        //this function returns redirect path by user's role
       // $this->getRedirectPath();
        $this->redirect(array('controller' => 'products', 'action' => 'index'));
      } else {
        $this->setFlash('Your username or password was incorrect.', 'error');
      }
    }
    
  }//end login()


 /**
   * logout method
   *
   * @return void
   */
  function logout() {     
    $this->setFlash(__('Successfully logged out of the system.'), 'success');
    $this->redirect($this->Auth->logout());
  }//end logout()


	/**
	 * add method
	 *
	 * @return void
	 */
	public function get_code() {

       

		$result = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
		
		$this->set('code', $result['Room']['code'])	;
	}

}
