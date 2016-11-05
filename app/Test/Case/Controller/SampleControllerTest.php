<?php
/**
 * SampleControllerのテスト
 */
class SampleControllerTest extends ControllerTestCase {

  public $fixtures = array('app.item');

  /**
   * indexメソッドのテスト
   */
  public function testIndex() {
    $result = $this->testAction('/sample/index', array('return' => 'vars'));

    $this->assertEquals(200, $result['avg']);
    $this->assertEquals(600, $result['sum']);
    $this->assertEquals(3, count($result['items']));
  }

  /**
   * addメソッドのテスト（正常系）
   */
  public function testAdd() {
    $result = $this->testAction(
      '/sample/add',
      array('data' => array('name' => 'grape', 'price' => 400), 'method' => 'post', 'return' => 'headers')
    );
    // returnにheadersを指定した場合、redirectすると、resultに下記のような配列が設定される。
    // Array([Location] => http://サーバーのアドレス/cakephp/sample/)
    $this->assertArrayHasKey('Location', $result);
  }

  /**
   * addメソッドのテスト（異常系）
   */
  public function testAddNg() {
    $result = $this->testAction(
      '/sample/add',
      array('data' => array('name' => 'grape', 'price' => 'no_number'), 'method' => 'post', 'return' => 'contents')
    );
    $this->assertFalse(isset($result['Location']));
  }

}
?>