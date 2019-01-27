<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 27.01.19
 * Time: 17:41
 */

namespace app\models;


use yii\db\ActiveRecord;

class PromoHistoryModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'promo_history';
    }
}