<?php
App::uses('AppModel','Model');
App::uses('User','Model');
//App::uses('User','Controller');

class UserTest extends CakeTestCase {
   public $fixtures = array('app.user');
   public function setUp() {
        //親のsetUpは必ず呼び出す
   		//$this->user = new User();
        parent::setUp();
        $this->User = ClassRegistry::init('User');
    }

public function tearDown(){
	unset($this->User);
    parent::tearDown();
}

public function testValidate_login(){
	$this->User->create(array(
          'username' => 'testUser',
          'password' => ''
        ));
    //エラーになる列名をkeyとした連想配列を返す
    $results = $this->User->invalidFields();
    // 検証 -------------------------------
    //usernameはエラーではないためkeyに存在しないはず
    $this->assertEquals(array_key_exists('username', $results), false);
    //passwordはエラーであるためkeyに存在するはず
    $this->assertEquals(array_key_exists('password', $results), true);

	$result = $this->User->follow_list_data('ishihara');
    $searchname=$this->User->user_search('ishihara');
    debug($result);
    debug($searchname);

}


public function testUserValidations(){
        $baseCase = [
            'name' => '佐藤かずき',
            'username' => 'satousann',
            'password' => 'satousann',
            'password_2' => 'satousann',
            'mailadress' =>'ishihara@gmail.com',
        ];



 		//$this->assertEquals(
 		//$this->User->beforeSave($baseCase['password']);//,true);
/*$mock = $this->getMockForModel('User', ['beforeSave']);
$mock->expects($this->once())
     ->method('beforeSave')
     ->will($this->returnValue(true));
*/
        $testCases = [
            true => [
                ['name' => 'ishihara'],
                ['username'=>'ishihara'],
                ['password'=>'ishihara'],
                ['password_2'=>'ishihara'],
                ['mailadress'=>'ishihara@yahoo.co.jp']
            ],
           /* false => [
                ['name' => 'ish'],
                ['username'=>'ish'],
                ['password'=>'ishihara1234'],
                ['password_2'=>'ishihara'],
                ['mailadress'=>'ishihara']
            ]*/
        ];
 
        foreach($testCases as $expected => $cases){
            foreach($cases as $case){
                $testCase = array_merge($baseCase, $case);
                $this->User->set($testCase);
                $result = $this->User->validates();
                if((boolean)$expected){
                  //$this->assertEquals($cases,$result);
                } else {
                    //$this->assertInternalType($string,$result);
                }
            }
        }
    }


  }
  ?>