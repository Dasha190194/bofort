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


?>
<div class="user-default-register">

    <?php if ($username = Yii::$app->session->getFlash("Register-success")): ?>

        <div class="modal fade" id="register-modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Регистрация
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <h5>Добро пожаловать, <?= $username ?> </h5>
                        <p>Вы успешно зарегистрированы, проверьте ваш email для подтверждения аккаунта.</p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#register-modal').modal('show')
            })
        </script>

    <?php else: ?>


        <div class="row mb-16">
            <div class="col-md-12">
                <h3 class="text-center">
                    Регистрация
                </h3>
            </div>
        </div>

        <?php $form = ActiveForm::begin([
            'id' => 'register-form',
            'action' => '/user/register',
            'options' => ['class' => 'form-horizontal'],
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

            <?php /*
            <div class="col-md-offset-3 col-md-6 text-center">


                <div class="form-group mb-0 field-user-personal_data_processing">
                    <input type="hidden" name="User[personal_data_processing]" value="0"><input type="checkbox" id="user-personal_data_processing" name="User[personal_data_processing]" value="1">
                    <small> Я соглашаюсь с <a target="_blank" href="/uploads/oferta.pdf">условиями обработки персональных данных</a> <div class="help-block"></div></small>
                </div>

            </div>
            */?>

            <div class="col-md-offset-3 col-md-6 text-center">
                <?= $form->field($user, 'personal_data_processing', [
                    'template' => "{input}
                        <small>&ensp;Я соглашаюсь с <a target='_blank' href='/uploads/confirm-data.pdf'>условиями обработки персональных данных</a> {error}</small>",
                ])->checkbox([], false)->label(false) ?>
            </div>

            <div class="col-md-offset-3 col-md-6 text-center">


                <div class="form-group field-user-mailing">
                    <input type="hidden" name="User[mailing]" value="0"><input type="checkbox" id="user-mailing" name="User[mailing]" value="1">
                    <small> Подписаться на рассылку Bofort.ru</small>
                </div>

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