<?php

/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 06.02.19
 * Time: 21:14
 */

namespace app\helpers\CloudPayments;

use yii\base\Model;

class InputPayAnswer extends Model
{
    public $transactionId;
    public $amount;
    public $currency;
    public $dateTime;
    public $cardFirstSix;
    public $cardLastFour;
    public $cardType;
    public $cardExpDate;
    public $status;
    public $invoiceId;
    public $accountId;
    public $token;

    public function rules()
    {
        return [
            [['transactionId','amount','currency','dateTime','cardFirstSix','cardLastFour','cardType','cardExpDate','status','invoiceId','accountId','token'],'optional']
        ];
    }

    static function collect() {
        $out = new self;
        $out->transactionId = \Yii::$app->getRequest()->getBodyParam('TransactionId');
        $out->amount = \Yii::$app->getRequest()->getBodyParam('Amount');
        $out->currency = \Yii::$app->getRequest()->getBodyParam('Currency');
        $out->dateTime = \Yii::$app->getRequest()->getBodyParam('DateTime');
        $out->cardFirstSix = \Yii::$app->getRequest()->getBodyParam('CardFirstSix');
        $out->cardLastFour = \Yii::$app->getRequest()->getBodyParam('CardLastFour');
        $out->cardType = \Yii::$app->getRequest()->getBodyParam('CardType');
        $out->cardExpDate = \Yii::$app->getRequest()->getBodyParam('CardExpDate');
        $out->status = \Yii::$app->getRequest()->getBodyParam('Status');
        $out->invoiceId = \Yii::$app->getRequest()->getBodyParam('InvoiceId');
        $out->accountId = \Yii::$app->getRequest()->getBodyParam('AccountId');
        $out->token = \Yii::$app->getRequest()->getBodyParam('Token');
        return $out;
    }

}