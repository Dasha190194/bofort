<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 21.12.18
 * Time: 15:53
 */

namespace app\models;


use yii\db\ActiveRecord;

class OrdersModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    public function getBoat() {
        return $this->hasOne(BoatsModel::className(), ['id' => 'boat_id']);
    }
}