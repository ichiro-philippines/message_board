<h1>User Profile</h1>
<?php
echo $this->Form->create('User', array('type'=>'file', 'enctype' => 'multipart/form-data'));
echo $this->Form->input('id', array('hiddenField' => true, 'value' => $user['User']['id']));
echo $this->Form->input('picture', array('label' => false, 'type' => 'file', 'multiple'));
echo $this->Form->input('username', array(
    'label' => 'Name'
));
echo $this->Form->input('birthdate');
echo $this->Form->input('gender', array(
    'type' => 'radio',
    'options' => array('male', 'female'),
));
echo $this->Form->input('hobby');
echo $this->Form->submit('save profile', array('name' => 'submit'));
echo $this->Form->end();
// echo $this->Form->end('save profile');

?>