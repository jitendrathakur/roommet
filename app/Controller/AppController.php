<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	 /**
   * Array to hold component.
   *
   * @var void
   */
  public $components = array(     
    'Acl',
    'Auth' => array(
      'loginAction' => array(
        'controller' => 'users',
        'action'     => 'login',
       // 'admin'      => false,
       // 'teacher'    => false,
        //'student'    => false,
      ),        
      'authenticate' => array(
        'Form' => array(
          'fields' => array(
            //'username' => 'email'
          )
        )
      ),
     // 'authorize' => 'Controller',
    ),
    'Session'
  );


    /**
   * Array to hold helper.
   *
   * @var void
   */
  public $helpers = array(
                     'Html',
                     'Form',
                     'Session',                    
                    );

    /**
   * Function to set the message in session
   *
   * This function uses Session components setFlash message
   *
   * @param string $message Message to be flashed
   * @param string $class   Message class, default is 'success'
   *
   * @return void
   */
  protected function setFlash($message, $class = 'success')
  {
    $option = array('class' => 'alert alert-' . $class);
    $this->Session->setFlash($message, 'Common/flash-message', $option);
  }//end setFlash()


  public function beforeRender() {
    $this->set(
        'twitterBootstrapCreateOptions', 
        array(
         'class'         => 'form-horizontal well',
         'inputDefaults' => array(
                             'div'     => array('class' => 'control-group'),
                             'label'   => array('class' => 'control-label'),
                             'error'   => array('attributes' => array(
                                                                 'wrap' => 'span',
                                                                 'class' => 'help-inline',
                                                                )
                                          ),
                             'between' => '<div class="controls">',
                             'after'   => '</div>',
                             'format'  => array('before', 'label', 'between', 'input', 'error', 'after')
                            ),
        )
    );
    $this->set(
        'twitterBootstrapEndOptions',
        array(
            'label' => __('Submit'),
            'class' => 'btn btn-primary',
            'div'   => array('class' => 'form-actions'),
        )
    );
    if ($this->Auth->user('id')) {
      $users = ClassRegistry::init('User')->find('first', array('conditions' => array('User.id' => $this->Auth->user('id') )));
      $this->set('roomName', $users['Room']['name']);

    }
   
  }



}
