<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 17.03.19
 * Time: 7:09
 */

/** @var \app\models\OrdersModel $order */
/** @var int $money */

use app\helpers\Utils;
use yii\helpers\Html;

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Отмена бронирования #<?= $order->id ?></h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <p>Вы уверены, что хотите отменить бронировнаие? Мы удержим штраф в сумме <?= Utils::userPrice($money)?></p>
            <p>Катер станет доступным для брони в эти даты. Это нельзя отменить.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= Html::button('Да, отменить бронирование', ['class' => 'btn btn-default btn-block order-refund', 'data-id' => $order->id])?>
        </div>
        <div class="col-md-6">
            <?= Html::button('Нет, я передумал.', ['class' => 'btn btn-primary btn-block order-refund-no'])?>
        </div>
    </div>
</div>
