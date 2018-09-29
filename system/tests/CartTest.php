<?php

require '../../vendor/autoload.php';
require '../bootstrap.php';

use system\components\App;
use app\frontend\models\Cart;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase {

    public static function setUpBeforeClass() {
        define('ENV', 'frontend');

        $config = array_merge(
            include '../config/main.php',
            include '../config/database.php'
        );

        $app = new App($config);
        $app->start(false);
    }

    function tearDown() {
        Cart::deleteCart();
    }

    function testGetCart() {
        $_SESSION['cart'] = 'TestValue';

        $this->assertEquals('TestValue', Cart::getCart());
    }

    function testAddProductToCart() {
        Cart::addProductToCart(2);
        $product = Cart::getProduct(2);

        $this->assertEquals(2, $product['id']);
    }

    function testCalculateCartPrice() {
        Cart::addProductToCart(2);
        $product1 = Cart::getProduct(2);

        Cart::addProductToCart(3);
        $product2 = Cart::getProduct(3);

        $this->assertEquals($product1['price'] + $product2['price'], Cart::calculateCartPrice());
    }
}
