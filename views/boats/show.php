<?php

use app\helpers\Utils;
use yii\bootstrap\Carousel;
use yii\helpers\Html;use yii\widgets\ActiveForm;

/** @var \app\models\BoatsModel $boat */
/** @var OrderCreateForm $model */
$this->title = $boat->name;

 ?>


<div class="row">
    <div class="col-md-9">
        <h1><?= $boat->h1 ?></h1>
    </div>
    <div class="col-md-3" style="margin-top: 20px">
        <a class="btn btn-primary" href="/boats/index">Посмотреть другие</a>
    </div>
</div>
<hr>
<div class="row boat-item">
    <div class="col-xs-12 col-sm-6">
        <div class="boat-photo">
            <img  src="<?= (isset($boat->image))?Yii::$app->params['uploadsUrl'].'550X350/'.$boat->image->path:'/index.png' ?>" class="show-carousel-modal">
            <div class="boat-price">от <?= \app\helpers\Utils::boatMinPrice($boat->getMinTariff()) ?></div>
            <div class="boat-photo-icon show-carousel-modal">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true"
                        focusable="false"
                        width="1.72em"
                        height="1.7em"
                        style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                        preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 1040 1024"
                >
                    <path
                            d="M1031 969L748 684q97-116 97-267 0-85-33-162t-88.5-133T591 33 429 0Q316 0 220 55.5T68.5 207 13 416.5 68.5 626 220 777.5 429 833q156 0 274-103l282 284q4 4 8.5 6.5t9.5 3 10 0 9.5-3 8.5-6.5q9-9 9-22.5t-9-22.5zM429 768q-96 0-177-47.5T124 592 77 416t47-176 128-128.5T428.5 64 605 111.5 733.5 240 781 416q0 141-98 243-97 101-236 109h-18zm160-384H461V256q0-13-9.5-22.5t-23-9.5-22.5 9.5-9 22.5v128H269q-14 0-23 9.5t-9 22.5 9 22.5 23 9.5h128v128q0 13 9 22.5t22.5 9.5 23-9.5T461 576V448h128q13 0 22.5-9.5T621 416t-9.5-22.5T589 384z"
                            fill="#ffffff"
                    />
                </svg>
            </div>
            <?php if (count($boat->images) > 1):?>
                <div class="boat-photo-buttons show-carousel-modal">
                    <?php foreach ($boat->images as $image): ?>
                        <div class="boat-photo-button">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <?= $boat->description ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h2>Тарифная сетка</h2>
    </div>
</div>
<hr>


<div class="row">
    <div class="col-md-6 tarif">
        <table class="table">
            <tr class="no-border">
                <td colspan="2">
                    <h4>Будние дни</h4>
                    с 7:00 до 20:00
                </td>
            </tr>
            <tr class="no-border">
                <th class="width-20">От 1 до 3х часов</th>
                <td class="text-center"><?= Utils::boatMinPrice($boat->tariff->weekday)?></td>
            </tr>
            <tr>
                <th class="width-20">От 3х часов</th>
                    <td class="text-center green"><?= Utils::boatMinPrice($boat->tariff->four_hours_weekday)?></td>
            </tr>
            <tr>
                <th class="width-20">Сутки</th>

                    <td class="text-center"><?= $boat->tariff->one_day*24 ?> руб./сутки</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6 tarif">
        <table class="table">
            <tr class="no-border">
                <td colspan="2">
                    <h4 class="red">Выходные и праздничные дни</h4>
                    с 7:00 до 20:00
                </td>
            </tr>
            <tr class="no-border">
                <th class="width-20">От 1 до 3х часов</th>

                <td class="text-center"><?= Utils::boatMinPrice($boat->tariff->holiday)?></td>

            </tr>
            <tr>
                <th class="width-20">От 3х часов</th>

                <td class="text-center"><?= Utils::boatMinPrice($boat->tariff->four_hours_holiday)?></td>

            </tr>
            <tr>
                <th class="width-20">Сутки</th>

                <td class="text-center"><?= $boat->tariff->one_day*24 ?> руб./сутки</td>

            </tr>
        </table>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <h2>Характеристики</h2>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-sm-6">
        <div class="boat-character-title">Мощность</div>
        <div class="boat-character-value"><?= $boat->engine_power ?></div>

        <div class="boat-character-title">Пассажиров</div>
        <div class="boat-character-value"><?= $boat->spaciousness ?> чел.</div>

        <div class="boat-character-title">Длина</div>
        <div class="boat-character-value"><?= $boat->length ?> </div>

        <div class="boat-character-title">Ширина</div>
        <div class="boat-character-value"><?= $boat->width ?></div>
    </div>
    <div class="col-sm-6">
        <div class="boat-character-title">Крейсерская скорость</div>
        <div class="boat-character-value"><?= $boat->speed2 ?></div>

        <div class="boat-character-title">Макс. скорость</div>
        <div class="boat-character-value"><?= $boat->speed ?></div>

        <div class="boat-character-title">Расположение причала &bull; <a data-lat="<?= $boat->lat ?>" data-long="<?= $boat->long ?>" class="showLocation">Показать на карте</a></div>
        <div class="boat-character-value"><?= $boat->location_name ?></div>

        <?php
        /*
             <div class="characteristic">
                <span>Доступны дополнительные услуги</span>
                <?php if($boat->services):
                        echo implode(', ', $boat->getServicesName());
                endif; ?>
    </div> */
        ?>

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
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div id="carousel" class="carousel" data-ride="carousel">


                <ol class="carousel-indicators">
                    <?php
                    $items = 'active';
                    foreach ($boat->images as $key => $image) {
                        echo "<li data-target='#carousel' data-slide-to='$key' class='$items'>
                                  <img src='".Yii::$app->params['uploadsUrl']."1080X720/$image->path'></li>";
                        $items = '';
                    }
                    ?>
                </ol>


                <div class="carousel-inner" role="listbox">

                    <?php
                    $items = 'active';
                    foreach ($boat->images as $image) {
                        echo "<div class='item $items'>
                                  <img src='".Yii::$app->params['uploadsUrl']."1080X720/$image->path'></div>";
                        $items = '';
                    }
                    ?>

                </div>


                <a class="left carousel-control" href="#carousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </div>
</div>

<?= $this->render('_map') ?>

<script>
    $(function() {
        $('.show-carousel-modal').click(function() {
            $('#carousel-modal').modal('show');
        })
        document.onkeydown = function(e) {
            if (document.getElementById('carousel-modal').style.display !== 'block') {
                console.log('return')
                return;
            }
            e = e || window.event;
            if (e.keyCode == '37') {
                $("#carousel").carousel("prev");
            }
            else if (e.keyCode == '39') {
                $("#carousel").carousel("next");
            }
        }
    })
</script>


