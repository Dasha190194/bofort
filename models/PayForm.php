<?php

namespace app\models;

use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 01.01.19
 * Time: 14:40
 */

class PayForm extends Model {

    public $order_id;
    public $offer_processing;

    public function rules()
    {
        return [

            [['order_id', 'offer_processing'], 'required'],
            ['offer_processing', 'required', 'requiredValue' => 1, 'message' => 'You should accept term to use our service'],
        ];
    }
}