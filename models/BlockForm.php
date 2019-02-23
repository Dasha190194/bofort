<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 23.02.19
 * Time: 7:27
 */

namespace app\models;


use yii\base\Model;

class BlockForm extends Model
{
    public $datetime_from, $datetime_to, $boat_id;

    public function rules()
    {
        return [
            [['datetime_from', 'datetime_to', 'boat_id'], 'required'],
        ];
    }
}