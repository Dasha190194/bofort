<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 23.02.19
 * Time: 17:26
 */


use app\models\ImagesModel;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$images = [];
if (isset($model->images)) {
    foreach ($model->images as $image) {
        if ($image instanceof ImagesModel) $images[] = Yii::$app->params['uploadsUrl'].'origin/'.$image->path;
    }
}

?>


<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'create-category-form',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->input('text') ?>
    <?= $form->field($model, 'description')->textarea()?>

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
                                'overwriteInitial' => true,
                                'maxFileSize' => 2800
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
