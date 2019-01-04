<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 29.12.18
 * Time: 18:10
 */

namespace app\controllers;

use app\models\OrderConfirmForm;
use app\models\OrderCreateForm;
use app\models\OrderSession;
use app\models\OrdersModel;
use app\models\PayForm;
use app\models\PromoModel;
use app\models\ServicesModel;
use Yii;
use yii\base\Exception;
use yii\web\Controller;

class OrderController extends Controller
{

    public function actionCreate() {

        $post = Yii::$app->request->post();
        $form = new OrderCreateForm();

        $form->load($post);
        $form->user_id = Yii::$app->user->getId();

        if($form->validate()) {
            $order = $form->save();
            return $this->redirect(['/order/confirm-step1', 'id' => $order->id]);
        }

        Yii::$app->session->setFlash("Order-create-error", 'Не удалось создать заказ');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionConfirmStep1(int $id) {
        $order = OrdersModel::findOne($id);
        $model = new OrderConfirmForm();

        $post = Yii::$app->request->post();
        if ($model->load($post)) {

            return $this->redirect(['/order/confirm-step2', 'id' => $order->id]);
        }
        return $this->render('confirm-step1', compact('order', 'model'));
    }

    public function actionConfirmStep2(int $id) {
        $order = OrdersModel::findOne($id);
        $services = ServicesModel::find()->all();
        $model = new PayForm();

        return $this->render('confirm-step2', compact('order', 'services', 'model'));
    }

    public function actionApplyPromo(int $order_id, string $word) {

        Yii::info("Apply Promo: $word", 'order.apply-promo');

        try {
            $promocode = PromoModel::find()->where(['word' => trim($word)])->one();
            if (!$promocode) throw new Exception('Промокод не найден!');
        } catch (Exception $e) {
            Yii::$app->session->setFlash("Promo-apply-error", $e->getMessage());
            Yii::error($e->getMessage(), 'order.apply-promo');
            return false;
        }

        try {
            $order = OrdersModel::findOne($order_id);
            $order->applyPromo($promocode);
        } catch (Exception $e) {
            Yii::$app->session->setFlash("Promo-apply-error", 'Не удалось применить промокод.');
            Yii::error($e->getMessage(), 'order.apply-promo');
            return false;
        }

        return true;
    }

    public function actionAddService($order_id, $id) {
        $order = OrdersModel::findOne($order_id);
//        $order->
    }

    public function actionGetTimes() {
        $times = [
            1 => '06:00 - 07:00',
            2 => '07:00 - 08:00',
            3 => '08:00 - 09:00',
            4 => '09:00 - 10:00',
            5 => '10:00 - 11:00',
            6 => '11:00 - 12:00',
            7 => '12:00 - 13:00',
            8 => '13:00 - 14:00',
            9 => '14:00 - 15:00',
            10 => '15:00 - 16:00',
            11 => '16:00 - 17:00',
            12 => '17:00 - 18:00',
            13 => '18:00 - 19:00',
            14 => '19:00 - 20:00',
            15 => '20:00 - 21:00',
            16 => '21:00 - 22:00',
            17 => '26:00 - 23:00'
        ];

        return $this->render('_times', compact('times'));
    }
}