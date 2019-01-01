<?php
/** @var \app\models\ServicesModel $services */
/** @var \app\models\OrdersModel $order */

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="order-confirm">
    <h1>Подтверждение бронирования</h1>

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
                <div class="service btn btn-default">
                    <?= $service->name ?>
                </div>
            <?php endforeach;?>
        </div>
    </div>

    <div class="row">
        <h2>Если у вас есть промокод, введите его здесь</h2>

        <hr>

        <div class="col-md-6">
            <input class="form-control" value="" placeholder="Промокод">
        </div>
    </div>

    <div class="row">
        <h2>К оплате</h2>

        <hr>

        <div class="col-md-12">
            <div class="row total-row">
                <div class="col-md-6"><span>Стоимость аренды яхты</span></div>
                <div class="col-md-6 text-right"><span><?= $order->boat->price ?></span></div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row total-row">
                <div class="col-md-6"><span> Скидки по акциям и промокодам</span></div>
                <div class="col-md-6 text-right"><span>0</span></div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row total-row">
                <div class="col-md-6"><span> Итого</span></div>
                <div class="col-md-6 text-right"><span><?= $order->price ?></span></div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php $form = ActiveForm::begin([
            'id' => 'pay-form',
            'action' => '/order/pay',
        ]); ?>

        <div class="col-md-offset-3 col-md-6 text-center">
            <?= $form->field($model, 'offer_processing', [
                'template' => "{input}   Бронируя яхту, я принимаю договор оферты Bofort.ru",
            ])->checkbox([], false)->label(false) ?>
        </div>
        <div class="col-md-offset-3 col-md-6 text-center">
            <?= Html::submitButton('Привязать карту', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>