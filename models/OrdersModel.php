<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 21.12.18
 * Time: 15:53
 */

namespace app\models;


use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;

class OrdersModel extends ActiveRecord
{
    static $states = [
        0 => '',
        1 => 'Оплачен',
        2 => 'Отменен'
    ];

    public static function tableName()
    {
        return 'orders';
    }

    public function applyPromo($promocode) {
      //  $this->discount = $promocode->count;
        $this->promo_id = $promocode->id;
        $this->save();

        $promoHistory = new PromoHistoryModel();
        $promoHistory->order_id = $this->id;
        $promoHistory->user_id = Yii::$app->user->getId();
        $promoHistory->promo_id = $this->promo_id;
        $promoHistory->save();
    }

    //TODO это ебаный пиздец - перепиши
    public function totalPrice() {

        if ($this->promo_id != 0) {
            $promo = $this->promo;

            if ($promo->count_to_use == 1) {
                $promoHistoryCnt = $promo->getPromoHistoryByUser(Yii::$app->user->getId()) > 1;
                if (!empty($promoHistoryCnt)) throw new Exception('Промокод уже был использован!');
            }

            if ($promo->type == 1) {
                $this->discount = ($this->price + $this->getServicesPrice()) * ($promo->count/100);
            } elseif($promo->type == 2) {
                $this->discount = $promo->count;
            }
        }

        $this->save();
        return ($this->price + $this->getServicesPrice() - $this->discount);
    }

    public function getBoat() {
        return $this->hasOne(BoatsModel::className(), ['id' => 'boat_id']);
    }

    public function getPromo() {
        return $this->hasOne(PromoModel::className(), ['id' => 'promo_id']);
    }

    public function getServices() {
        return $this->hasMany(ServicesModel::className(), ['id' => 'service_id'])
                 ->viaTable('order_services', ['order_id' => 'id']);
    }

    public function getServicesPrice() {
        return $this->hasMany(ServicesModel::className(), ['id' => 'service_id'])
            ->viaTable('order_services', ['order_id' => 'id'])->sum('services.price');
    }

    public function getTransaction() {
        return $this->hasOne(TransactionsModel::className(), ['order_id' => 'id']);
    }

    public function getServicesId() {
        $services = $this->getServices()->all();
        $servicesId = [];
        foreach ($services as $service) {
            $servicesId[] = $service->id;
        }
        return $servicesId;
    }
}