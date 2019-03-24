<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\User $user
 * @var bool $success
 * @var bool $invalidToken
 */


?>

<div class="profile-container security-container">
    <h3>Изменить пароль</h3>

    <?php $form = ActiveForm::begin(['id' => 'reset-form', 'action' => '/default/reset']); ?>

    <div class="row">
            <div class="col-md-6">
                <?= $form->field($user, 'newPassword')->passwordInput(['placeholder' => "Новый пароль"])->label(false) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($user, 'newPasswordConfirm')->passwordInput(['placeholder' => "Подтвердите пароль"])->label(false) ?>
            </div>
        </div>

        <div class="row form-group buttons">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <button type="reset" class="btn btn-default">Отменить изменения</button>
            </div>
            <div class="col-md-4">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary update-account']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>