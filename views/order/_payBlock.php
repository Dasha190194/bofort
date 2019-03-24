<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 04.01.19
 * Time: 12:33
 */

/** @var \app\models\OrdersModel $order */

use app\helpers\Utils;
$total = $order->totalPrice();

?>

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
            <th class="width-20">Итого</th>
            <td></td>
            <td class="text-right coast"><?= Utils::userPrice($total) ?></td>
        </tr>
    </table>
</div>
