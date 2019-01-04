<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 02.01.19
 * Time: 17:14
 */

namespace app\models;


use yii\db\ActiveRecord;

class PromoModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'promo';
    }
}