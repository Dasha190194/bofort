<?php

/* @var $this yii\web\View */

/** @var \app\models\BoatsModel $boats */

$this->title = 'Bofort';
?>
<div class="site-index">

    <!-- <div class="jumbotron"></div> -->

    <div class="body-content">

        <div class="row hero">
            <div class="col-sm-12">
                
                <!-- <img src="/img/content/hero.jpg" alt="" class="img-responsive"> -->

                <div class="hero-img-container">
                
                    <img src="/img/content/hero.jpg" alt="" class="img-responsive">

                    <div class="hero-title visible-sm visible-md visible-lg">
                        <p class="hero-title-h1">Аренда катеров и яхт в Москве</p>
                        <p class="hero-title-h2">с нами – это просто!</p>
                        <a href="/boats/index" class="btn btn-warning mt-8">Выбрать судно&ensp;&ensp;<span>›</span></a>
                    </div>

                </div>

            </div>
        </div>

        <div class="row mt-32">
            <div class="col-md-12">
                <p>
                    <strong>Миссия нашей компании</strong> – сделать аренду маломерных судов максимально простой и удобной. Желающим арендовать судно мы предлагаем онлайн бронирование с оплатой банковской картой. Весь процесс занимает не более пяти минут, и это не сложнее, чем вызвать такси.
                </p>
                <p>
                    <strong>Опытным судоводителям, имеющим удостоверение ГИМС</strong> доступны все наши суда для самостоятельного плавания, а также долгосрочная аренда для длительных путешествий.
                </p>
                <p>
                    <strong>Имеете удостоверение, но не уверены в своих навыках? Или не имеете удостоверения вовсе?</strong> Для вас доступна услуга «Мой капитан». Мы придадим вам уверенности в судовождении, и, при желании, любой сможет почувствовать себя капитаном!
                </p>
                <p>
                    Не раздумывайте - выбирайте и бронируйте! С нами вы получите незабываемые впечатления!
                </p>

                <a class="btn btn-primary mt-16" href="/site/about">О компании</a>
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="divider mt-64 mb-32"><img class="center-block" src="/img/divider.png" alt=""></div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-offset-2 col-md-4">
                <ul>
                    <li>Быстрое онлайн-бронирование</li>
                    <li>Без депозита</li>
                    <li>Только новые катера и яхты</li>
                </ul>
            </div>

            <div class="col-md-4">
                <ul>
                    <li>Услуга «Наш капитан»</li>
                    <li>Возможность длительной аренды</li>
                    <li>Идеально для вейкбордистов</li>
                </ul>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="divider mt-32 mb-16"><img class="center-block" src="/img/divider.png" alt=""></div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12 mb-16">
                <h3 class="text-center">Выбери свое судно</h3>
            </div>

        </div>

        <div class="row">

            <?php foreach ($categories as $category): ?>
                <div class="col-xs-12 col-sm-6 col-md-3 mb-16">
                    <div class="boats-image">
                        <img class="img-responsive" src="http://bofort.su/uploads/250X150/<?= (isset($category->image->path)?$category->image->path:'index.png') ?>">
            <?php /*                        <span class="label label-default">--><?//= $boat->tariff->weekday ?><!--</span> */?>
                    </div>

                    <h4><?= $category->name ?></h4>

                    <p><?= $category->description ?></p>
                    <a class="btn btn-primary" href="/boats/index/<?= $category->slug ?>">Подробно</a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="divider mt-16"><img class="center-block" src="/img/divider.png" alt=""></div>
            </div>
        </div>

        <?php if (Yii::$app->user->isGuest): ?>
            <div class="row">
                <?= $this->render('/user/default/register', ['user' => $user, 'profile' => $profile]) ?>
            </div>
        <?php endif; ?>

    </div>
</div>
