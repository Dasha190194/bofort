<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 13.01.19
 * Time: 12:58
 */

namespace app\models;


use yii\db\ActiveRecord;

class ImagesModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'images';
    }

}