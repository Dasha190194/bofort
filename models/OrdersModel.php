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
        2 => 'Отменен',
        3 => 'Фиктивный'
    ];

    public static function tableName()
    {
        return 'orders';
    }

    public function attributeLabels()
    {
        return [
            'price' => 'Цена',
            'discount' => 'Скидка',
            'datetime_from' => 'Время начала',
            'datetime_to' => 'Время конца',
            'datetime_create' =>'Время создания',
        ];
    }

    public function rules()
    {
        return [
            [['datetime_from', 'datetime_to'], 'safe'],
            ['state', 'safe'],
        ];
    }


    public function applyPromo($promocode) {
      //  $this->discount = $promocode->count;

        if ($promocode->count_to_use == 1) {
            $promoHistoryCnt = $promocode->getPromoHistoryByUser(Yii::$app->user->getId()) > 0;
            if ($promoHistoryCnt) throw new Exception('Промокод уже был использован!');
        }
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
        $sum = $this->hasMany(ServicesModel::className(), ['id' => 'service_id'])
            ->viaTable('order_services', ['order_id' => 'id'])->sum('services.price');
        return $sum*$this->count_hours;
    }

    public function getTransaction() {
        return $this->hasOne(TransactionsModel::className(), ['order_id' => 'id']);
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getServicesId() {
        $services = $this->getServices()->all();
        $servicesId = [];
        foreach ($services as $service) {
            $servicesId[] = $service->id;
        }
        return $servicesId;
    }

    public function isOfferProcessing() {
        $this->offer_processing = 1;
        $this->save();
    }

    /*
     * Создание фиктивного заказа, когда владелец лодки не хочет чтобы ее бронировали
     */
    public static function createFictitiousOrder(BlockForm $model) {
        $order = new self;
        $order->datetime_from = $model->datetime_from;
        $order->datetime_to = $model->datetime_to;
        $order->boat_id = $model->boat_id;
        $order->user_id = Yii::$app->user->id;
        $order->state = 3;
        $order->save();
        return $order;
    }
}