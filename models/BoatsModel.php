<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 21.12.18
 * Time: 16:07
 */

namespace app\models;


use yii\db\ActiveRecord;

class BoatsModel extends ActiveRecord
{

    public static function tableName()
    {
        return 'boats';
    }


    public function getImage() {
        return $this->hasOne(ImagesModel::className(), ['boat_id' => 'id']);
    }
}