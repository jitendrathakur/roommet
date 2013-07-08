<div class="rooms form">
<?php echo $this->Form->create('Room', $twitterBootstrapCreateOptions); ?>
	<fieldset>
		<legend><?php echo __('Add Room'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('address');		
	?>
	</fieldset>
<?php echo $this->Form->end($twitterBootstrapEndOptions); ?>
</div>

