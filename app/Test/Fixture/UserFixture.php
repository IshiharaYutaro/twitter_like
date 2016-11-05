<?php

class UserFixture extends CakeTestFixture {
  public $useDbConfig = 'test';
  public $fields = array(
           'id' => array('type' => 'integer', 'key' => 'primary'),
          'username' => array('type' => 'string','length' => 22,'null' => false),
          'name' => array('type' => 'string','length' => 20,'null' => false),
          'time' => 'datetime',
          'password'=> array('type'=> 'string','length'=>200,'null'=>false),
          'mailadress'=>array('type'=>'string','length'=>100,'null'=>false),
          'visibility'=>array('type'=>'boolean','length'=>1)
          );
  public $records = array(
    array('id'=>1,
    'username'=>'aaaaaaa',
    'name'=>'aaaaaaa',
    'password'=>'aaaaaaaa',
    'time'=>'2016-10-18 10:41:23',
    'mailadress'=>'aaaaa@aa.com',
    'visibility'=>0
    ),
    array('id'=>2,
    'username'=>'bbbbbb',
    'name'=>'bbbbbb',
    'password'=>'bbbbbbbbb',
    'time'=>'2016-10-17 10:41:23',
    'mailadress'=>'bbbbbb@bb.com',
    'visibility'=>0
    ),
    array('id'=>3,
    'username'=>'cccccc',
    'name'=>'cccccccc',
    'time'=>'2016-10-19 10:41:23',
    'password'=>'cccccccc@cc.com',
    'mailadress'=>'cccccc@cc.com',
    'visibility'=>0
    ),
    );
}
?>
