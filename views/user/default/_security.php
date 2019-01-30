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

<div class="profile-container security-container hidden">
    <h2>Изменить пароль</h2>
    <div class="row">
        <div class="col-md-12">

            <?php $form = ActiveForm::begin(['id' => 'reset-form', 'action' => '/default/reset']); ?>

            <?= $form->field($user, 'newPassword')->passwordInput()->label(false) ?>
            <?= $form->field($user, 'newPasswordConfirm')->passwordInput()->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

