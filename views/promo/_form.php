<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var \app\models\PromoModel $promo */
?>


<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'promo-form',
//        'action' => '/payment/pay',
//        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($promo, 'word')->input('text') ?>
    <?= $form->field($promo, 'count')->input('text') ?>
    <?= $form->field($promo, 'count_to_use')->input('text')->label('count_to_use 1-1 использование, 2-массовое') ?>
    <?= $form->field($promo, 'type')->input('text')->label('type 1-% 2-фиксировано')?>
    <?= $form->field($promo, 'is_active', [
       // 'template' => "{input}   Я соглашаюсь с условиями обработки персональных данных {error}",
    ])->checkbox() ?>

    <div class="col-md-offset-3 col-md-6 text-center">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
