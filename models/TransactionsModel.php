<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 22.12.18
 * Time: 18:33
 */

namespace app\models;


use yii\db\ActiveRecord;

class TransactionsModel extends ActiveRecord
{
    static $transactionsState = [
            0 => 'Новая',
            1 => 'Успешная',
            -1 => 'Ошибка'
        ];

    public static function tableName()
    {
        return 'transactions';
    }

    public function getOrder() {
        return $this->hasOne(OrdersModel::className(), ['id' => 'order_id']);
    }

    public function getCard() {
        return $this->hasOne(CardsModel::className(), ['id' => 'card_id']);
    }
}