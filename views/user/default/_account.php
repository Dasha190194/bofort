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

    <h3>Персональные данные</h3>

    <?php $form = ActiveForm::begin([
        'id' => 'account-form',
        'action' => '/default/account-edit',
    ]); ?>

    <div class="row">
       <div class="col-md-6">
           <div class="form-group field-user-username">
               <input type="text" id="user-username" class="form-control" name="User[username]" value="<?= $user->username ?>" />
               <span class="placeholder">Ваше имя</span>

               <div class="help-block"></div>
           </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group field-user-email required">
                <input type="text" id="user-email" class="form-control" name="User[email]" value="<?= $user->email ?>" aria-required="true"/>
                <span class="placeholder">Ваш email</span>

                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group field-user-phone">
                <input type="text" id="user-phone" class="form-control" name="User[phone]" value="<?= $user->phone ?>"/>
                <span class="placeholder">+7</span>

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