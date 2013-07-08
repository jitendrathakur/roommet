<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table class="table table-striped table-condensed table-bordered">
	<tr>
		
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('nickname'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['nickname']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php echo $this->element('Common/pagination'); ?>
</div>

