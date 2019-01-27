<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 24.01.19
 * Time: 19:47
 */

namespace app\models;


use yii\db\ActiveRecord;

class ActionsModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'actions';
    }

    public function getBoat() {
        return $this->hasOne(BoatsModel::className(), ['id' => 'boat_id'])->viaTable('boat_actions', ['action_id' => 'id']);
    }

}