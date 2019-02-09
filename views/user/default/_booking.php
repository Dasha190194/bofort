<?php
/** @var \app\models\OrdersModel $orders */

use app\helpers\Utils;

$date_now = date_create();
//date_modify($date_now, '+1 day');
//echo date_format($date, 'Y-m-d');
?>

<div class="profile-container booking-container hidden">

    <h2>Текущее бронирование</h2>
    <?php foreach ($orders as $order): ?>
        <?php if($order->state === 1 and $order->datetime_from < $date_now): ?>
            <div class="panel panel-default">
                <div class="panel-title">
                    <img class="card-img-top" src="/index.png" width="748px" height="340px">
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <span><?= $order->datetime_from .' - '. $order->datetime_to ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="pull-right"> <?= $order->price ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-6 col-md-6">
                            <span class="pull-right">Карта VISA</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <a data-id="<?= $order->id?>" class="btn btn-default btn-block order-refund">Отменить бронирование</a>
                        </div>
                        <div class="col-md-6">
                            <a data-id="<?= $order->id?>" class="btn btn-primary btn-block order-more-info">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <hr>

    <h2>История аренды</h2>
        <?php foreach ($orders as $order): ?>
            <?php if(($order->state === 1 and $order->datetime_from > $date_now) or ($order->state === 2)): ?>
                <div class="panel-orders-history panel panel-default">
                    <div class="panel-title">
                        <img src="/<?= $order->boat->image->path ?>" width="748px" height="340px">
                        <?php if ($order->state === 1): ?>
                            <span class="order-state">Заказ выполнен</span>
                        <?php else: ?>
                            <span class="order-state">Заказ отменен</span>
                        <?php endif; ?>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <span><?= $order->datetime_from .' - '. $order->datetime_to ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="pull-right"> <?= Utils::userPrice($order->price) ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-6 col-md-6">
                                <span class="pull-right">Карта VISA</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-primary btn-block order-more-info">Подробнее</a>
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
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>