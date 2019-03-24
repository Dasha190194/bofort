<?php
/** @var \app\models\OrdersModel $orders */

use app\helpers\Utils;

$date_now = date_create();
//date_modify($date_now, '+1 day');
//echo date_format($date, 'Y-m-d');
?>

<div class="profile-container booking-container">

    <h3>Текущее бронирование</h3>
    <?php foreach ($orders as $order): ?>
        <?php if($order->state === 1 and $order->datetime_from < $date_now): ?>
            <div class="panel panel-default">
                <?php $path = isset($order->boat->image)?Yii::$app->params['uploadsUrl'].'1080X720/'.$order->boat->image->path:'/index.png'; ?>
                <div class="panel-title" style="background-image: url('<?= $path ?>')">
                    <span class="btn btn-danger">Катер забронирован</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 date-price">
                            <span><?= $order->datetime_from .' - '. $order->datetime_to ?></span>
                        </div>
                        <div class="col-md-6 date-price text-right">
                            <span> <?= Utils::userPrice($order->price) ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-6 col-md-6 grey text-right">
                            <span>Карта VISA</span>
                        </div>
                    </div>
                    <div class="row buttons">
                        <div class="col-xs-6">
                            <a data-id="<?= $order->id?>" class="btn btn-default btn-block order-refund-modal">Отменить бронирование</a>
                        </div>
                        <div class="col-xs-6">
                            <a data-id="<?= $order->id?>" class="btn btn-primary btn-block order-more-info">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <hr />

    <h3>История аренды</h3>
    <?php foreach ($orders as $order): ?>
        <?php if(($order->state === 1 and $order->datetime_from > $date_now) or ($order->state === 2)): ?>
            <div class="panel-orders-history panel panel-default">
                <?php $path = isset($order->boat->image)?Yii::$app->params["uploadsUrl"].'1080X720/'.$order->boat->image->path:'/index.png'; ?>
                <div class="panel-title" style="background-image: url('<?=  $path ?>')">
                    <?php if ($order->state === 1): ?>
                        <span class="order-state btn btn-default">Заказ выполнен</span>
                    <?php else: ?>
                        <span class="order-state btn btn-default">Заказ отменен</span>
                    <?php endif; ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 date-price">
                            <span><?= $order->datetime_from .' - '. $order->datetime_to ?></span>
                        </div>
                        <div class="col-md-6 date-price text-right">
                            <span> <?= Utils::userPrice($order->price) ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-6 col-md-6 grey text-right">
                            <span>Карта Mastercard</span>
                        </div>
                    </div>
                    <div class="row buttons">
                        <div class="col-md-12">
                            <a data-id="<?= $order->id?>" data-toggle="modal" data-target="#order-info-modal" class="btn btn-primary btn-block order-more-info">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

</div>


<div class="modal fade" id="order-info-modal" role="dialog">
    <div class="modal-dialog" style="width: 780px;">
        <div class="modal-content">

        </div>
    </div>
</div>


