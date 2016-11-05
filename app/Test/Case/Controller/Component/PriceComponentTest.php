<?php
App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');
App::uses('PriceComponent', 'Controller/Component');

/**
 * Componentのテスト用のダミークラス
 */
class DummyController extends Controller {
}

/**
 * PriceComponentのテスト
 */
class PriceComponentTest extends CakeTestCase {

  public $PriceComponent = null;
  public $Controller = null;

  /**
   * 初期設定
   */
  public function setUp() {
    parent::setUp();
    $Collection = new ComponentCollection();
    $this->PriceComponent = new PriceComponent($Collection);
    $this->Controller = new DummyController(new CakeRequest(), new CakeResponse());
    $this->PriceComponent->startup($this->Controller);
  }

  /**
   * getSumメソッドのテスト
   */
  public function testSum() {
    $items = array(
      array('Item' => array('price' => 100)),
      array('Item' => array('price' => 200)),
      array('Item' => array('price' => 300)),
    );
    $result = $this->PriceComponent->getSum($items);
    $this->assertEquals(600, $result);
  }

  /**
   * getAverageメソッドのテスト
   */
  public function testAverage() {
    $items = array(
      array('Item' => array('price' => 100)),
      array('Item' => array('price' => 200)),
      array('Item' => array('price' => 300)),
    );
    $result = $this->PriceComponent->getAverage($items);
    $this->assertEquals(200, $result);
  }

  /**
   * 後処理
   */
  public function tearDown() {
    parent::tearDown();
    unset($this->PriceComponent);
    unset($this->Controller);
  }

}
?>