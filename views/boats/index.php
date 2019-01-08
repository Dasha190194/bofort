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
    <h1>Наши катера</h1>

    <hr>

    <?php foreach($boats as $boat):?>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-4 boat-show-img">
                <img src="/index.png" width="350px" height="200px">
                <span class="label label-default"><?= $boat->price ?></span>
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
                    <a class="btn btn-default" href="/boats/show?id=<?= $boat->id ?>">
                        Подробнее
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
