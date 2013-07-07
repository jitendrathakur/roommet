<div class="products form">
<?php


echo $this->Form->create('Product');

echo $this->Form->input('start_date', array('placeHolder' => '2013-12-07'));

echo $this->Form->input('end_date');

echo 'optional: '.$this->Form->input('user_id', array('empty' => 'select any')); 



echo $this->Form->end('Submit');

?>

</div>

