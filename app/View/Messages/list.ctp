<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<?php
    echo $this->Html->css('message');
?>
<h1>Message List</h1>
<?php  
    echo $this->Html->link(
        'New Message',
        array('controller' => 'messages', 'action' => 'add'));
?>
<ul class="list">
<?php 
    foreach ($message as $key => $sender): ?>
    <li class="list-item list-item-list" id="<?php echo $key; ?>">
    <div class="message-box" id="message<?php echo $key; ?>">
        <div class="message-box-left">
            <?php 
                $picture = 'pictures/' . $sender['User']['picture'];
                echo $this->Html->image($picture);
            ?>
        </div>
        <div class="message-box-right">
            <div>
                <?php echo $sender['User']['username']; ?>
            </div>
            <div class="massge-box-content">
                <div class="content"><?php echo $sender['Message']['content']; ?></div>
                <div class="message-create-date"><?php echo $sender['Message']['created']; ?></div>
            </div>
        </div>
    </div>
    <?php  
    echo $this->Html->link(
        'Go detail',
        array('controller' => 'messages', 'action' => 'detail', 'param1' => $sender['User']['id']));
    ?>
    </li>
<?php endforeach; ?>
</ul>
<div class="list-btn">
    <button>show more</button>
</div>
<script>
/* Specify the number of lists to display */
var moreNum = 5;

/* Hide Lists After Number of Lists to Show */
$('.list-item:nth-child(n + ' + (moreNum + 1) + ')').addClass('is-hidden');

/* Fade out the "Show More" button when all lists are displayed */
$('.list-btn').on('click', function() {
  $('.list-item.is-hidden').slice(0, moreNum).removeClass('is-hidden');
  if ($('.list-item.is-hidden').length == 0) {
    $('.list-btn').fadeOut();
  } 
});

/* Hide the "See more" button if the number of lists is less than the number of lists to display */
$(function() {
  var list = $(".list li").length;  
    if (list < moreNum) {
      $('.list-btn').addClass('is-btn-hidden');
  }
});
$(function() {
    var list = $(".list li").length;  
    for(let i = 0; i < list; i++) {
    $('#message'+i).on('click', function() {
        if (confirm('Do you want to delete this message?')) {
            $('#'+i).addClass('display-none');
        } else {
            return false
        }
    });
    }
});
</script>