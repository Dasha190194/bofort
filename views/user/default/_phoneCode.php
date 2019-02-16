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


<?php $form = ActiveForm::begin([
    'id' => 'confirm-phone',
    'action' => '/default/code-confirm',
   // 'enableAjaxValidation' => true,
]); ?>
    <div class="row">
        <div class="col-md-12">
            <h4>Подтверждение номера телефона <?= $model->phone ?></h4>
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
