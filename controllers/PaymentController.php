<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 04.01.19
 * Time: 12:53
 */

namespace app\controllers;


use app\helpers\CloudPayments\InputPayAnswer;
use app\models\CardsModel;
use app\models\OrdersModel;
use app\models\PayForm;
use app\models\TransactionsModel;
use CloudPayments\Exception\PaymentException;
use Exception;
use Yii;
use yii\debug\models\search\Log;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class PaymentController extends Controller
{

    public function beforeAction($action)
    {
        if ($action->id == 'complete') {
            Yii::$app->controller->enableCsrfValidation = false;
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }
        return parent::beforeAction($action);
    }

    public $enableCsrfValidation = false;

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
                    [
                        'actions' => ['complete'],
                        'allow' => true,
                        'roles' => ['?'],
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
                $transaction->create($form->order_id, $order->totalPrice(), Yii::$app->user->getId());
            } catch (Exception $e) {
                Yii::error($e->getMessage(), 'payment.pay');
                return $this->redirect(['/order/confirm-step2', 'id' => $form->order_id]);
            }

            $card = CardsModel::find()->where(['user_id' => Yii::$app->user->getId(), 'state' => 1])->one();
            if ($card) {
               try {
                   $client = new \CloudPayments\Manager(Yii::$app->params['cloud_id'], Yii::$app->params['cloud_private_key']);
                   $response = $client->chargeToken($transaction->total_price, 'RUB', Yii::$app->user->getId(), $card->token);

                   return $this->asJson(
                       [
                           'success' => true,
                           'action' => 'charge',
                           'data' => $response->getId()
                       ]);

               } catch (PaymentException $e) {
                   Yii::error($e->getMessage(), 'payment.pay');

                   return $this->asJson(
                       [
                           'success' => false,
                           'action' => 'charge',
                           'data' => $e->getCardHolderMessage()
                       ]);
               }
            }

            return $this->asJson(
                [
                    'success' => true,
                    'action' => 'frame',
                    'data' => $transaction
                ]);
        }

        return $this->asJson(
            [
                'success' => false,
            ]);
    }

    public function actionPayValidate()
    {
        $post = Yii::$app->request->post();
        $form = new PayForm();
        $form->load($post);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($form);
    }

    public function actionComplete()
    {
        if (Yii::$app->getRequest()->getMethod() == 'POST') {

          //  Yii::info("Cloudpayment answer [{$_POST}]", 'payment.complete');
            $input = InputPayAnswer::collect();
            try {
                $transaction = TransactionsModel::find()->where(['order_id' => $input->invoiceId])->orderBy('id DESC')->one();
                if (empty($transaction)) throw new Exception("Для заказа $input->invoiceId отсутствует транзакция");

                $card = CardsModel::createCardIFNoExist($input);

                $transaction->state = 1;
                $transaction->card_id = $card->id;
                $transaction->cloud_transaction_id = $input->transactionId;
                $transaction->save();

                $order = OrdersModel::findOne($input->invoiceId);
                $order->state = 1;
                $order->save();

                return ['code' => 0];
            } catch (Exception $e) {
                Yii::error($e->getMessage(), 'payment.complete');
            }
        }

        return ['code' => -1];
    }
}