<!DOCTYPE html>
<html>
  <head>
    <?php echo $this->Html->charset(); ?>
    <title><?php echo $title_for_layout; ?> / twitter like</title>
    <?php echo $this->Html->css('main'); ?>
  </head>
  <body>
  <div id="container">
    <div id="header">
      <div id="header_menu">
        <?php
          if(isset($user)):
            echo $this->Html->link('ホーム',array('action'=>'index',$user['username']));
            echo (" ");
            echo $this->Html->link('友達を検索', '/users/search');
            echo (' ');
            echo $this->Html->link('ログアウト', '/users/logout');
          else:
            echo $this->Html->link('ホーム', array('action'=>'index',$user['username']));
            echo (' ');
            echo $this->Html->link('ユーザ登録', '/users/register');
            echo (' ');
            echo $this->Html->link('ログイン', '/users/login');
          endif;
        ?>
      </div>
      <div id="header_logo">
      <?php echo $this->HTML->link($this->Html->image(('logo.png'),array('width'=>'100','height'=>'65','alt'=>'logo')),array('action'=>'index',$user['username']),array('escape' => false)); ?>
      </div>
      </div>
      <div id="content">
        <?php echo $this->fetch('content'); ?>
      </div>
      </div>
  </body>
</html>