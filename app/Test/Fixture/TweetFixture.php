<?php

class TweetFixture extends CakeTestFixture {
  public $useDbConfig = 'test';
  public $fields = array(
           'id' => array('type' => 'integer', 'key' => 'primary'),
          'tweet_id' => array('type' => 'string','length' => 11,'null' => false),
          'name' => array('type' => 'string','length' => 20,'null' => false),
          'tweet'=>array('type'=>'string','length'=>300,'null'=>false),
          'tweettime' => 'datetime',
          );
  public $records = array(
    array('id'=>1,
    'tweet_id'=>1,
    'name'=>'aaaaaaa',
    'tweet'=>'aaaaaaaa',
    'tweettime'=>'2016-10-18 10:41:23',
    ),
    array('id'=>2,
    'tweet_id'=>2,
    'name'=>'bbbbbb',
    'tweet'=>'bbbbbbbbb',
    'tweettime'=>'2016-10-17 10:41:23',
    ),
    array('id'=>3,
    'tweet_id'=>3,
    'name'=>'cccccccc',
    'tweet'=>'ccccccccccc',
    'tweettime'=>'2016-10-19 10:41:23',
    ),
    array('id'=>4,
    'tweet_id'=>1,
    'name'=>'aaaaaaa',
    'tweet'=>'ddddddddddddd',
    'tweettime'=>'2016-10-20 10:41:23',
    ),
    array('id'=>5,
    'tweet_id'=>1,
    'name'=>'aaaaaaa',
    'tweet'=>'eeeeeeeeeeeee',
    'tweettime'=>'2016-10-20 10:41:23',
    ),
    );
}
?>
