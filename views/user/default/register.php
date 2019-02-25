<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\Module $module
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\User $profile
 * @var string $userDisplayName
 */

$module = Yii::$app->getModule("user");

$this->title = 'Регистрация';
?>
<div class="user-default-register">

    <div class="row mb-16">
        <div class="col-md-12">
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <?php if ($flash = Yii::$app->session->getFlash("Register-success")): ?>

        <div class="alert alert-success">
            <p><?= $flash ?></p>
        </div>

    <?php else: ?>

        <?php $form = ActiveForm::begin([
            'id' => 'register-form',
            'action' => '/user/register',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
//                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
//                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
            'enableAjaxValidation' => true,
        ]); ?>

        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <?= $form->field($user, 'username')->input('text', ['placeholder' => "Ваше имя*"])->label(false)  ?>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?= $form->field($user, 'email')->input('text', ['placeholder' => "Ваш email*"])->label(false)  ?>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?= $form->field($user, 'newPassword')->passwordInput(['placeholder' => "Пароль*"])->label(false)  ?>
            </div>

            <div class="col-md-offset-3 col-md-6 text-center">
                <?= $form->field($user, 'personal_data_processing', [
                        'template' => "{input}
                        <small>&ensp;Я соглашаюсь с условиями обработки персональных данных {error}</small>",
                    ])->checkbox([], false)->label(false) ?>
            </div>
            <div class="col-md-offset-3 col-md-6 text-center">
                <?= $form->field($user, 'mailing', [
                    'template' => "{input}
                        <small>&ensp;Подписаться на рассылку Bofort.ru</small>",
                ])->checkbox([], false)->label(false)?>
            </div>

            <?php /* uncomment if you want to add profile fields here
            <?= $form->field($profile, 'full_name') ?>
            */ ?>

            <div class="col-md-offset-3 col-md-6 text-center mt-8">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary mb-8']) ?>

                <p class="small text-center">Уже есть аккаунт? <a id="login-register" onclick="return false;">Войти</a></p>
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

    <?php endif; ?>

</div>