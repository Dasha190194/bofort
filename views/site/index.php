<?php

/* @var $this yii\web\View */

/** @var \app\models\BoatsModel $boats */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-md-12">
                <p>
                    Серия фильмов о Гарри Поттере — серия фильмов, основанных на вселенной Гарри Поттера английской писательницы Дж. К. Роулинг.
                    Серия выпущена компанией Warner Bros. и состоит из 8 фильмов в жанре фэнтези, включая основную серию, начиная с «Гарри Поттер и философский камень» (2001)
                    и заканчивая «Гарри Поттер и Дары Смерти. Часть 2» (2011); а также спин-офф «Фантастические твари и где они обитают» и его сиквел «Фантастические твари:
                    Преступления Грин-де-Вальда». Франшиза занимает 3 место в списке самых прибыльных серий фильмов с $9,14 млрд мировой прибыли.
                </p>
                <a class="btn btn-default">О компании</a>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <div class="row">
                    <div class="col-md-2"><img src="/sun.png" width="50px"></div>
                    <div class="col-md-10">Гарри Поттер и философский камень — 2001 год.</div>
                </div>
                <div class="row">
                    <div class="col-md-2"><img src="/sun.png" width="50px"></div>
                    <div class="col-md-10">Гарри Поттер и тайная комната — 2002 год.</div>
                </div>
                <div class="row">
                    <div class="col-md-2"><img src="/sun.png" width="50px"></div>
                    <div class="col-md-10">Гарри Поттер и узник Азкабана — 2004 год.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-2"><img src="/sun.png" width="50px"></div>
                    <div class="col-md-10">Гарри Поттер и Кубок огня — 2005 год.</div>
                </div>
                <div class="row">
                    <div class="col-md-2"><img src="/sun.png" width="50px"></div>
                    <div class="col-md-10">Гарри Поттер и Орден Феникса — 2007 год.</div>
                </div>
                <div class="row">
                    <div class="col-md-2"><img src="/sun.png" width="50px"></div>
                    <div class="col-md-10">Гарри Поттер и Принц-полукровка — 2009 год.</div>
                </div>
            </div>
        </div>

        <hr/>

        <div class="row">
            <h2>Лодки</h2>

            <?php foreach ($boats as $boat): ?>
                <div class="col-md-3">
                    <div class="boats-image">
                        <img src="/uploads/250X150/<?= $boat->image->path ?>">
                        <span class="label label-default"><?= $boat->price ?></span>
                    </div>

                    <p><?= $boat->short_description ?></p>
                    <a class="btn btn-default" href="/boats/show?id=<?= $boat->id ?>">Подробно</a>
                </div>
            <?php endforeach; ?>
        </div>

        <hr/>

        <?php if (Yii::$app->user->isGuest): ?>
            <div class="row">
                <?= $this->render('/user/default/register', ['user' => $user, 'profile' => $profile]) ?>
            </div>
        <?php endif; ?>

    </div>
</div>
