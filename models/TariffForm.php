<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 14.02.19
 * Time: 19:05
 */

namespace app\models;


use yii\base\Model;

class TariffForm extends Model
{
    public $holiday, $weekday, $four_hours, $one_day;

    public function rules()
    {
        return [
            [['holiday', 'weekday', 'four_hours', 'one_day'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'holiday' => 'Выходной за час',
            'weekday' => 'Будний за час',
            'four_hours' => 'От 4 часов',
            'one_day' => 'Более 1 дня',
        ];
    }

    public function loadData(TariffsModel $tariff)
    {
        foreach (array_keys($this->getAttributes()) as $attribute)
            $this->$attribute = $tariff->$attribute;

    }
}