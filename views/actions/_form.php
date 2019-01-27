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
//        'action' => '/payment/pay',
//        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'price')->input('text') ?>
    <?= $form->field($model, 'datetime')->widget(\kartik\datetime\DateTimePicker::class, [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>
    <?= $form->field($model, 'boats')->dropDownList(ArrayHelper::map($boats, 'id', 'name')) ?>

    <div class="col-md-offset-3 col-md-6 text-center">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
