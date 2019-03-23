<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 08.01.19
 * Time: 17:46
 */

/** @var \app\models\BoatsModel $boats */

?>

<div class="all-boats">
    <div class="row">
        <h1>Наши катера</h1>
        <hr>
    </div>

    <?php foreach($boats as $boat):?>


    <?php /*
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4 boat-show-img">
                <img src="<?= (isset($boat->image))?Yii::$app->params['uploadsUrl'].'350X200/'. $boat->image->path:'/index.png'?>">
                <span class="label label-default"><?= $boat->tariff->weekday ?></span>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <?= $boat->name ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $boat->description ?>
                    </div>
                </div>
               <div class="row">
                   <div class="col-md-6">
                       <div class="characteristic">
                           <span>Мощность двигателей</span>
                           <?= $boat->engine_power ?>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="characteristic">
                           <span>Количество пассажиров</span>
                           <?= $boat->spaciousness ?>
                       </div>
                   </div>
               </div>
                <div class="row">
                    <a class="btn btn-default" href="/boats/show/<?= $boat->slug ?>">
                        Подробнее
                    </a>
                    <?php if(Yii::$app->user->can("admin")): ?>
                        <a href="/boats/update?id=<?= $boat->id ?>">Редактировать</a>
                    <?php endif; ?>
                    <?php if(!Yii::$app->user->isGuest and Yii::$app->user->identity->isShipowner()): ?>
                        <a href="/admin/my-boat?id=<?= $boat->id ?>">Заблокировать</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    */?>

        <div class="row boat-item">
            <div class="col-xs-12 col-sm-4">
                <div class="boat-photo">
                    <img src="<?= (isset($boat->image))?Yii::$app->params['uploadsUrl'].'250X150/'. $boat->image->path:'/index.png'?>">
                    <div class="boat-price"><?= $boat->tariff->weekday ?></div>
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
                    </div>
                </div>
                <div class="row boat-details-button">
                    <div class="col-xs-12 col-sm-offset-6 col-sm-6 col-md-offset-7 col-md-5">
                        <a class="btn btn-primary" href="/boats/show/<?= $boat->slug ?>">
                            Подробнее
                        </a>
                        <?php if(Yii::$app->user->can("admin")): ?>
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
