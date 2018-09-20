<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 19.09.2018
 * Time: 22:49
 */

namespace app\common\models;


use system\components\ActiveRecord;

class Product extends ActiveRecord
{
    protected static function tableName()
    {
        return 'shop_product';
    }

    public function getCategory() {
        return Category::findOne([
            'id' => $this->shop_category_id,
        ]);
    }
}