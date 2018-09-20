<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 20.09.2018
 * Time: 20:24
 */

namespace app\frontend\controllers;


use app\frontend\models\Cart;
use system\components\App;
use system\components\Controller;

class CartController extends Controller
{
    public function actionIndex() {
        echo $this->render('index',[
            'cart' => Cart::getCart(),
            'price' => Cart::calculateCartPrice()
        ]);
    }

    public function actionAdd($id) {
        Cart::addProductToCart($id);

        App::$current->request->redirect('cart');
    }

}