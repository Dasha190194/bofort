<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 22.01.19
 * Time: 20:21
 */

/** @var \app\models\BoatForm $model */
/** @var \app\models\TariffsModel $modelT */

use app\models\CategoryModel;use app\models\ImagesModel;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;use yii\helpers\Html;
use yii\widgets\ActiveForm;

$images = [];
$initialConfig = [];
if (isset($model->images)) {
    foreach ($model->images as $image) {
        if ($image instanceof ImagesModel) {
            $images[] = Yii::$app->params['uploadsUrl'].'origin/'.$image->path;
            $initialConfig[] = [
                'url' => "/boats/file-delete", 'key'=> $image->id
            ];
        }
    }
}

?>



<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'create-boat-form',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <h4>Общая информация</h4>
    <?= $form->field($model, 'name')->input('text') ?>
    <?= $form->field($model, 'description')->textarea() ?>
    <?= $form->field($model, 'engine_power')->input('text') ?>
    <?= $form->field($model, 'spaciousness')->input('text') ?>
    <?= $form->field($model, 'location_name')->input('text') ?>
    <?= $form->field($model, 'lat')->input('text') ?>
    <?= $form->field($model, 'long')->input('text') ?>
    <?= $form->field($model, 'width')->input('text') ?>
    <?= $form->field($model, 'length')->input('text') ?>
    <?= $form->field($model, 'speed')->input('text') ?>
    <?= $form->field($model, 'speed2')->input('text') ?>
    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(CategoryModel::find()->all(), 'id', 'name')) ?>
    <?= $form->field($model, 'h1')->input('text') ?>

    <hr>
    <div class="row">
        <h4>Тарифы</h4>
        <div class="col-md-2">
            <?= $form->field($modelT, 'holiday')->input('text') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($modelT, 'weekday')->input('text') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($modelT, 'four_hours_holiday')->input('text') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($modelT, 'four_hours_weekday')->input('text') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($modelT, 'one_day')->input('text') ?>
        </div>
    </div>

    <hr>
    <div class="row">
        <h4>Время</h4>
        <?= $form->field($modelT, 'minimal_rent')->input('text') ?>
    </div>

    <hr>
    <h4>Картинки</h4>
    <?= $form->field($model, 'images[]')->widget(FileInput::classname(),
        [
            'pluginOptions' => [
                                'showRemove' => true,
                                'showPreview' => true,
                                'browseLabel' => ' ',
                                'removeLabel' => ' ',
                                'initialPreview' => $images,
                                'initialPreviewAsData' => true,
                                        'initialPreviewConfig' =>$initialConfig,
                                'overwriteInitial' => true,
                                'maxFileSize' => 5000
                               ],
            'options' => [
                            'accept' => 'image/*',
                            'multiple' => true,
                         ]
        ]
    ); ?>

    <div class="col-md-offset-3 col-md-6 text-center">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
