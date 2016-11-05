<?php
//Authコンポーネントを読み込んでおく
App::uses('AuthComponent', 'Controller/Component');

// 規約：テストを含むクラスは必ず CakeTestCase または ControllerTestCase, PHPUnit_Framework_TestCase を継承します。他のクラスと同じく、テストケースのクラスを書いたファイル名もクラス名と同じにします。たとえば、 RouterTest.php は class RouterTest extends CakeTestCase を含んでいなければなりません。
class UserTest extends CakeTestCase {
   public $fixtures = 'app.User';
  //規約：テストを含むメソッド(つまりアサーションを含むメソッド)はいずれも testPublished() といったように test で始まる名前にします。 @test という注釈をメソッドにマークすることでテストメソッドとすることもできます。
  public function testValidation(){
    // 準備 -------------------------------
    //Userモデルを読み込む
    $this->User = ClassRegistry::init('User');

    // 実行 -------------------------------
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

  }
  
 

}
?>