<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 27.01.19
 * Time: 8:55
 */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var \app\models\ActionsModel $action */
/** @var \app\models\BoatsModel $boats */
?>


<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'action-form',
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'name')->input('text') ?>
    <?= $form->field($model, 'price')->input('text') ?>
    <?= $form->field($model, 'datetime_from')->widget(\kartik\datetime\DateTimePicker::class) ?>
    <?= $form->field($model, 'datetime_to')->widget(\kartik\datetime\DateTimePicker::class) ?>
    <?= $form->field($model, 'boats')->dropDownList(ArrayHelper::map($boats, 'id', 'name')) ?>

    <div class="col-md-offset-3 col-md-6 text-center">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
