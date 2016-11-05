<!DOCTYPE html>
<html>
  <body>
 
<h3>ツイッターに参加しましょう</h3>
<h6>もうツイッターに登録していますか
<?php print($this->Html->link('ログイン', 'login')); ?></h6>

<?php
 echo $this->Form->create('User');
 echo $this->Form->input('name',array('label'=>'名前','required' => false));
 echo $this->Form->input('username',array('label'=>'ユーザー名','type' => 'text','required' => false));
 echo $this->Form->input('password',array('label'=>'パスワード','required' => false));
 echo $this->Form->input('password_2',array('label'=>'パスワード(確認)','type' => 'password','required' => false));
 echo $this->Form->input('mailadress',array('label'=>'メールアドレス','required' => false)); 
 echo $this->Form->input('visibility',array('label'=>'つぶやきを非公開にする'));
echo $this->Form->submit('アカウントを作成する');
 echo $this->Form->end();?>
</body>
</html>