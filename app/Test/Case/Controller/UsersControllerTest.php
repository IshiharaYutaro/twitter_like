<?php
App::uses('Tweet','Model');
App::uses('User','Model');
App::uses('Follow','Model');
class UsersControllerTest extends ControllerTestCase{
public $fixture =array('app.user','app.tweet','app.follow');

public function testbefore_Filter(){
  $result = $this->testAction('/users/login');
  debug($result);
}

public function testlogin(){

  $result = $this->testAction('/users/index');
  debug($result);
}

/*public function testjoin(){
  $result = $this->testAction('/users/join',
    array('return' => 'aaaaaaa'));
  debug($result);
}*/

}
?>
