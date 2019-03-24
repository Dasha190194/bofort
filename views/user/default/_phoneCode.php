<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 16.02.19
 * Time: 10:59
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>


<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4>Подтверждение номера телефона <?= $model->phone ?></h4>
</div>
<div class="modal-body">
    <?php $form = ActiveForm::begin([
        'id' => 'confirm-phone',
        'action' => '/default/code-confirm',
    ]); ?>
    <div class="row">
        <div class="col-md-12">
            <p class="text-center">Мы выслали вам SMS с кодом, введите его в это поле, чтобы подтвердить номер телефона:</p>
            <?= $form->field($model, 'code')->input('text', ['class' => 'form-control'])->label(false); ?>
            <?= $form->field($model, 'phone')->hiddenInput()->label(false) ?>
            <span id="code-error" style="color:red;"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <button type="reset" data-dismiss="modal" class="btn btn-default btn-block">Отменить</button>
        </div>
        <div class="col-md-6">
            <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

