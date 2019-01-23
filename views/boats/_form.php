<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 22.01.19
 * Time: 20:21
 */

/** @var \app\models\BoatsModel $boat */

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'create-boat-form',
//        'action' => '/payment/pay',
//        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($boat, 'name')->input('text') ?>
    <?= $form->field($boat, 'description')->input('text') ?>
    <?= $form->field($boat, 'price')->input('text') ?>
    <?= $form->field($boat, 'engine_power')->input('text') ?>
    <?= $form->field($boat, 'spaciousness')->input('text') ?>
    <?= $form->field($boat, 'certificate')->input('text') ?>
    <?= $form->field($boat, 'location')->input('text') ?>
    <?= $form->field($boat, 'short_description')->input('text') ?>
    <?= $form->field($boat, 'image')->fileInput() ?>

    <div class="col-md-offset-3 col-md-6 text-center">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
