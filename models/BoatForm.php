<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 22.01.19
 * Time: 20:20
 */

namespace app\models;


use yii\base\Model;

class BoatForm extends Model
{
    public $name, $description, $price, $engine_power, $spaciousness, $certificate, $location, $short_description;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['id', 'name', 'description', 'price', 'engine_power', 'spaciousness', 'certificate', 'location', 'short_description'], 'required'],
            ['price', 'number'],
        ];
    }


}