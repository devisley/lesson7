<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 19.09.2018
 * Time: 22:47
 */

namespace app\frontend\controllers;

use app\common\models\Product;
use system\components\Controller;

class ProductController extends Controller
{
    public function actionIndex() {
        $products = Product::findAll();

        echo $this->render('index', [
            'products' => $products,
        ]);
    }

    public function actionView($id) {
        $product = Product::findById($id);

        echo $this->render('view', [
            'product' => $product,
            'category' => $product->getCategory()
        ]);
    }

}