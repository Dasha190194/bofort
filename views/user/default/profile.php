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
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-profile">

    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-offset-3 col-md-3" style="margin-top: 20px">
            <?php echo Html::beginForm(['/user/logout'], 'post')
            . Html::submitButton(
            'Выход',
            ['class' => 'btn btn-default btn-block']
            )
            . Html::endForm()
            ?>
        </div>
    </div>

    <hr>

    <?php if ($flash = Yii::$app->session->getFlash("Profile-success")): ?>

        <div class="alert alert-success">
            <p><?= $flash ?></p>
        </div>

    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <?= $this->render('_profileMenu', ['new_notifications' => $new_notifications]) ?>
        </div>
        <div class="col-md-8">
            <?= $this->render('_notifications', ['notifications' => $notifications]) ?>
            <?= $this->render('_booking', ['orders' => $orders]) ?>
            <?= $this->render('_account', ['user' => $user]) ?>
            <?= $this->render('_cards', ['cards' => $cards, 'transactions' => $transactions]) ?>
            <?= $this->render('_security', ['user' => $user]) ?>
        </div>
    </div>



<!--    --><?php //$form = ActiveForm::begin([
//        'id' => 'profile-form',
//        'options' => ['class' => 'form-horizontal'],
//        'fieldConfig' => [
//            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-2 control-label'],
//        ],
//        'enableAjaxValidation' => true,
//    ]); ?>
<!---->
<!--    --><?php
    //= $form->field($profile, 'full_name') ?>
<!---->
<!--    --><?php
//    // by default, this contains the entire php timezone list of 400+ entries
//    // so you may want to set up a fancy jquery select plugin for this, eg, select2 or chosen
//    // alternatively, you could use your own filtered list
//    // a good example is twitter's timezone choices, which contains ~143  entries
//    // @link https://twitter.com/settings/account
//    ?>
<!--    --><?php
    //= $form->field($profile, 'timezone')->dropDownList(ArrayHelper::map(Timezone::getAll(), 'identifier', 'name')); ?>
<!---->
<!--    <div class="form-group">-->
<!--        <div class="col-lg-offset-2 col-lg-10">-->
<!--            --><?php
    //= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-primary']) ?>
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    --><?php //ActiveForm::end(); ?>

</div>