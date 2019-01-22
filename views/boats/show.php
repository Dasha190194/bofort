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
            <img src="/<?= (isset($boat->image))?$boat->image->path:'index.png' ?>" width="555px" height="350px" id="show-carousel-modal">
            <span class="label label-default"><?= $boat->price ?></span>
        </div>
        <div class="col-md-6">
            <?= $boat->description ?>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-6">
            <h4>Характеристики</h4>
            <hr>
            <div class="characteristic">
                <span>Имя катера</span>
                <?= $boat->name ?>
            </div>
            <div class="characteristic">
                <span>Мощность двигателей</span>
                <?= $boat->engine_power ?>
            </div>
            <div class="characteristic">
                <span>Количество пассажиров</span>
                <?= $boat->spaciousness ?>
            </div>
        </div>
        <div class="col-md-6">
            <h4>Условия аренды</h4>
            <hr>
            <div class="characteristic">
                <span>Необходимое удостоверение</span>
                <?= $boat->name ?>
            </div>
            <div class="characteristic">
                <span>Располпжение причала . <a id="showLocation">Показать на карте</a></span>
                <?= $boat->location ?>
            </div>
            <div class="characteristic">
                <span>Доступны дополнительные услуги</span>
                XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
            </div>

             <?php $form = ActiveForm::begin([
                    'id' => 'order-create-form',
                    'action' => '/order/create',
             ]); ?>
            <?= $form->field($model, 'boat_id')->hiddenInput(['value' => $boat->id])->label(false)?>
             <?= Html::submitButton('Забронировать яхту', ['class' => 'btn btn-primary btn-block']) ?>

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
                                'content' => '<img src="/'.$image->path.'" style="width:555px;height:350px;">',
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

                var location = "<?= $boat->location ?>";
                ymaps.geocode(location).then(function (res) {
                    myMap = new ymaps.Map('yandex-map', {
                        center: res.geoObjects.get(0).geometry.getCoordinates(),
                        zoom : 13
                    });
                });

                $('#map').modal({show:true});
            });

            $('#map .close').on('click', function(){
                myMap.destroy();
            });
        }
    });

</script>