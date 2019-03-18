<?php

use yii\bootstrap\Carousel;
use yii\helpers\Html;use yii\widgets\ActiveForm;

/** @var \app\models\BoatsModel $boat */
/** @var OrderCreateForm $model */
$this->title = $boat->name;

 ?>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2aeecb33-cd8c-4662-b7bf-9f211f9c4896" type="text/javascript"></script>
<div class="boat-show">
    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-offset-3 col-md-3" style="margin-top: 20px">
            <a class="btn btn-default" href="/boats/index">Посмотреть другие</a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6 boat-show-img">
            <img src="<?= (isset($boat->image))?Yii::$app->params['uploadsUrl'].'550X350/'.$boat->image->path:'/index.png' ?>" id="show-carousel-modal">
            <span class="label label-default"><?= $boat->tariff->weekday ?></span>
        </div>
        <div class="col-md-6">
            <?= $boat->description ?>
        </div>
    </div>

    <?php
    /* Вот список характеристик лодки. Пользуй как хочешь через стрелочку $boat->...
            $name,
            $description,
            $engine_power,
            $spaciousness,
            $location_name,
            $lat,
            $long,
            $width,
            $length,
            $speed,
            $speed2,
    */
    ?>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-6">
            <h4>Характеристики</h4>
            <hr>
            <div class="characteristic">
                <span>Мощность двигателей</span>
                <?= $boat->engine_power ?>
            </div>
            <div class="characteristic">
                <span>Количество пассажиров</span>
                <?= $boat->spaciousness ?>
            </div>
            <div class="characteristic">
                <span>Длина</span>
                <?= $boat->length ?>
            </div>
            <div class="characteristic">
                <span>Ширина</span>
                <?= $boat->width ?>
            </div>
        </div>
        <div class="col-md-6">
            <h4>Условия аренды</h4>
            <hr>
            <div class="characteristic">
                <span>Крейсерская скорость</span>
                <?= $boat->speed ?>
            </div>
            <div class="characteristic">
                <span>Макс. скорость</span>
                <?= $boat->speed2 ?>
            </div>
            <div class="characteristic">
                <span>Располпжение причала . <a id="showLocation">Показать на карте</a></span>
                <?= $boat->location_name ?>
            </div>
            <?php /*
            <div class="characteristic">
                <span>Доступны дополнительные услуги</span>
                <?php if($boat->services):
                        echo implode(', ', $boat->getServicesName());
                endif; ?>
            </div>
            */?>

             <?php $form = ActiveForm::begin([
                    'id' => 'order-create-form',
                    'action' => '/order/create',
             ]); ?>
            <?= $form->field($model, 'boat_id')->hiddenInput(['value' => $boat->id])->label(false)?>

            <?php if (Yii::$app->user->isGuest) : ?>
                <?= Html::button('Забронировать яхту', ['class' => 'btn btn-primary btn-block', 'id' => 'login-button']) ?>
            <?php else: ?>
                <?= Html::submitButton('Забронировать яхту', ['class' => 'btn btn-primary btn-block']) ?>
            <?php endif; ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="modal fade" id="carousel-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <?php
                        $items = [];
                        foreach ($boat->images as $image) {
                            $items[] = [
                                'content' => '<img src="'.Yii::$app->params['uploadsUrl'].'550X350/'.$image->path.'">',
                            ];
                        }

                        echo Carousel::widget([
                            'items' => $items,
                            'options' => [
                                'style' => 'width:100%;',
                                'interval' => false
                            ]
                        ]);
                    ?>

                </div>
            </div>
        </div>
    </div>

    <?= $this->render('_map') ?>
</div>

<script>
    $(document).ready(function(){
        ymaps.ready(init);

        function init () {
            var myMap;

            $('#showLocation').click(function () {

                var lat = "<?= $boat->lat ?>";
                var long = "<?= $boat->long ?>";

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