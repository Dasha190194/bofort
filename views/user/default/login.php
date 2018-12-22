<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\forms\LoginForm $model
 */

$this->title = Yii::t('user', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-login">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
//            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],

    ]); ?>

    <div class="">
        <div class="col-md-12">
            <?= $form->field($model, 'email')->input('text', ['placeholder' => "Ваше email"])->label(false) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'password')->passwordInput()->input('text', ['placeholder' => "Пароль"])->label(false) ?>
        </div>
    </div>

<!--    --><?php
    //= $form->field($model, 'rememberMe', [
//        'template' => "{label}<div class=\"col-lg-offset-2 col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
//    ])->checkbox() ?>

    <div class="form-group">
        <div class="col-md-offset-3 col-md-7">
            <?= Html::submitButton('Войти на сайт', ['class' => 'btn btn-primary btn-block']) ?> <br/>
       </div>
        <div class="col-md-offset-2 col-md-9 text-center">
            Еще не зарегестрировался?  <?= Html::a('Создать аккаунт', ["/user/register"]) ?> <br/>
            <?= Html::a('Забыли пароль?', ["/user/forgot"]) ?>
            <!--            --><?//= Html::a(Yii::t("user", "Resend confirmation email"), ["/user/resend"]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php if (Yii::$app->get("authClientCollection", false)): ?>
        <div class="col-lg-offset-2 col-lg-10">
            <?= yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['/user/auth/login']
            ]) ?>
        </div>
    <?php endif; ?>

<!--    <div class="col-lg-offset-2" style="color:#999;">-->
<!--        You may login with <strong>neo/neo</strong>.<br>-->
<!--        To modify the username/password, log in first and then --><?//= HTML::a("update your account", ["/user/account"]) ?><!--.-->
<!--    </div>-->

</div>
