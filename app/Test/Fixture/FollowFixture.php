<?php

class FollowFixture extends CakeTestFixture {
  public $useDbConfig = 'test';
  public $fields = array(
           'id' => array('type' => 'integer', 'key' => 'primary'),
          'follow_id' => array('type' => 'integer','length' => 11,'null' => false),
          'follow' => array('type' => 'string','length' => 21,'null' => false),
          'follower_id' => array('type' => 'integer','length' => 11,'null' => false),
          'follower' => array('type' => 'string','length' => 21,'null' => false),
          'followtime' =>'datetime'
          );
  public $records = array(
    array('id'=>1,
    'follow_id'=>1,
    'follow'=>'aaaaaaa',
    'follow_id'=>2,
    'follower'=>'bbbbbbbbb',
    'followtime'=>'2016-10-18 10:41:23',
    ),
    array('id'=>2,
    'follow_id'=>1,
    'follow'=>'aaaaaaa',
    'follow_id'=>3,
    'follower'=>'cccccccc',
    'followtime'=>'2016-10-18 10:41:23',
    ),
    array('id'=>3,
    'follow_id'=>2,
    'follow'=>'bbbbbbbbb',
    'follow_id'=>3,
    'follower'=>'cccccccc',
    'followtime'=>'2016-10-18 10:41:23',
    ),
    array('id'=>4,
    'follow_id'=>3,
    'follow'=>'cccccccc',
    'follow_id'=>1,
    'follower'=>'aaaaaaa',
    'followtime'=>'2016-10-18 10:41:23',
    ),
    );
}
?>
