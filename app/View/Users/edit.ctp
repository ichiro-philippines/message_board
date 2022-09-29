<h1>Edit User Profile</h1>
<?php 
        $picture = 'pictures/' . $user['User']['picture'];
        echo $this->Html->image($picture);
    ?>
<?php
echo $this->Form->create('User', array('type'=>'file', 'enctype' => 'multipart/form-data'));
echo $this->Form->input('id', array('hiddenField' => true, 'value' => $user['User']['id']));
echo $this->Form->input('picture', array('label' => false, 'type' => 'file', 'multiple'));
echo $this->Form->input('username', array(
    'label' => 'Name',
	'value' => $user['User']['username']
));
echo $this->Form->input('birthdate', array(
	'value' => $user['User']['birthdate']
));
echo $this->Form->input('gender', array(
    'type' => 'radio',
    'options' => array('male', 'female'),
	'value' => $user['User']['gender']
));
echo $this->Form->input('hobby', array(
	'value' => $user['User']['hobby']
));
echo $this->Form->submit('save profile', array('name' => 'submit'));
echo $this->Form->end();
?>