<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 20.09.2018
 * Time: 22:32
 */

namespace app\common\models;


use system\components\ActiveRecord;
use system\components\App;

class Order extends ActiveRecord
{
    public function __construct(array $attributes = [])
    {
//        $this->created_at = time();
        $this->created_at = '2018-09-05 00:00:00';
        $this->comment = 'user comment';
        $this->order_status_id = 1;
    }

    protected static function tableName()
    {
        return 'orders';
    }

    function saveOrderItems() {
        $cart = App::$current->request->session('cart');

        foreach ($cart as $cartItem) {
            $orderItem = new OrderItem();
            if (!$orderItem->saveItem($cartItem, $this->orderId)) return false;
        }

        return true;
    }

}