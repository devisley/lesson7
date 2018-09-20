<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 20.09.2018
 * Time: 20:27
 */

namespace app\frontend\models;

use system\components\ActiveRecord;
use system\components\App;


class Cart extends ActiveRecord
{
    protected static function tableName()
    {
        return 'shop_product';
    }

    public static function addProductToCart($id) {
        if (!is_null($id)) {
            $cart = App::$current->request->session('cart');

            if (!$cart) {
                $cart = [];
            }

            $product = static::findById($id);
            $cartProduct = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
            ];

            array_push($cart, $cartProduct);

            static::updateCart($cart);
        }
    }

    public static function deleteProductFromCart($id) {
        if (!is_null($id)) {
            $cart = App::$current->request->session('cart');
            if ($cart) {
                foreach ($cart as $key => $cartItem) {
                    if ($cartItem['id'] == $id) {
                        unset($cart[$key]);
                    }
                }
            }
            static::updateCart($cart);
        }
    }

    public static function calculateCartPrice() {
        $cart = App::$current->request->session('cart');
        $price = 0;

        if ($cart) {
            foreach ($cart as $cartItem) {
                $price += (float)$cartItem['price'];
            }
        }

        return $price;
    }

    private static function updateCart($cart) {
        $_SESSION['cart'] = $cart;
    }

    public static function getCart() {
        return $_SESSION['cart'];
    }

    public static function deleteCart() {
        unset($_SESSION['cart']);
    }

}