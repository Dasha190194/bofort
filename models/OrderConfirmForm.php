<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 31.12.18
 * Time: 20:57
 */
namespace app\models;

use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 30.12.18
 * Time: 18:00
 */

class OrderConfirmForm extends Model {

    public $boat_id;
    public $user_id;
    public $datetime_from;
    public $datetime_to;
    public $coast;

    public function rules()
    {
        return [

            [['boat_id', 'user_id', 'datetime_from', 'datetime_to', 'coast'], 'required'],
//            ['boat_id', 'validateBoat'],
        ];
    }

//
//    public function validateBoat($attribute, $params)
//    {
////        if (!$this->hasErrors()) {
////            $user = $this->getUser();
////
////            if (!$user || !$user->validatePassword($this->password)) {
////                $this->addError($attribute, 'Incorrect username or password.');
////            }
////        }
//    }
////
//    /**
//     * @return OrdersModel
//     */
//    public function save() {
//        $order = new OrdersModel();
//        $order->boat_id = $this->boat_id;
//        $order->user_id = $this->user_id;
//        $order->save();
//        return $order;
//    }
}