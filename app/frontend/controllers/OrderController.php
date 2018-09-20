<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 20.09.2018
 * Time: 23:04
 */

namespace app\frontend\controllers;

use system\components\Controller;
use app\common\models\Order;
use app\frontend\models\Cart;

class OrderController extends Controller
{
    public function actionCreate() {
        $order = new Order();
        $result = '';

        if ($order->save()) {
            $order->orderId = Order::findLast()->id;

            if ($order->saveOrderItems()) {
                $result = 'Заказ №' . $order->orderId . ' успешно создан!';
                Cart::deleteCart();
            } else {
                $result = 'Ошибка при создании заказа';
            }
        }

        echo $this->render('create', [
            'result' => $result,
        ]);
    }

}