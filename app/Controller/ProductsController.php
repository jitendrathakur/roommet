<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 */
class ProductsController extends AppController {


	  /**
   * method call before any action.
   *
   * return void
   */
  public function beforeFilter() {
    //parent::beforeFilter();
    // Call to the function to allow actions to non logged in users.  
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
	        'conditions' => array('Product.room_id' => $this->Auth->user('room_id'))	       
	    ); 
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->Product->create();
			$this->request->data['Product']['user_id'] = $this->Auth->user('id');
			$this->request->data['Product']['room_id'] = $this->Auth->user('room_id');
			
			if ($this->Product->save($this->request->data)) {
				$this->setFlash(__('The product has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setFlash(__('The product could not be saved. Please, try again.'), 'failure');
			}
		}
		$users = $this->Product->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Product']['user_id'] = $this->Auth->user('id');
			if ($this->Product->save($this->request->data)) {
				$this->setFlash(__('The product has been saved'), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setFlash(__('The product could not be saved. Please, try again.'), 'failure');
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
	
		if ($this->Session->read('Auth.User.id') != $this->request->data['Product']['user_id']) {
			throw new MethodNotAllowedException();
		}
		$users = $this->Product->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Product->delete()) {
			$this->setFlash(__('Product deleted'));
			$this->redirect(array('action' => 'index'));
		}

		$this->setFlash(__('Product was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->setFlash(__('The product has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
		$users = $this->Product->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Product->save($this->request->data)) {
				$this->setFlash(__('The product has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$users = $this->Product->User->find('list');
		$this->set(compact('users'));
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
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Product->delete()) {
			$this->setFlash(__('Product deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->setFlash(__('Product was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	function total_by_date() {

		$users = $this->Product->User->find('list', array('fields' => array('nickname')));
		
		if ($this->request->is('post') || $this->request->is('put')) {
			       
			$conditions = array('Product.created BETWEEN ? AND ?' => 
				array(
					$this->request->data['Product']['start_date'],
					$this->request->data['Product']['end_date']
				),
				'Product.room_id' => $this->Auth->user('room_id')
			);

			if (!empty($this->request->data['Product']['user_id'])) {

				$conditions = array('Product.created BETWEEN ? AND ?' => 
					array(
						$this->request->data['Product']['start_date'],
						$this->request->data['Product']['end_date']
					),
					'Product.room_id' => $this->Auth->user('room_id'),
					'user_id' => $this->request->data['Product']['user_id']

				);

			}

			$result = $this->Product->find('list', 
				array(
					'fields' => array('Product.price'),
					'conditions' => $conditions
				)
			);	

			$data = $this->Product->find('all', 
				array(
					//'fields' => array('Product.price'),
					'conditions' => $conditions,
					'order' => 'user_id'
				)

			);	

			$total = $this->Product->find('all', 
				array(
					'fields' => array('User.nickname', 'sum(Product.price) as total'),
					'conditions' => $conditions,
					'order' => 'user_id',
					'group' => 'user_id'
					)

				);		
			
		 
			$totalAmount = array_sum($result);		
		    

		}
		
		$this->set(compact('users', 'totalAmount', 'data', 'total'));

	}
}
