<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 15.01.19
 * Time: 20:14
 */

/** @var \app\models\OrdersModel $order */

use app\helpers\Utils;
$date_now = date_create();
?>


<button type="button" class="close" data-dismiss="modal">×</button>
<?php $path = isset($order->boat->image)?Yii::$app->params['uploadsUrl'].'550X350/'.$order->boat->image->path:'/index.png' ?>
<div class="cover" style="background-image: url('<?= $path?>')">
    <?php if ($order->state === 1 and $date_now > $order->datetime_to): ?>
        <span class="order-state btn btn-default">Заказ выполнен</span>
    <?php elseif ($order->state === 2): ?>
        <span class="order-state btn btn-default">Заказ отменен</span>
    <?php endif; ?>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 date-price">
            <i class="glyphicon glyphicon-calendar"></i>
            <span><?= $order->datetime_from .' - '. $order->datetime_to ?></span>
            <hr class="one">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="boat-character-title">Мощность</div>
            <div class="boat-character-value"><?= $order->boat->engine_power ?></div>

            <div class="boat-character-title">Пассажиров</div>
            <div class="boat-character-value"><?= $order->boat->spaciousness ?> чел.</div>

            <div class="boat-character-title">Длина</div>
            <div class="boat-character-value"><?= $order->boat->spaciousness ?></div>

            <div class="boat-character-title">Ширина</div>
            <div class="boat-character-value"><?= $order->boat->width ?></div>
        </div>
        <div class="col-sm-6">
            <div class="boat-character-title">Крейсерская скорость</div>
            <div class="boat-character-value"><?= $order->boat->speed2 ?></div>

            <div class="boat-character-title">Макс. скорость</div>
            <div class="boat-character-value"><?= $order->boat->speed ?></div>

            <div class="boat-character-title">Расположение причала &bull; <a id="showLocation">Показать на карте</a></div>
            <div class="boat-character-value"><?= $order->boat->location_name ?></div>
    </div>

    <hr class="margin-10 margin-bottom-0">

    <div class="row">
        <div class="col-md-12 order-summary">
            <table class="table">
                <tr>
                    <th class="width-20">Стоимость аренды яхты</th>
                    <td><?= $order->count_hours?> ч.</td>
                    <td class="text-right coast"><?=Utils::userPrice($order->price) ?></td>
                </tr>
                <?php if(!empty($order->services)): ?>
                    <tr>
                        <th class="width-20">Дополнительные услуги</th>
                        <?php foreach ($order->services as $service) :?>
                            <td><?= $service->name?></td>
                        <?php endforeach; ?>
                        <td class="text-right coast"><?= Utils::userPrice($order->getServicesPrice()) ?></td>
                    </tr>
                <?php endif; ?>
                <?php if($order->discount): ?>
                    <tr>
                        <th class="width-20">Скидки по акциям и промокодам</th>
                        <?php if(isset($order->promo->word)): ?>
                            <td><?= $order->promo->word ?></td>
                        <?php endif; ?>
                        <td class="text-right coast red">- <?= Utils::userPrice($order->discount) ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th class="width-20">Итого</th>
                    <td></td>
                    <td class="text-right coast"><?= Utils::userPrice($order->totalPrice()) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <?php if ($order->state === 1 and $order->datetime_from >= $date_now): ?>
        <div class="row buttons">
            <div class="col-xs-12">
                <a data-id="<?=$order->id?>" class="btn btn-default btn-block order-refund-modal">Отменить бронирование</a>
            </div>
        </div>
    <?php endif; ?>

</div>


<script>
    $(document).ready(function(){
        ymaps.ready(init);

        function init () {
            var myMap;

            $('#showLocation').click(function () {

                var lat = "<?= $order->boat->lat ?>";
                var long = "<?= $order->boat->long ?>";

                myMap = new ymaps.Map('yandex-map', {
                    center: [lat, long],
                    zoom : 15
                });

                var myGeoObject = new ymaps.GeoObject({
                    geometry: {
                        type: "Point",
                        coordinates: [lat, long]
                    }
                });

                myMap.geoObjects.add(myGeoObject);

                $('#map').modal({show:true});
            });

            $('#map .close').on('click', function(){
                myMap.destroy();
            });
        }
    });

</script>
