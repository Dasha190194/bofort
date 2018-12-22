<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 22.12.18
 * Time: 16:44
 */

namespace app\models;


use yii\db\ActiveRecord;

class CardsModel extends ActiveRecord
{

    public static function tableName()
    {
        return 'cards';
    }

//    public function getOrders() {
//        return $this->hasMany(BoatsModel::className(), ['id' => 'boat_id']);
//    }
}
