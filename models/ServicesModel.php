<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 01.01.19
 * Time: 7:33
 */

namespace app\models;


use yii\db\ActiveRecord;

class ServicesModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'services';
    }

    public function getBoat() {
        return $this->hasOne(BoatsModel::className(), ['id' => 'boat_id'])->viaTable('boat_services', ['service_id' => 'id']);
    }


}