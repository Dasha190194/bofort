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
            -1 => 'Ошибка',
            2 => 'Возврат'
        ];

    public static function tableName()
    {
        return 'transactions';
    }

    public function create($order_id, $total_price, $user_id, $card_id) {
        $this->order_id = $order_id;
        $this->total_price = $total_price;
        $this->user_id = $user_id;
        $this->card_id = $card_id;
    }

    public function getOrder() {
        return $this->hasOne(OrdersModel::className(), ['id' => 'order_id']);
    }

    public function getCard() {
        return $this->hasOne(CardsModel::className(), ['id' => 'card_id']);
    }
}