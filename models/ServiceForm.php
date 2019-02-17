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
        ];
    }

    public function save(ServicesModel $action)
    {
        $action->name = $this->name;
        $action->price = $this->price;
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
