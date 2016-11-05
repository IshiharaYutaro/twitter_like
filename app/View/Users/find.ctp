<?php echo $this->Html->css('find');?>
<?php echo $searchname; ?>
<?php if($searchname==NULL):?>
検索結果
<?php else: ?>
の検索結果
<?php endif; ?>
 <br/>
<?php
 echo $this->Form->create('Search');
 echo $this->Form->input('title',array('label'=>'')); 
 echo $this->Form->end('検索');
 ?>

ユーザー名や名前で検索<br />
<?php echo $this->Session->flash(); ?>
 <?php 
if(empty($userdata)):
    echo h("対象のユーザーは見つかりません。");
     echo('<br>');
    else: 
 foreach ($userdata as $data){ 
    echo $this->HTML->link($data['User']['username'],array('action'=>'index',$data['User']['username']));   
    echo("<br>");    
    if(isset($data['joinTweet'][0]['tweet'])==NULL):
    print('まだ一度もツイートしていません。');
    echo('<br>');
    else:
    echo nl2br($data['joinTweet'][0]['tweet']);
    echo("<br>");
    echo($data['joinTweet'][0]['tweettime']);
    echo("<br>");
    endif;
    $count = 0;
    foreach ($follows as $searchcheck){
    if(($searchcheck['Follow']['follower']==$data['User']['username'] || ($data['User']['username'] == $username['username']))):
    $count++;
        endif;
  
 }

 if($data['User']['username'] == $username['username']):
$count++;
endif;
 if($count == 0):
    $count++;
    echo $this->Form->create('Follow',array('onsubmit'=>'return confirm("フォローします。\nよろしいですか？");'));
    echo $this->Form->hidden('follow_id',array('value'=>$username['id']));
	echo $this->Form->hidden('follow',array('value'=>$username['username']));
    echo $this->Form->hidden('follower_id',array('value'=>$data['User']['id']));
	echo $this->Form->hidden('follower',array('value'=>$data['User']['username']));
 	echo $this->Form->end('follow');
	endif; 
    echo("<br>");
    
   }
   endif;
    ?>


     <?php
    echo $this->Paginator->prev('前へ' . __(''), array(), null, array('class' => 'prev disabled'));
  ?>
      
  <?php
    echo $this->Paginator->next(__('') . ' 次へ', array(), null, array('class' => 'next disabled'));
  ?>
   