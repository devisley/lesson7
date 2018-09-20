<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 20.09.2018
 * Time: 22:33
 */

namespace app\common\models;


use system\components\ActiveRecord;
use system\components\App;

class OrderItem extends ActiveRecord
{
    public function saveItem($cartItem, $order_id) {
        $cart = App::$current->request->session('cart');

        $this->quantity = 1;
        $this->price = $cartItem['price'];
        $this->shop_product_id = $cartItem['id'];
        $this->order_id = $order_id;

        return $this->save();
    }

    protected static function tableName()
    {
        return 'order_item';
    }
}