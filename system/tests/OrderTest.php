<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 29.09.2018
 * Time: 17:02
 */

require '../../vendor/autoload.php';
require '../bootstrap.php';

use system\components\App;
use app\common\models\Order;
use app\common\models\OrderItem;
use PHPUnit\Framework\TestCase;
use app\frontend\models\Cart;

class OrderTest extends TestCase
{
    public static function setUpBeforeClass() {
        define('ENV', 'frontend');

        $config = array_merge(
            include '../config/main.php',
            include '../config/database.php'
        );

        $app = new App($config);
        $app->start(false);
    }

    function testSaveNewOrder() {
        $order = new Order();
        $order->comment = 'TestOrder';
        $order->save();

        $lastOrder = Order::findLast();
        $this->assertEquals('TestOrder', $lastOrder->comment);

        $order->id = $lastOrder->id;
        $order->delete();
    }

    function testSaveOrderItems() {
        Cart::addProductToCart(2);

        $order = new Order();
        $order->comment = 'TestOrder';
        $order->save();

        $lastOrder = Order::findLast();
        $order->orderId = $lastOrder->id;

        $order->saveOrderItems();

        $orderItem = OrderItem::findOne([
            'order_id' => $order->orderId,
        ]);

        $this->assertEquals('2', $orderItem->shop_product_id);

        $order->id = $lastOrder->id;
        $order->delete();
        $orderItem->delete();
        Cart::deleteCart();
    }
}
