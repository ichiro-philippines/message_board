<?php echo 'Thank you for registering'; ?>
<?php
    echo $this->HTML->link('Back To Homepage',
    array(
        'controller' => 'messages',
        'action' => 'index',
    ));
?>
