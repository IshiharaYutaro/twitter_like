ユーザー登録(無料)<br />
<?php print($this->Html->link('ユーザー登録', 'register')); ?>
<h3>ログイン</h3>
<?php

 echo $this->Form->create('User');
 echo $this->Form->input('username',array('label' => 'ユーザーID','type' => 'text','required' => false));
 echo $this->Form->input('password',array('label' => 'パスワード','type' => 'password','required' => false));
 echo $this->Session->flash();
 echo $this->Form->submit('ログイン');
 echo $this->Form->end();
  ?>