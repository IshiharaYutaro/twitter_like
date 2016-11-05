<?php 
echo $this->Html->css('index');
echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js');
echo $this->Html->script('jquery.bottom-1.0'); 
echo $this->Html->script('jquery.validate');
echo $this->Html->script('test');
 ?>

<?php if($user['username']==$data_name): ?>

<h3>いまなにしてる？</h3>
140文字で入力して下さい。※半角、全角問わず

<div id="error_msg">
  </div>

  <?php
	  echo $this->Form->create('Tweet');
	  echo nl2br($this->Form->textarea('tweet', array('cols'=>100, 'rows'=>4,'required' => false,'error'=>false)));
      echo $this->Form->submit('投稿',array(/*'onclick'=>'index',*/'name' => 'submit'));
 	  echo $this->Form->end();
endif;
?>

最新のつぶやき:

<div id="first_tweet"></div>
<div id="tweet_time"></div>

<br />ユーザーネーム：<?php print(h($data_name)); ?> <br />


<?php echo $this->HTML->link($user_follow_data.'フォローしている',array('action'=>'follow','follow',$data_name)); ?><br />
<?php echo $this->HTML->link($user_follower_data.'フォローされている',array('action'=>'follow','follower',$data_name)); ?><br />

<div id=sent_no></div>

<br />
	<h3>ホーム</h3>
  <div id="output">
    <div id="delite"></div>
  </div>
     <div class="loading"></div>
