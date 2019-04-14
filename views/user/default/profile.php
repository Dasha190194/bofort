<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use amnah\yii2\user\helpers\Timezone;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\Profile $profile
 * @var \app\models\NotificationsModel $notifications
 * @var \app\models\OrdersModel $orders
 * @var \app\models\CardsModel $cards
 * @var \app\models\TransactionsModel $transactions
 */

$this->title = 'Личный кабинет';

?>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2aeecb33-cd8c-4662-b7bf-9f211f9c4896" type="text/javascript"></script>

<div class="user-default-profile">

    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-offset-3 col-md-3" style="margin-top: 20px">
            <?php echo Html::beginForm(['/user/logout'], 'post')
            . Html::submitButton(
            'Выход',
            ['class' => 'btn btn-primary btn-block']
            )
            . Html::endForm()
            ?>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-md-4 profileMenu">
            <?= $this->render('_profileMenu', ['new_notifications' => $new_notifications]) ?>
        </div>
        <div class="col-md-8 profileBlock">
            <?= $this->render('_notifications', ['notifications' => $notifications]) ?>
        </div>
    </div>

</div>