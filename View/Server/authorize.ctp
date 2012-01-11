<?php
	echo $this->Form->create();
	foreach ($authParams as $k => $v) {
		echo '<input type="hidden" name="' . $k . '" value="' . $v . '" />';
	}
	echo $this->Form->input('grant', array(
		'type' => 'checkbox',
		'label' => __('Do you authorize the app to do its thing?')));
	echo $this->Form->end(__('Submit', true));
?>
