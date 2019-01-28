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
    public $price, $datetime, $name, $boats;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['price', 'datetime', 'name', 'boats'], 'required'],
        ];
    }

    public function save()
    {
        $action = new ActionsModel();
        $action->price = $this->price;
        $action->datetime = $this->datetime;
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
