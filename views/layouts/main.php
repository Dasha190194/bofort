<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/jpeg', 'href' => Url::to(['/img/favicon.png'])]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php if (!Yii::$app->controller->action->id == 'tariffs'): ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php endif; ?>
    <meta name="Description" content="Аренда катеров и яхт в Москве. Быстрое онлайн-бронирование катера. Без посредников. Без депозита.">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="<? if (Yii::$app->controller->action->id == 'tariffs') echo 'tariff-wrap'; else echo 'wrap';?>">

    <?php if (Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == 'site/index'): ?>
        <?= $this->render('mainHeader') ?>

        <div class="row hero">
            <div class="hero-img-container">
                <img
                        src="https://bofort.ru/img/content/hero.jpg"
                        alt=""
                        class="img-responsive"
                />

                <div class="hero-title visible-sm visible-md visible-lg">
                    <h1 class="hero-title-h1">Аренда катеров и яхт в Москве</h1>
                    <p class="hero-title-h2">с нами – это просто!</p>
                    <a href="/boats/index" class="btn btn-warning mt-8">Выбрать судно&ensp;&ensp;<span>›</span></a>
                </div>
            </div>
        </div>

    <?php else: ?>
        <?= $this->render('header') ?>
    <?php endif; ?>

    <div class="container">
        <?= $content ?>
    </div>
</div>

<?= $this->render('footer') ?>

<div class="modal fade" id="my-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>


<!--     Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym("<?= Yii::$app->params['yandex_metrika'] ?>", "init", {
        id:<?= Yii::$app->params['yandex_metrika'] ?>,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/<?= Yii::$app->params['yandex_metrika'] ?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!--     /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= Yii::$app->params['google_analytics']?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', "<?= Yii::$app->params['google_analytics']?>");
</script>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

