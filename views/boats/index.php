<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 08.01.19
 * Time: 17:46
 */

/** @var \app\models\BoatsModel $boats */

$this->title = 'Аренда наших катеров';

?>

<div class="all-boats">
    <div class="row">
        <h1>Наши катера</h1>
        <hr>
    </div>

    <?php foreach($boats as $boat):?>
        <div class="row boat-item">
            <div class="col-xs-12 col-sm-4">
                <div class="boat-photo">
                    <a href="/boats/show/<?= $boat->slug ?>">
                        <img src="<?= (isset($boat->image))?Yii::$app->params['uploadsUrl'].'550X350/'. $boat->image->path:'/index.png'?>">
                    </a>
                    <div class="boat-price">От <?= \app\helpers\Utils::boatMinPrice($boat->getMinTariff()) ?></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8">
                <h4><?= $boat->name ?></h4>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="boat-character-title">Мощность</div>
                                <div class="boat-character-value"><?= $boat->engine_power ?></div>
                            </div>
                            <div class="col-xs-6">
                                <div class="boat-character-title">Пассажиров</div>
                                <div class="boat-character-value">  <?= $boat->spaciousness ?> чел.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="boat-character-title">Крейсерская скорость</div>
                                <div class="boat-character-value"><?= $boat->speed2 ?> </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="boat-character-title">Макс. скорость</div>
                                <div class="boat-character-value"><?= $boat->speed ?> </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-xs-6">
                                    <div class="boat-character-title">Длина</div>
                                    <div class="boat-character-value"><?= $boat->length ?> </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="boat-character-title">Ширина</div>
                                    <div class="boat-character-value"><?= $boat->width ?> </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="row boat-details-button">
                    <div class="col-xs-12 col-sm-offset-6 col-sm-6 col-md-offset-7 col-md-5">
                        <a class="btn btn-primary" href="/boats/show/<?= $boat->slug ?>">
                            Подробнее
                        </a>
                        <?php if(!Yii::$app->user->isGuest and Yii::$app->user->can("admin")): ?>
                            <a href="/boats/update?id=<?= $boat->id ?>">Редактировать</a>
                        <?php endif; ?>
                        <?php if(!Yii::$app->user->isGuest and Yii::$app->user->identity->isShipowner()): ?>
                            <a href="/admin/my-boat?id=<?= $boat->id ?>">Заблокировать</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <hr class="one">

    <?php endforeach; ?>
</div>
