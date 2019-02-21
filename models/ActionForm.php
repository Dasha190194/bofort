<?php

namespace app\models;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 27.01.19
 * Time: 9:24
 */

class ActionForm extends Model {
    public $price, $datetime_from, $datetime_to, $name, $boats;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['price', 'datetime_from', 'datetime_to', 'name', 'boats'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'price' => 'Цена',
            'datetime_from' => 'Время начала',
            'datetime_to' => 'Время окончания',
            'name' => 'Название',
            'boats' => 'Лодка'
        ];
    }

    public function save(ActionsModel $action)
    {
        $action->name = $this->name;
        $action->price = $this->price;
        $action->datetime_from = $this->datetime_from;
        $action->datetime_to = $this->datetime_to;
        $action->save();

        $boat = BoatsModel::findOne($this->boats);
        $action->link('boat', $boat);

    }

    public function loadData($arModel)
    {
        foreach (array_keys($this->getAttributes()) as $attribute)
            if (isset($arModel->$attribute)) $this->$attribute = $arModel->$attribute;

        $this->boats = isset($arModel->boat)?$arModel->boat->id:null;
    }
}
