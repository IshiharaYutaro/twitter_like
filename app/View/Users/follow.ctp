<?php echo $uname; ?>

<?php if($no=='follow'): ?>
<?php echo $followcount; ?>人をフォローしています。
<?php else: ?>
<?php echo $followercount ?>人フォローされています。
<?php endif; ?>
</br>
ユーザーネーム：<?php print(h($uname)); ?><br />
<?php echo $this->HTML->link($followcount.'フォローしている',array('action'=>'follow','follow',$uname)); ?></tr>
<?php echo $this->HTML->link($followercount.'フォローされている',array('action'=>'follow','follower',$uname)); ?><br />
<?php echo $this->HTML->link('つぶやき '.$sentdata,array('action'=>'index',$uname)); ?><br />
<br />
ユーザー名/名前
<br />
<?php
if($no=='follow'):
foreach($user_data as $data){
	foreach($followdata as $data_follow){

 if($data['User']['username']==$data_follow['Follow']['follower']):
 echo $this->HTML->link($data['User']['username'],array('action'=>'index',$data['User']['username']));
 echo ("<br>");
 if(isset($data['joinTweet'][0]['tweet'])==NULL):
  print('まだ一度もツイートしていません。');
    echo('<br>');
 else:
 echo nl2br($data['joinTweet'][0]['tweet']);
echo('<br>');
 echo($data['joinTweet'][0]['tweettime']); 
 endif;
//debug($followdata);
//debug($user_follow);
 $is_follow=false;
 if($uname==$user['username']):
    foreach($user_follow as $user_search){
	  if($user_search['Follow']['follow']==$data_follow['Follow']['follow']):
      $is_follow=true;
      endif;
}
endif;

 if($is_follow) {
            echo $this->Form->create('Follow',array('onsubmit'=>'return confirm("フォローを解除します。\nよろしいですか？");'));
            echo $this->Form->hidden('follower_id',array('value'=>$data['User']['id']));
            echo $this->Form->hidden('follower',array('value'=>$data['User']['username']));
            echo $this->Form->hidden('id',array('value'=>$data_follow['Follow']['id']));
            echo $this->Form->submit('unfollow', ['name' => 'unfollow']);
            echo $this->Form->end();
        } else {
           /* echo $this->Form->create('Follow');
            echo $this->Form->hidden('follow',array('value'=>$user['username']));
            echo $this->Form->hidden('follower',array('value'=>$data['User']['username']));
            echo $this->Form->hidden('id',array('value'=>$data_follow['Follow']['id']));
            echo $this->Form->submit('follow', ['name' => 'follow']);
            echo $this->Form->end();*/
    	    }
	 echo("<br>");
 	echo("<br>");
	endif;
	}}

	elseif($no=='follower'):
    foreach($user_data as $follower_data){//全ユーザをfind
	foreach($followerdata as $data_follower){//unameのフォロワーデータ
	 if($follower_data['User']['username']==$data_follower['Follow']['follow']):
//debug($data_follower['Follow']['follower']);
 echo $this->HTML->link($follower_data['User']['username'],array('action'=>'index',$follower_data['User']['username']));
 echo ("<br>");

if(isset($follower_data['joinTweet'][0]['tweet'])==NULL):
  print('まだ一度もツイートしていません。');
    echo('<br>');
 else:
 echo nl2br($follower_data['joinTweet'][0]['tweet']);
echo('<br>');
 echo($follower_data['joinTweet'][0]['tweettime']);
 echo('<br>');
 endif;

 $is_follower=false;
 if($uname==$user['username']):
    foreach($user_follow as $user_follow_search){//ログインユーザーでfollowerしている人
    

	  if($user_follow_search['Follow']['follower']==$data_follower['Follow']['follow']):

      $is_follower=true;
      endif;
}

//debug($data_follower['Follow']);
 if($is_follower) {
         /*   echo $this->Form->create('Follow');
            echo $this->Form->hidden('follow',array('value'=>$fdata['User']['username']));
            echo $this->Form->hidden('id',array('value'=>$data_follower['Follow']['id']));
            echo $this->Form->submit('unfollow', ['name' => 'unfollow']);
            echo $this->Form->end();*/
        } else {
            echo $this->Form->create('Follow',array('onsubmit'=>'return confirm("フォローします。\nよろしいですか？");'));
            echo $this->Form->hidden('follow_id',array('value'=>$user['id']));
            echo $this->Form->hidden('follow',array('value'=>$user['username']));
            echo $this->Form->hidden('follower_id',array('value'=>$data_follower['Follow']['id']));
            echo $this->Form->hidden('follower',array('value'=>$data_follower['Follow']['follow']));
            echo $this->Form->submit('follow', ['name' => 'follow']);
            echo $this->Form->end();
    	    }
	 echo("<br>");
 	echo("<br>");
	endif;
	endif;
	}
	}
	endif;
	?>
	<?php
    echo $this->Paginator->prev('前へ' . __(''), array(), null, array('class' => 'prev disabled'));
  ?>
      
  <?php
    echo $this->Paginator->next(__('') . ' 次へ', array(), null, array('class' => 'next disabled'));
  ?>