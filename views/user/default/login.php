
<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\forms\LoginForm $model
 */

$this->title = 'Вход';

?>


<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><?= Html::encode($this->title) ?></h1>
</div>
<div class="modal-body">
    <div class="user-default-login">

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
        ]); ?>

        <div class="">
            <div class="col-md-12">
                <?= $form->field($model, 'email')->input('text', ['placeholder' => "Ваш email"])->label(false) ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'password')->passwordInput()->input('text', ['placeholder' => "Пароль"])->label(false) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-6">
                <?= Html::submitButton('Войти на сайт', ['class' => 'btn btn-primary btn-block mb-16']) ?>
            </div>
            <div class="col-md-12">
                <p class="small text-center mb-0">Еще не зарегистрированы?  <?= Html::a('Создать аккаунт', ["/user/register"]) ?></p>
                <p class="small text-center"><?= Html::a('Забыли пароль?', ["/user/forgot"]) ?></p>
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

</div>