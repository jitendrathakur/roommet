<?php
/**
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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', '');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('bootstrap.min', 'bootstrap-responsive.min', 'jquery.ui.1.8.16.ie', 'jquery-ui-1.8.16.custom', 'custom'));
		echo $this->Html->script(array('jquery-1.7.1.min', 'jquery-ui-1.8.20.custom.min', 'bootstrap.min', 'custom')); ?>
		
		<?php

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?php echo $this->Element('navbar'); ?>
	<div id="container" class="container">	

		<div class="row">
            <div class="span12">
		
				
				
					<?php echo $this->Session->flash(); ?>

					<?php echo $this->fetch('content'); ?>
		
		    </div>           
        </div>
        <div id="footer">
        	<?php echo $this->Element('footer'); ?>	
			
			
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
