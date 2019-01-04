<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 21.12.18
 * Time: 15:53
 */

namespace app\models;


use yii\db\ActiveRecord;

class OrdersModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    public function applyPromo($promocode) {
        $this->discount = $promocode->count;
        $this->promo_id = $promocode->id;
        $this->save();
    }

    public function totalPrice() {
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

    public function getServicesId() {
        $services = $this->getServices()->all();
        $servicesId = [];
        foreach ($services as $service) {
            $servicesId[] = $service->id;
        }
        return $servicesId;
    }
}