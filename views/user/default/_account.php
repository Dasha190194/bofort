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
<div class="profile-container account-container">

    <h2>Персональные данные</h2>

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

    <div class="form-group">
        <div class="col-md-2 col-md-offset-9">
            <?= Html::submitButton(Yii::t('user', 'Сохранить'), ['class' => 'btn btn-primary update-account']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


<div class="modal fade" id="phone-code" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>

</div>