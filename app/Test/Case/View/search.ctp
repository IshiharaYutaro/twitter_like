<!DOCTYPE html>
<html>
  <body>
 <h3>友達を見つけてフォローしましょう！</h3>
 <br/>
 ツイッターに登録済みの友達を検索できます。

 誰を検索しますか。
<?php
 echo $this->Form->create('Search');
 echo $this->Form->input('title',array('label'=>'')); 
 echo $this->Form->end('検索');
 ?>

  </body>
</html>