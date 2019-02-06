<?php

/* @var $this yii\web\View */

/** @var \app\models\BoatsModel $boats */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <!-- <div class="jumbotron"></div> -->

    <div class="body-content">

        <div class="row"><img src="/img/content/hero.jpg" alt="" class="hero"></div>

        <div class="row mt-32">
            <div class="col-md-12">
                <p>
                    <strong>Can you make it stand out more?</strong> in an ideal world. Can we have another option. Concept is bang on, but can we look at a better execution I know somebody who can do this for a reasonable cost. Notify me!
                </p>
                <p>
                    <strong>Can you use a high definition screenshot</strong> that's going to be a chunk of change yet I think we need to start from scratch can you make the logo bigger yes bigger bigger still the logo is too big, I printed it out but the animated gif is not moving.
                    I have an awesome idea for a startup, i need you to build it for me can my website be in english?
                </p>
                <p>
                    <strong>Make it sexy, or try a more powerful colour</strong> is there a way we can make the page feel more introductory without being cheesy give us a complimentary logo along with the website can we try some other colours maybe. I was wondering if my cat could be placed over the logo in the flyer can you punch up the fun level on these icons concept is bang on, but can we look at a better execution, and can my website be in english?
                </p>
                <a class="btn btn-primary mt-16">О компании</a>
            </div>
        </div>

        <hr/>

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
                    <li>Быстрое онлайн-бронирование</li>
                    <li>Без депозита</li>
                    <li>Только новые катера и яхты</li>
                </ul>
            </div>

        </div>

        <hr>

        <div class="row">
            <h2 class="text-center">Выбери свое судно</h2>

            <?php foreach ($boats as $boat): ?>
                <div class="col-md-3">
                    <div class="boats-image">
                        <img src="/uploads/250X150/<?= $boat->image->path ?>">
                        <span class="label label-default"><?= $boat->price ?></span>
                    </div>

                    <p><?= $boat->short_description ?></p>
                    <a class="btn btn-primary" href="/boats/show?id=<?= $boat->id ?>">Подробно</a>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (Yii::$app->user->isGuest): ?>
            <div class="row">
                <?= $this->render('/user/default/register', ['user' => $user, 'profile' => $profile]) ?>
            </div>
        <?php endif; ?>

    </div>
</div>
