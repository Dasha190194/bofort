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

    public function rules()
    {
        return [
            [['name', 'description', 'price', 'engine_power', 'spaciousness', 'certificate', 'location', 'short_description'], 'required'],
            ['price', 'number'],
        ];
    }

    public static function tableName()
    {
        return 'boats';
    }

    public function getImage() {
        return $this->hasOne(ImagesModel::className(), ['boat_id' => 'id']);
    }

    public function getImages() {
        return $this->hasMany(ImagesModel::className(), ['boat_id' => 'id']);
    }
}