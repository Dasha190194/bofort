<?php

/* @var $this yii\web\View */

/** @var \app\models\BoatsModel $boats */

$this->title = 'Бофорт.ру – аренда катеров и яхт в Москве';
?>
<div class="site-index">

    <div class="body-content">

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

        <div class="row service-list">
            <div class="col-md-offset-2 col-md-4">
                <ul>
                    <li>Быстрое онлайн-бронирование</li>
                    <li>Без депозита</li>
                    <li>Без посредников</li>
                </ul>
            </div>

            <div class="col-md-4">
                <ul>
                    <li>Услуга «наш капитан» с возможностью обучения</li>
                    <li>Возможность длительной аренды</li>
                    <li>Топливо включено в стоимость аренды</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="divider mb-16">
                    <img class="center-block" src="/img/divider.png" alt="аренда катеров и яхт" />
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12 mb-16">
                <h3 class="text-center">Выбери свое судно</h3>
            </div>

        </div>

        <div class="row">

            <?php /** @var \app\models\CategoryModel $categories */
            foreach ($categories as $category): ?>

                <div class="col-xs-12 col-sm-6 col-md-3 mb-64 boat-item <?= ($category->id == 2)?'soon':'' ?>">
                    <div class="boat-photo">
                        <?php if ($category->id == 2):?>
                            <img src="/uploads/550X350/<?= (isset($category->image->path)?$category->image->path:'index.png') ?>" alt="аренда <?= $category->name?>">
                        <?php else: ?>
                            <a href="/boats/index/<?= $category->slug ?>">
                                <img src="/uploads/550X350/<?= (isset($category->image->path)?$category->image->path:'index.png') ?>" alt="аренда <?= $category->name?>">
                            </a>
                        <?php endif; ?>

                        <?php if ($category->id != 2):?>
                            <div class="boat-price">от <?= \app\helpers\Utils::boatMinPrice($category->getMinPrice())?></div>
                        <?php endif; ?>
                    </div>

                    <h5><?= $category->name ?></h5>

                    <p><?= $category->description ?></p>

                    <?php if ($category->id == 2):?>
                        <a class="btn btn-primary mt-8">Скоро</a>
                    <?php else: ?>
                        <a class="btn btn-primary mt-8" href="/boats/index/<?= $category->slug ?>">Подробно</a>
                    <?php endif; ?>
                </div>

            <?php endforeach; ?>

        </div>

        <?php if (Yii::$app->user->isGuest): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="divider mt-16"><img class="center-block" src="/img/divider.png" alt=""></div>
                </div>
            </div>
            <div class="row">
                <?= $this->render('/user/default/register', ['user' => $user, 'profile' => $profile]) ?>
            </div>
        <?php endif; ?>

    </div>
</div>
