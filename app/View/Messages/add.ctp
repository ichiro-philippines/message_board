<style>
	body {
		color: unset;
	}
</style>
<div class="messages form">
<?php echo $this->Form->create('Message'); ?>
	<fieldset>
		<legend><?php echo __('New Message'); ?></legend>
	<?php
		echo $this->Form->input('sender_user_id',array(
		'type' => 'hidden',
		'value' => AuthComponent::user('id')
	    ));
		echo $this->Form->select('destination_user_id', $users['usernames'],// $users['usernames'] is an array
		array(
			'id' => 'select2',
			'style' => '.select2-selection__rendered {color; black !important;}'
		));
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php echo $this->Html->script(array(
	'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',
	'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js',
)); ?>

<script>
$(document).ready(function() {
    $('#select2').select2();
	$('#select2').val();
  });
  
</script>
