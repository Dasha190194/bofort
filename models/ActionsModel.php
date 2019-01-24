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


}