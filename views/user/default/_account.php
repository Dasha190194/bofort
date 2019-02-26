<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\Module $module
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\UserToken $userToken
 */

$module = $this->context->module;

?>
<div class="profile-container account-container hidden">

    <h2>Персональные данные</h2>
<!---->
<!--    --><?php //if ($flash = Yii::$app->session->getFlash("Account-success")): ?>
<!---->
<!--        <div class="alert alert-success">-->
<!--            <p>--><?//= $flash ?><!--</p>-->
<!--        </div>-->
<!---->
<!--    --><?php //elseif ($flash = Yii::$app->session->getFlash("Resend-success")): ?>
<!---->
<!--        <div class="alert alert-success">-->
<!--            <p>--><?//= $flash ?><!--</p>-->
<!--        </div>-->
<!---->
<!--    --><?php //elseif ($flash = Yii::$app->session->getFlash("Cancel-success")): ?>
<!---->
<!--        <div class="alert alert-success">-->
<!--            <p>--><?//= $flash ?><!--</p>-->
<!--        </div>-->
<!---->
<!--    --><?php //endif; ?>
<!---->
    <?php $form = ActiveForm::begin([
        'id' => 'account-form',
        'action' => '/default/account-edit',
    ]); ?>

    <div class="row">
       <div class="col-md-6">
            <?= $form->field($user, 'username')->input('text', ['placeholder' => "Ваше имя"])->label(false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($user, 'email')->input('text', ['placeholder' => "Ваш email"])->label(false) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($user, 'phone')->input('text', ['placeholder' => "+7 Номер телефона"])->label(false) ?>
        </div>
    </div>

<!---->
<!--    --><?php //if ($user->password): ?>
<!--        --><?php
//= $form->field($user, 'currentPassword')->passwordInput() ?>
<!--    --><?php //endif ?>
<!---->
<!--    <hr/>-->
<!---->
<!---->
<!--    <div class="form-group">-->
<!--        <div class="col-lg-offset-2 col-lg-10">-->
<!---->
<!--            --><?php //if (!empty($userToken->data)): ?>
<!---->
<!--                <p class="small">--><?php
//= Yii::t('user', "Pending email confirmation: [ {newEmail} ]", ["newEmail" => $userToken->data]) ?><!--</p>-->
<!--                <p class="small">-->
<!--                    --><?//= Html::a(Yii::t("user", "Resend"), ["/user/resend-change"]) ?><!-- / --><?//= Html::a(Yii::t("user", "Cancel"), ["/user/cancel"]) ?>
<!--                </p>-->
<!---->
<!--            --><?php //elseif ($module->emailConfirmation): ?>
<!---->
<!--                <p class="small">--><?//= Yii::t('user', 'Changing your email requires email confirmation') ?><!--</p>-->
<!---->
<!--            --><?php //endif; ?>
<!---->
<!--        </div>-->
<!--    </div>-->
<!---->

<!---->
<!--    --><?php
//= $form->field($user, 'newPassword')->passwordInput() ?>
<!---->
    <div class="form-group">
        <div class="col-md-2 col-md-offset-9">
            <?= Html::submitButton(Yii::t('user', 'Сохранить'), ['class' => 'btn btn-primary update-account']) ?>
        </div>
    </div>
<!---->
    <?php ActiveForm::end(); ?>
<!---->
<!--    <div class="form-group">-->
<!--        <div class="col-lg-offset-2 col-lg-10">-->
<!--            --><?php //foreach ($user->userAuths as $userAuth): ?>
<!--                <p>Linked Social Account: --><?php
//= ucfirst($userAuth->provider) ?><!-- / --><?php
//= $userAuth->provider_id ?><!--</p>-->
<!--            --><?php //endforeach; ?>
<!--        </div>-->
<!--    </div>-->
<!---->


<div class="modal fade" id="phone-code" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>

</div>