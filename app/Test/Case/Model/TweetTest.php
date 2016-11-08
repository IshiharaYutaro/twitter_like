<?php
App::uses('AppModel', 'Model');
App::uses('Tweet','Model');
App::uses('User','Model');
App::uses('Follow','Model');
class TweetTest extends CakeTestCase {
  public $fixtures = array('app.user','app.tweet','app.follow');
public function setUp() {
        //親のsetUpは必ず呼び出す
      //$this->user = new User();
        parent::setUp();
        $this->Tweet = ClassRegistry::init('Tweet');
        $this->Follow = ClassRegistry::init('Follow');
    }

public function tearDown(){
  unset($this->Tweet);
  unset($this->Follow);
    parent::tearDown();
}

public function testuser_first_tweet(){
 $user_first_tweet=$this->Tweet->user_first_tweet('aaaaaaa');
 debug($user_first_tweet);
}

public function testcount_tweet(){

  $count_tweet=$this->Tweet->count_tweet('aaaaaaa');
  debug($count_tweet);
}
public function testalluser_tweet_all(){
  $list_all_follow=$this->Follow->list_all_follow('aaaaaaa');
  debug($list_all_follow);
  $all_user_tweet_all=$this->Tweet->alluser_tweet_all($list_all_follow,'aaaaaaa');
}

public function testjson_alluser_tweet_all(){
  $page=1;
  $list_all_follow=$this->Follow->list_all_follow('aaaaaaa');
  debug($list_all_follow);
  $json_alluser_tweet_all=$this->Tweet->json_alluser_tweet_all($list_all_follow,'aaaaaaa',$page);
}

public function testuser_tweet_all(){
  $page=1;
  $user_tweet_all=$this->Tweet->user_tweet_all('aaaaaaa',$page);
  debug($user_tweet_all);
}
} 
?>