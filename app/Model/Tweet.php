<?php
App::uses('AppModel', 'Model');

class Tweet extends AppModel {
	 public $name = 'Tweet';

	public $validate =array(
    'tweet' =>array(
      'blank'=>array(
          'rule' => 'notBlank',
          'message' => '投稿内容を入力して下さい。',
        ),
    	'between'=>array(
        'rule' => array('between', 1, 140), //4～20文字
        'message' => '140文字以内にしてください。',
      )));
  //data_nameの最初のツイートを検索
 public function user_first_tweet($data_name){
  $first_tweet=$this->find('first',array('conditions'=>array('Tweet.name' => $data_name),'order' => array('Tweet.tweettime DESC')));
  return $first_tweet;
 } 
//$data_name のツイート数を取得
public function count_tweet($data_name){
   $count_tweet=$this->find('count',array('conditions'=>array('Tweet.name' => $data_name)));
return $count_tweet;
}
//$userdata_tweet_allを取得
public function alluser_tweet_all($all_follow,$id){
 $option = array(
      'order' => array('Tweet.tweettime' => 'desc'),
      'limit' => 10,
      'conditions'=>array('or'=>array(array('Tweet.name'=>$all_follow),array('Tweet.name'=>$id))));
 return $option;
}

public function json_alluser_tweet_all($all_follow,$id,$page){
 $option = array(
      'order' => array('Tweet.tweettime' => 'desc'),
      'conditions'=>array('or'=>array(array('Tweet.name'=>$all_follow),array('Tweet.name'=>$id))),
      'limit' => 20*$page,
      //'page' => $n,
      //'offset' => $n
       );
 $tweet=$this->find('all',$option);
 return $tweet;
}

//data_nameのtweetをすべて取得
public function user_tweet_all($data_name,$page){
 $option = array(
      'order' => array('Tweet.tweettime' => 'desc'),
      'limit' => 20*$page,
      'conditions'=>array('Tweet.name'=> $data_name));

 $tweet=$this->find('all',$option);
 return $tweet;
}

}