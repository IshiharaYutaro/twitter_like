<?php
App::uses('Controller', 'Controller');
App::uses('View', 'View');
App::uses('PriceHelper', 'View/Helper');

/**
 * PriceHelperのテスト
 */
class PriceHelperTest extends CakeTestCase {

  /**
   * 初期設定
   */
  public function setUp() {
    parent::setUp();
    $Controller = new Controller();
    $View = new View($Controller);
    $this->Price = new PriceHelper($View);
  }

  /**
   * formatメソッドのテスト
   */
  public function testFormat() {
    $result = $this->Price->format(999);
    $this->assertNotContains(',', $result);

    $result = $this->Price->format(1000);
    $this->assertContains(',', $result);
  }
}
?>