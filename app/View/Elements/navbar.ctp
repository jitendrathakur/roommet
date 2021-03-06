<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
            <?php
                $title = isset($roomName) ? 'Room Mate: '.$roomName : 'Room Mate';
                
                echo $this->Html->link(__($title), Router::url('/', true), array('class' => 'brand'));

               
                $options = array(
                    array(
                        'title' => 'Products',
                        'dropdown' => array(
                            array(
                                'title' => 'List',
                                'url'     => array('controller' => 'products', 'action' => 'index') 
                            ),
                            array(
                                'title'   => 'Add',
                                'url'     => array('controller' => 'products', 'action' => 'add'),
                            ),
                            array(
                                'title'   => 'Total By date',
                                'url'     => array('controller' => 'products', 'action' => 'total_by_date'),
                            ),
                        )
                    ),
                    array(
                        'title' => 'Member',
                        'dropdown' => array(
                            array(
                                'title' => 'List',
                                'url'     => array('controller' => 'users', 'action' => 'index') 
                            )                            
                        )
                    )

                );
             
            $username = $this->Session->read("Auth.User.nickname"); 
            
            //$uiName = ($username != ' ') ? $username : 'User';           
            $logOutMenu = array(
                array(
                    'title'    => $username,
                    'dropdown' => array(
                        array(
                            'title' => 'Get Code',
                            'url'     => array('controller' => 'users', 'action' => 'get_code') 
                        ),
                        array(
                            'title' => 'Log Out',
                            'url'   => array('controller' => 'users', 'action' =>'logout'),
                        )                              
                    )
                    
                  
                ),               
            );


            $logInMenu = array(
                array(
                        'title'    => 'Login',
                        'url'   => array('controller' => 'users', 'action' =>'login'),
                    ),
                array(
                    'title' => 'Signup',
                    'url'   => array('controller' => 'users', 'action' =>'signup'),
                ),
                array(
                    'title' => 'Create New Room',
                    'url'   => array('controller' => 'rooms', 'action' =>'add'),
                ),
            );



            ?>
          
            <?php if($this->Session->read('Auth.User.id')): ?>
                <?php echo $this->element('bootstrap_menu', array('menu' => $logOutMenu, 'secondary' => true)); ?>
                <?php echo $this->element('bootstrap_menu', array('menu' => $options, 'secondary' => true)); ?>
            <?php else: ?>
                <?php echo $this->element('bootstrap_menu', array('menu' => $logInMenu, 'secondary' => true)); ?>
            <?php endif; ?>    
        </div>
    </div>
</div>
