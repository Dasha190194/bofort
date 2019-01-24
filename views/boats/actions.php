<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 24.01.19
 * Time: 20:06
 */



use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
use yii\helpers\Html;

$form = ActiveForm::begin();
echo TabularForm::widget([
    'dataProvider'=>$dataProvider,
    'form'=>$form,
    'attributes'=>$model->formAttribs,
    'gridSettings'=>['condensed'=>true]
]);
// Add other fields if needed or render your submit button
echo '<div class="text-right">' .
    Html::submitButton('Submit', ['class'=>'btn btn-primary']) .
    '<div>';
ActiveForm::end();