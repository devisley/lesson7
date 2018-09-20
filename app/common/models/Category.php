<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 19.09.2018
 * Time: 22:50
 */

namespace app\common\models;


use system\components\ActiveRecord;

class Category extends ActiveRecord
{
    protected static function tableName()
    {
        return 'shop_category';
    }

}