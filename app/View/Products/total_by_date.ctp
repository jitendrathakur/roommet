<div class="products form">
<?php

if (isset($totalAmount)) {
	if (!empty($totalAmount)) {
		echo "<pre><h2>Total amount is : $totalAmount</h2></pre>";
	} else {
		echo "<pre>No Record found for this time duration.</pre>";
	}
}


echo $this->Form->create('Product', $twitterBootstrapCreateOptions);

echo $this->Form->input('start_date');

echo $this->Form->input('end_date');

echo $this->Form->input('user_id', array('empty' => 'select any')); 



echo $this->Form->end($twitterBootstrapEndOptions);

?>

</div>

<?php if (!empty($data)) : ?>
<pre><h3><?php echo "Member statistics by the date between " .$this->request->data['Product']['start_date']. " to ". $this->request->data['Product']['end_date']  ?></h3></pre>

<table cellpadding="0" cellspacing="0" class="table table-striped table-condensed table-bordered">
	<tr>
			<th><?php echo 'id'; ?></th>
			<th><?php echo 'user'; ?></th>
			<th><?php echo 'name'; ?></th>
			<th><?php echo 'price'; ?></th>
			<th><?php echo 'created'; ?></th>
			
			
	</tr>
	<?php foreach ($data as $product): ?>
	<tr>
		<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $product['User']['nickname']; ?>
		</td>
		<td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['price']); ?>&nbsp;</td>
		<td><?php echo date('Y-m-d', strtotime($product['Product']['created'])); ?>&nbsp;</td>	
		
	</tr>
<?php endforeach; ?>
	</table>
<?php endif; ?>


<?php if (!empty($total)) : ?>
<pre><h3><?php echo "Member total amount by the date between " .$this->request->data['Product']['start_date']. " to ". $this->request->data['Product']['end_date']  ?></h3></pre>
<table class="table  table-bordered">
	<tr>		
		<th><?php echo 'User'; ?></th>
		
		<th><?php echo 'Total'; ?></th>	
	</tr>
	<?php foreach ($total as $user): ?>
	<tr>	
		<td>
			<?php echo $user['User']['nickname']; ?>
		</td>
		<td><?php echo h($user['0']['total']); ?>&nbsp;</td>	
		
	</tr>
	<?php endforeach; ?>
</table>

<?php endif; ?>

<?php if (!empty($total) && empty($this->request->data['Product']['user_id'])) : ?>

<?php echo $this->Html->link('Make Archeive', array('controller' => 'products', 'action' => 'archeive', $this->request->data['Product']['start_date'], $this->request->data['Product']['end_date']), array('class' => 'btn btn-success'));

endif; ?>




