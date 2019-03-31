<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\TransactionsModel;
use Yii;
use yii\base\Exception;
use yii\console\Controller;
use yii\console\ExitCode;


class PaymentController extends Controller
{
    public function actionRefund() {
        $transactions = TransactionsModel::find()->where(['order_id' => 111111, 'state' => 1])->all();

        foreach ($transactions as $transaction) {

            try {
                $client = new \CloudPayments\Manager(Yii::$app->params['cloud_id'], Yii::$app->params['cloud_private_key']);
                $client->refundPayment($transaction->cloud_transaction_id, 1);

                $transaction->state = 2;
                $transaction->refund_price = 1;
                $transaction->save();

                Yii::info("Transaction [$transaction->id] success refund", 'app.payment.refund');

            }  catch (Exception $e){
                Yii::error($e->getMessage(), 'app.payment.refund');
            }
        }
    }
}
