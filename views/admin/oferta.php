<?php

use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>



<div class="row">
    <h4>Загрузка оферты</h4>

    <?php $form = ActiveForm::begin([
        'id' => 'oferta-form',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'document')->widget(FileInput::classname(),
        [    'pluginOptions' => [
        'showPreview' => false,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ]]); ?>

    <div class="col-md-offset-3 col-md-6 text-center">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>




