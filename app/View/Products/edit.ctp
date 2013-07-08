<div class="products form">
<?php echo $this->Form->create('Product', $twitterBootstrapCreateOptions); ?>
	<fieldset>
		<legend><?php echo __('Edit Product'); ?></legend>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('price');
		echo $this->Form->input('created', array('type' => 'text', 'id' => 'productAdd'));
	?>
	</fieldset>
<?php echo $this->Form->end($twitterBootstrapEndOptions); ?>
</div>

