<?php
/** @var \app\models\ServicesModel $services */
/** @var \app\models\OrdersModel $order */

use app\helpers\Utils;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="order-confirm">
    <h1>Подтверждение бронирования</h1>

    <?php if ($flash = Yii::$app->session->getFlash("order-error")): ?>

        <div class="alert alert-danger">
            <p><?= $flash ?></p>
        </div>

    <?php endif; ?>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <img src="/index.png" width="500px" height="300px">
        </div>
        <div class="col-md-6">
            <h3>Условия аренды</h3>

            <hr>

            <div class="characteristic">
                <span>Катер</span>
                <?= $order->boat->name ?>
            </div>
            <div class="characteristic">
                <span>Необходимо удостоверение</span>
                <?= $order->boat->certificate ?>
            </div>
            <div class="characteristic">
                <span>Аренда</span>
                XXXXXXXXXXXXXXXXX
            </div>
            <div class="characteristic">
                <span>Причал выдачи/сдачи</span>
                <?= $order->boat->location ?>
            </div>
        </div>
    </div>

    <div class="row">
        <h2>Дополнительные услуги</h2>

        <hr>

        <div class="services">
            <?php foreach ($services as $service): ?>
                <?php if (in_array($service->id, $order->getServicesId())):?>
                    <div class="service btn btn-default active" data-id="<?= $service->id ?>">
                        <i class="glyphicon glyphicon-ok"></i>
                        <?= $service->name ?>
                    </div>
                <?php else: ?>
                    <div class="service btn btn-default" data-id="<?= $service->id ?>">
                        <i class="glyphicon glyphicon-ok hidden"></i>
                        <?= $service->name ?>
                    </div>
                <?php endif; ?>

            <?php endforeach;?>
        </div>
    </div>

    <div class="row">
        <h2>Если у вас есть промокод, введите его здесь</h2>

        <hr>

        <div class="col-md-6">
            <input id="word" class="form-control" value="<?= (isset($order->promo->word))?$order->promo->word:'' ?>" placeholder="Промокод" style="height: 44px;">
        </div>
        <div class="col-md-3">
            <a id="promo-apply" class="btn btn-primary btn-block" style="height: 44px; line-height: 2em">Применить</a>
        </div>

    </div>

    <div id="toPay">
        <?= $this->render('_payBlock', compact('order', 'model')) ?>
    </div>

    <div class="row">
        <?php $form = ActiveForm::begin([
            'id' => 'pay-form',
            'action' => '/payment/pay',
            'enableAjaxValidation' => true,
        ]); ?>

        <?= $form->field($model, 'order_id')->hiddenInput(['value' => $order->id])->label(false)?>
        <?= $form->field($model, 'services')->hiddenInput(['value' => implode(',', $order->getServicesId())])->label(false)?>

        <div class="col-md-offset-3 col-md-6 text-center">
            <?= $form->field($model, 'offer_processing', [
                'template' => "{input}   Бронируя яхту, я принимаю договор оферты Bofort.ru {error}",
            ])->checkbox([], false)->label(false) ?>
        </div>
        <div class="col-md-offset-3 col-md-6 text-center">
            <?= Html::submitButton('Привязать карту', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>