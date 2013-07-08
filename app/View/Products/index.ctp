<div class="products index well">
	<h2><?php echo __('Products'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-condensed table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($products as $product): ?>
	<tr>
		<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $product['User']['nickname']; ?>
		</td>
		<td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['price']); ?>&nbsp;</td>
		<td><?php echo date('Y-m-d', strtotime($product['Product']['created'])); ?>&nbsp;</td>
	
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id'])); ?>
			<?php

			if ($this->Session->read('Auth.User.id') == $product['Product']['user_id']) {
				echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); 

				echo " | ".$this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id']));
			}		 

			 ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	
	
	<?php echo $this->element('Common/pagination'); ?>
</div>

