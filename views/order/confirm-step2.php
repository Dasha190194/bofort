<?php
/** @var \app\models\ServicesModel $services */
/** @var \app\models\OrdersModel $order */

use app\helpers\Utils;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>

<div class="row">
    <div class="col-md-12">
        <h1>Подтверждение бронирования</h1>
    </div>
</div>
<hr>
<div class="row boat-item">
    <div class="col-xs-12 col-sm-6">
        <div class="boat-photo">
            <img src="<?= (isset($order->boat->image))?Yii::$app->params['uploadsUrl'].'250X150/'.$order->boat->image->path:'/index.png' ?>">
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

<?php if(!empty($services)): ?>
    <div class="row">
        <div class="col-md-12">
            <h3>Выберите дополнительные услуги</h3>
            <hr class="margin-10">
        </div>
    </div>
    <div class="row services">
        <?php foreach ($services as $service): ?>
            <div class="col-md-6">
                <div class="service btn btn-default" data-id="<?= $service->id ?>">
                    <div class="chechbox">
                        <i class="glyphicon glyphicon-ok"></i>
                    </div>
                    <?= $service->name ?>
                    <i class="info glyphicon glyphicon-info-sign"
                       data-toggle="popover"
                       data-content="Мы гарантируем что в яхте не будет серьезых пробоин"
                       data-placement="top"
                       data-trigger="hover"
                    ></i>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <h3>Если у вас есть промокод, введите его здесь</h3>
        <hr class="margin-10">
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6 promo">
        <input id="word" class="form-control" value="<?= (isset($order->promo->word))?$order->promo->word:'' ?>" placeholder="Промокод" style="height: 44px;">
        <?php if(isset($order->promo->word)): ?>
            <i class="glyphicon glyphicon-ok"></i>
        <?php endif; ?>
    </div>
    <div class="col-xs-12 col-md-3 promo-button">
        <button id="promo-apply" class="btn btn-default">Применить</button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3>К оплате</h3>
        <hr class="margin-10 margin-bottom-0">
    </div>
</div>


<div id="toPay" class="row">
    <?= $this->render('_payBlock', compact('order', 'model')) ?>
</div>


<div class="row">
    <div class="col-sm-offset-1 col-sm-10">
        <hr class="line">
    </div>
</div>

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
                    location.replace('/order/final');
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
                            case 'charge': location.replace('/order/final'); break;
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


<div class="modal fade" id="phone-confirm-order" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>