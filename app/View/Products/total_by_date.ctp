<div class="products form">
<?php

if (isset($totalAmount)) {
	if (!empty($totalAmount)) {
		echo "<pre>Total amount is : $totalAmount</pre>";
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

