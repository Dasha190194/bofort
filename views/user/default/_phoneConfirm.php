<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 19.03.19
 * Time: 19:31
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4>Введите номер телефона</h4>
</div>
<div class="modal-body">
    <div id="phone-input" class="row">
        <div class="col-md-6">
            <div class="form-group field-user-phone">
                <input class="form-control" id="phone" name="User[phone]" type="text">
                <span class="placeholder">+7</span>
            </div>
        </div>
        <div class="col-md-6">
            <button id="send-code" class="btn btn-primary">Отправить код</button>
        </div>
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'confirm-phone',
        'action' => '/default/code-confirm',
        'options' => ['style' => 'display: none'],
    ]); ?>
        <div class="row">

            <div class="col-md-12">

                Мы выслали вам SMS с кодом, введите его в это поле, чтобы подтвердить номер телефона:
                <?= $form->field($model, 'code')->input('text', ['class' => 'form-control'])->label(false); ?>
                <?= $form->field($model, 'phone')->hiddenInput()->label(false) ?>
                <span id="code-error" style="color:red;"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-6">
                <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
