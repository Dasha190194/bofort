<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 27.01.19
 * Time: 17:41
 */

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

class PromoHistoryModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'promo_history';
    }

    public static function create($orderId, $userId, $promoId) {
        $promoHistory = new self;
        $promoHistory->order_id = $orderId;
        $promoHistory->user_id = $userId;
        $promoHistory->promo_id = $promoId;
        $promoHistory->save();
    }
}