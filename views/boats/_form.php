<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 22.01.19
 * Time: 20:21
 */

/** @var \app\models\BoatForm $model */
/** @var \app\models\TariffsModel $modelT */

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'create-boat-form',
//        'action' => '/payment/pay',
//        'enableAjaxValidation' => true,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <h4>Общая информация</h4>
    <?= $form->field($model, 'name')->input('text') ?>
    <?= $form->field($model, 'description')->textarea() ?>
    <?= $form->field($model, 'engine_power')->input('text') ?>
    <?= $form->field($model, 'spaciousness')->input('text') ?>
    <?= $form->field($model, 'certificate')->input('text') ?>
    <?= $form->field($model, 'location')->input('text') ?>
    <?= $form->field($model, 'short_description')->textarea() ?>

    <hr>
    <h4>Тарифы</h4>
    <div class="col-md-3">
        <?= $form->field($modelT, 'holiday')->input('text') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($modelT, 'weekday')->input('text') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($modelT, 'four_hours')->input('text') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($modelT, 'one_day')->input('text') ?>
    </div>

    <hr>
    <h4>Картинки</h4>
    <?= $form->field($model, 'images[]')->widget(FileInput::classname(),
        [
            'pluginOptions' => [
                                'showCaption' => true,
                                'showRemove' => true,
                                'showPreview' => true,
                                'showUpload' => true,
                                'browseLabel' => ' ',
                                'removeLabel' => ' ',
                               ],
            'options' => [
                            'accept' => 'image/*',
                            'multiple'=>true,
                         ]
        ]
    ); ?>

    <div class="col-md-offset-3 col-md-6 text-center">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
