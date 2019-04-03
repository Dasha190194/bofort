<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 09.02.19
 * Time: 13:31
 */

use app\helpers\Utils;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Катер забронирован</h1>
        </div>
    </div>
    <hr>

    <div class="row boat-item">
        <div class="col-sm-12">
            <p>Спасибо за Ваше бронирование! При желании Вы можете его отменить в <a href="/user/profile">личном кабинете</a> в разделе «История бронирования».</p>
            <p>Внимание! Приезжайте за 30 минут до начала аренды на причал, где находится судно. Вам нужно иметь при себе паспорт РФ, а в случае самостоятельного управления судном, то и удостоверение на управление маломерными судами ГИМС с открытым районом плавания «внутренние водные пути».</p>
        </div>
    </div>
    <hr>

    <div class="row boat-item">
        <div class="col-xs-12 col-sm-6">
            <div class="boat-photo">
                <img src="<?= (isset($order->boat->image))?Yii::$app->params['uploadsUrl'].'550X350/'.$order->boat->image->path:'/index.png' ?>">
                <span class="btn btn-danger">Катер забронирован</span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <h4>Условия аренды</h4>
            <hr class="one margin-10">
            <div class="boat-character-title">Катер</div>
            <div class="boat-character-value"><?= $order->boat->name ?></div>

            <div class="boat-character-title">Аренда</div>
            <div class="boat-character-value"><?= Utils::userDate(strtotime($order->datetime_from)) . ' - ' . Utils::userDate(strtotime($order->datetime_to)) ?></div>

            <div class="boat-character-title">Причал выдачи/сдачи</div>
            <div class="boat-character-value"><?= $order->boat->location_name ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Детали заказа</h3>
            <hr class="margin-10 margin-bottom-0">
        </div>
    </div>

    <div id="toPay" class="row">
        <div class="col-md-12 order-summary">
            <table class="table">
                <tr>
                    <th class="width-20">Стоимость аренды яхты</th>
                    <td><?= $order->count_hours ?> ч.</td>
                    <td class="text-right coast"><?=Utils::userPrice($order->price) ?></td>
                </tr>
                <?php if(!empty($order->services)): ?>
                    <tr>
                        <th class="width-20">Дополнительные услуги</th>
                        <?php foreach ($order->services as $service) :?>
                            <td><?= $service->name . ' '?></td>
                        <?php endforeach; ?>
                        <td class="text-right coast"><?= Utils::userPrice($order->getServicesPrice()) ?></td>
                    </tr>
                <?php endif; ?>
                <?php if($order->discount != 0): ?>
                    <tr>
                        <th class="width-20">Скидки по акциям и промокодам</th>
                        <td>
                            <?php if(isset($order->promo->word)): ?>
                                <?= $order->promo->word ?>
                            <?php endif; ?>
                        </td>
                        <td class="text-right coast red">- <?= Utils::userPrice($order->discount) ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <?php if (isset($order->transaction) and $order->transaction->state == 1): ?>
                        <th class="width-20">Итого</th>
                        <td>
                            <span class="green">Оплачено</span>
                            &bull;
                            <span class="grey">Карта VISA</span>
                        </td>
                        <td class="text-right coast"><?= Utils::userPrice($order->totalPrice()) ?></td>
                    <?php else: ?>
                        <th class="width-20">Итого</th>
                        <td>
                            <span class="red">Оплата не прошла</span>
                        </td>
                        <td class="text-right coast"><?= Utils::userPrice($order->totalPrice()) ?></td>
                    <?php endif; ?>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-offset-1 col-sm-10">
            <hr class="line">
        </div>
    </div>

    <?php if (isset($order->transaction)): ?>

        <?php if ($order->transaction->state != 1): ?>

            <div class="row">
                <?php $form = ActiveForm::begin([
                    'id' => 'pay-form',
                    'action' => '/payment/pay-validate',
                    'enableAjaxValidation' => true,
                ]); ?>
                <?= $form->field($model, 'order_id')->hiddenInput(['value' => $order->id])->label(false)?>
                <?= $form->field($model, 'services')->hiddenInput(['value' => implode(',', $order->getServicesId())])->label(false)?>

                <div class="col-md-offset-3 col-md-6 text-center offer">
                    <?= $form->field($model, 'offer_processing', [
                        'template' => "{input}   Бронируя яхту, я принимаю <a target='_blank' href='/uploads/oferta.pdf'>договор оферты Bofort.ru </a> {error}",
                    ])->checkbox([], false)->label(false) ?>
                </div>
                <div class="col-md-offset-3 col-md-6 text-center">
                    <?= Html::submitButton('Оплата банковской картой', ['class' => 'btn btn-warning btn-block']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

            <script>
                $(function() {
                    $('[data-toggle="popover"]').popover();
                })
            </script>


            <script>

                $(document).ready(function () {

                    const cloud_id = "<?= Yii::$app->params['cloud_id'] ?>";
                    var isset_phone = "<?= (empty(Yii::$app->user->identity->phone))?0:1 ?>";

                    function pay(order_id, total_price, user_id) {
                        var widget = new cp.CloudPayments();
                        widget.charge({
                                publicId: cloud_id,
                                description: 'Оплата заказа',
                                amount: total_price,
                                currency: 'RUB',
                                invoiceId: order_id,
                                accountId: user_id,
                            },
                            function (options) {
                                location.replace('/order/final?id='+order_id);
                            },
                            function (reason, options) {
                                alert(reason);
                                location.reload();
                            });
                    };

                    $('#pay-form').on('afterValidate', function (event, messages) {

                        if (isset_phone === '0' && messages['payform-offer_processing'].length == 0) {
                            $.ajax({
                                url: '/default/confirm-phone',
                                type: 'GET',
                                async: false,
                                success: function (data) {
                                    $('#phone-confirm-order .modal-content').html(data);
                                    $('#phone-confirm-order').modal({show:true});
                                }
                            });
                        } else {
                            submit($('#pay-form'));
                        }

                        return false;
                    });

                    $('body').on('click', '#send-code', function(){

                        $.ajax({
                            url: '/default/confirm-phone',
                            type: 'POST',
                            data: {'phone': $('#phone').val() },
                            success: function (request) {
                                if (request.success == true) {
                                    $('#phoneconfirmform-phone').val(request.phone);
                                }
                            }
                        });
                    });

                    $("#phone-confirm-order").on('submit', '#confirm-phone', (function(e) {
                        e.preventDefault();

                        var form = $(this);
                        var url = form.attr('action');

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: form.serialize(),
                            success: function(data) {
                                if (data.success === true) {
                                    $('#phone-confirm-order').modal('hide');
                                    submit($('#pay-form'));
                                } else {
                                    $('#code-error').html('Неверный код!');
                                }
                            }
                        });
                    }));


                    function submit(el) {
                        var data = el.serialize();

                        $.ajax({
                            url: '/payment/pay',
                            data: data,
                            type: 'POST',
                            async: false,
                            success: function (request) {
                                if (request.success) {
                                    switch (request.action) {
                                        case 'charge': location.replace('/order/final?id=<?= $order->id ?>'); break;
                                        case 'frame':  pay(request.data.order_id, request.data.total_price, request.data.user_id); break;
                                    }
                                } else {
                                    if (request.action === 'charge') {
                                        alert(request.data);
                                    }
                                }
                            }
                        });
                    }


                    $('#pay-form').on('beforeSubmit', function () {
                        return false;
                    });


                });

            </script>

        <?php endif; ?>
    <?php else: ?>
        <p>К сожалению, оплата в банке еще не прошла. </p>
    <?php endif; ?>
</div>

