<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 22.01.19
 * Time: 20:21
 */

/** @var \app\models\BoatForm $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'create-boat-form',
//        'action' => '/payment/pay',
//        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'name')->input('text') ?>
    <?= $form->field($model, 'description')->input('text') ?>
    <?= $form->field($model, 'price')->input('text') ?>
    <?= $form->field($model, 'engine_power')->input('text') ?>
    <?= $form->field($model, 'spaciousness')->input('text') ?>
    <?= $form->field($model, 'certificate')->input('text') ?>
    <?= $form->field($model, 'location')->input('text') ?>
    <?= $form->field($model, 'short_description')->input('text') ?>
    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="col-md-offset-3 col-md-6 text-center">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
