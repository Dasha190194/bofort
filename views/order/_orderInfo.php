<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 15.01.19
 * Time: 20:14
 */

/** @var \app\models\OrdersModel $order */

use app\helpers\Utils; ?>

<div>
    <img src="/<?= $order->boat->image->path ?>" width="748px" height="340px">
    <?php if ($order->state === 1): ?>
        <span class="order-state">Заказ выполнен</span>
    <?php else: ?>
        <span class="order-state">Заказ отменен</span>
    <?php endif; ?>
</div>
<div class="row">
    <span><?= $order->datetime_from .' - '. $order->datetime_to ?></span>
</div>
<div class="row">
    <div class="characteristic">
        <span>Имя катера</span>
        <?= $order->boat->name ?>
    </div>
</div>
<div class="row">
    <div class="characteristic">
        <span>Мощность двигателей</span>
        <?= $order->boat->engine_power ?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="row total-row">
            <div class="col-md-6"><span>Стоимость аренды яхты</span></div>
            <div class="col-md-6 text-right"><span><?=Utils::userPrice($order->boat->price) ?></span></div>
        </div>
    </div>
</div>

<?php if(!empty($order->services)): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row total-row">
                <div class="col-md-3"><span>Дополнительные услуги</span></div>
                <div class="col-md-6">
                    <?php foreach ($order->services as $service) :?>
                        <?= $service->name . ' '?>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-3 text-right"><span><?= Utils::userPrice($order->getServicesPrice()) ?></span></div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if($order->discount): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row total-row">
                <div class="col-md-6"><span> Скидки по акциям и промокодам</span></div>
                <div class="col-md-6 text-right"><span>- <?= Utils::userPrice($order->discount) ?></span></div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <div class="row total-row">
            <div class="col-md-6"><span> Итого</span></div>
            <div class="col-md-6 text-right"><span><?= Utils::userPrice($order->totalPrice()) ?></span></div>
        </div>
    </div>
</div>
