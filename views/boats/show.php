<?php

use yii\helpers\Html;use yii\widgets\ActiveForm;

/** @var \app\models\BoatsModel $boat */
/** @var OrderCreateForm $model */
$this->title = $boat->name;

 ?>

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
            <img src="/<?= $boat->image->path ?>" width="555px" height="250px">
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
                <span>Располпжение причала . <a>Показать на карте</a></span>
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

</div>

<!--<script>-->
<!--    var myMap;-->
<!---->
<!--    // Дождёмся загрузки API и готовности DOM.-->
<!--    ymaps.ready(init);-->
<!---->
<!--    function init () {-->
<!--    // Создание экземпляра карты и его привязка к контейнеру с-->
<!--    // заданным id ("map").-->
<!--    myMap = new ymaps.Map('map', {-->
<!--    // При инициализации карты обязательно нужно указать-->
<!--    // её центр и коэффициент масштабирования.-->
<!--    center: [55.76, 37.64], // Москва-->
<!--    zoom: 10-->
<!--    }, {-->
<!--    searchControlProvider: 'yandex#search'-->
<!--    });-->
<!---->
<!--    document.getElementById('destroyButton').onclick = function () {-->
<!--    // Для уничтожения используется метод destroy.-->
<!--    myMap.destroy();-->
<!--    };-->
<!---->
<!--    }-->
<!--</script>-->