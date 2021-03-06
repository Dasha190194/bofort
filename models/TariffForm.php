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
    public $holiday, $weekday, $four_hours_weekday, $four_hours_holiday, $one_day, $minimal_rent;

    public function rules()
    {
        return [
            [['holiday', 'weekday', 'four_hours_holiday', 'four_hours_weekday', 'one_day', 'minimal_rent'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'holiday' => 'Выходной за час',
            'weekday' => 'Будний за час',
            'four_hours_holiday' => 'От 4 часов на выходных',
            'four_hours_weekday' => 'От 4 часов в буднии',
            'one_day' => 'Более 1 дня',
            'minimal_rent' => 'Минимальное количесвто часов бронирования'
        ];
    }

    public function loadData(TariffsModel $tariff)
    {
        foreach (array_keys($this->getAttributes()) as $attribute)
            $this->$attribute = $tariff->$attribute;

    }
}