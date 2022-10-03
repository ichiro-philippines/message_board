<h1>User Profile</h1>
<div style="display: flex;">
    <?php 
        $picture = 'pictures/' . $user['User']['picture'];
        echo $this->Html->image($picture); 
        
    ?>
    <div>
        <p>Name <?php  echo $user['User']['username']; ?></p>
        <p>Gender 
            <?php  
                $gender = Configure::read('GENDER_NAME_LIST'); 
                echo $gender[$user['User']['gender']]; 
            ?>
        </p>
        <p>Birthdate <?php echo h($user['User']['birthdate']); ?></p>
        <p>Last Login <?php echo h($user['User']['last_login_time']); ?></p>
    </div>
</div>
<p>Hobby</p>
<p><?php echo h($user['User']['hobby']); ?></p>
<?php
if (AuthComponent::user('id') === $user['User']['id']) {
    echo $this->Html->link(
        'Edit Profile',
        array('controller' => 'users', 'action' => 'edit', $user['User']['id']));
}
echo '<br>';
echo $this->Html->link(
    'Go List page', array('controller' => 'messages', 'action' => 'list'));
?>
