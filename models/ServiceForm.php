<?php

namespace app\models;
use yii\base\Model;


class ServiceForm extends Model {
    public $price, $name, $boats;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'price', 'boats'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'price' => 'Цена',
            'name' => 'Название',
            'boats' => 'Лодки'
        ];
    }

    public function save(ServicesModel $action)
    {
        $action->name = $this->name;
        $action->price = $this->price;
        $action->save();

        foreach ($this->boats as $boat) {
            $boatS = BoatsModel::findOne($boat);
            $action->link('boats', $boatS);
        }
    }

    public function loadData($arModel)
    {
        foreach (array_keys($this->getAttributes()) as $attribute)
            if (isset($arModel->$attribute)) $this->$attribute = $arModel->$attribute;

        $arr = [];
        if (isset($arModel->boats)) {
            foreach ($arModel->boats as $boat) {
                $arr[] = $boat->id;
            }
            $this->boats = $arr;
        }
    }
}
