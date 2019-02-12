<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 12.02.19
 * Time: 6:54
 */

namespace app\models;
use yii\db\ActiveRecord;

class TariffsModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'tariffs';
    }

}