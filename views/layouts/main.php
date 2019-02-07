<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? (
                '<li><a id="login" class="btn btn-default" onclick="return false;"><i class="glyphicon glyphicon-user" style="padding-right: 15px"></i>Войти</a></li>'
            ) : (
               '<li><a class="btn btn-default" href="/user/profile"><i class="glyphicon glyphicon-user" style="padding-right: 15px"></i>'.Yii::$app->user->identity->username.'</a></li>'
            ),
            '<li><a class="btn btn-default" href="/boats/index">Забронировать катер</a></li>'
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p class="small">О компании Bofort.ru</p>
                <p class="small">Тарифы и Услуги</p>
            </div>
            <div class="col-md-4">
                <p class="small">Частые вопросы</p>
                <p class="small">Контакты</p>
            </div>
            <div class="col-md-4">
                <p class="small">// Здесь будут иконки соцсетей</p>
                <p class="small">// Здесь будет телефон</p>
            </div>
        </div>
        <div class="row mt-16 mb-16">
            <div class="col-md-12">
                <p class="small text-center">Make it sexy, or try a more powerful colour is there a way we can make the page feel more introductory without being cheesy give us a complimentary logo along with the website can we try some other colours maybe. I was wondering if <strong>/* ЭТО АБЗАЦ Х**НИ ДЛЯ СЕО */</strong> my cat could be placed over the logo in the flyer can you punch up the fun level on these icons concept is bang on, but can we look at a better execution, and can my website be in english?</p>
            </div>
        </div>
        <div class="row mb-32">
            <div class="col-md-12">
                <p class="small text-center copy"><?php /* Даша, прости! */ echo date("Y"); ?>, &copy; Bofort.ru, Москва, Петровско-Разумовский проезд, 15</p>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" id="my-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
