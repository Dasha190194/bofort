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
                <div class="form-group field-user-newpassword">
                    <input type="password" id="user-newpassword" class="form-control" name="User[newPassword]">
                    <span class="placeholder">Новый пароль</span>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group field-user-newpasswordconfirm">
                    <input type="password" id="user-newpasswordconfirm" class="form-control" name="User[newPasswordConfirm]">
                    <span class="placeholder">Подтвердите пароль</span>

                    <div class="help-block"></div>
                </div>
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