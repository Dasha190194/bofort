<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 04.01.19
 * Time: 12:53
 */

namespace app\controllers;


use app\models\OrdersModel;
use app\models\PayForm;
use app\models\TransactionsModel;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class PaymentController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['pay', 'pay-validate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionPay()
    {
        $post = Yii::$app->request->post();
        $form = new PayForm();
        $form->load($post);

        if ($form->validate()) {
            $order = OrdersModel::findOne($form->order_id);

            try {
                $transaction = new TransactionsModel();
                $transaction->order_id = $form->order_id;
                $transaction->total_price = $order->totalPrice();
                $transaction->user_id = Yii::$app->user->getId();
                $transaction->save();
            } catch (Exception $e) {
                Yii::$app->session->setFlash("order-error", 'Ошибка создания транзакции');
                Yii::error($e->getMessage(), 'payment.pay');
                return $this->redirect(['/order/confirm-step2', 'id' => $form->order_id]);
            }

            return $this->asJson(
                [
                    'result' => 'success',
                    'data' => $transaction
                ]);
        }

        return $this->asJson(
            [
                'result' => 'error'
            ]);
    }

    public function actionPayValidate() {
        $post = Yii::$app->request->post();
        $form = new PayForm();
        $form->load($post);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($form);
    }

}