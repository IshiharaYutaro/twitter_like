<?php
App::uses('AppModel', 'Model');
App::uses('Tweet','Model');
App::uses('User','Model');
App::uses('Follow','Model');
class FollowTest extends CakeTestCase {
          $this->Tweet = ClassRegistry::init('Tweet');
public $fixtures = array('app.user','app.tweet','app.follow');
public function setUp() {
        //親のsetUpは必ず呼び出す
      //$this->user = new User();
        parent::setUp();
        $this->Follow = ClassRegistry::init('Follow');
    }

public function tearDown(){
  unset($this->Follow);
    parent::tearDown();
}
 public function testlist_all_follow(){
$list_all_follow=$this->Follow->list_all_follow('aaaaaaa');
 }
 public function testlist_all_follower(){
$list_all_follower=$this->Follow->list_all_follower('aaaaaaa');
 }
 public function testall_follow(){
  $all_follow=$this->Follow->all_follow('aaaaaaa');
 }
 public function testall_follower(){
  $all_follower=$this->Follow->all_follower('aaaaaaa');
 }
 public function testcount_follow(){
  $count_follow=$this->Follow->count_follow('aaaaaaa');
 }
 public function testcount_follower(){
  $count_follower=$this->Follow->count_follower('aaaaaaa');
 }
}
?>

