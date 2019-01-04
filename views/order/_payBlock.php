<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 04.01.19
 * Time: 12:33
 */

/** @var \app\models\OrdersModel $order */

use app\helpers\Utils;

?>

<div class="row">
        <h2>К оплате</h2>

        <hr>

        <div class="col-md-12">
            <div class="row total-row">
                <div class="col-md-6"><span>Стоимость аренды яхты</span></div>
                <div class="col-md-6 text-right"><span><?=Utils::userPrice($order->boat->price) ?></span></div>
            </div>
        </div>

        <?php if(!empty($order->services)): ?>
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
        <?php endif; ?>

        <div class="col-md-12">
            <div class="row total-row">
                <div class="col-md-6"><span> Скидки по акциям и промокодам</span></div>
                <div class="col-md-6 text-right"><span>- <?= Utils::userPrice($order->discount) ?></span></div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row total-row">
                <div class="col-md-6"><span> Итого</span></div>
                <div class="col-md-6 text-right"><span><?= Utils::userPrice($order->totalPrice()) ?></span></div>
            </div>
        </div>
</div>

