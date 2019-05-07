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

$this->title = 'Смена пароля';

?>
<div class="user-default-reset">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($success)): ?>

        <div class="alert alert-success">
            <p>Пароль был изменен.</p>
        </div>

    <?php elseif (!empty($invalidToken)): ?>

        <div class="alert alert-danger">
            <p><?= Yii::t("user", "Invalid token") ?></p>
        </div>

    <?php else: ?>

        <div class="row">
            <div class="col-lg-5">

                <div class="alert alert-warning">
                    <p><?= Yii::t("user", "Email") ?> [ <?= $user->email ?> ]</p>
                </div>

                <?php $form = ActiveForm::begin(['id' => 'reset-form']); ?>

                    <?= $form->field($user, 'newPassword')->passwordInput()->label('Новый пароль') ?>
                    <?= $form->field($user, 'newPasswordConfirm')->passwordInput()->label('Подтвердите пароль') ?>
                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    <?php endif; ?>

</div>