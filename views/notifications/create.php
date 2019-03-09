<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 08.03.19
 * Time: 17:34
 */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$array = ArrayHelper::map(\app\models\User::find()->all(),'id', 'username');
$array[1000] = 'Бронь';
$array[0] = 'Все';

?>



<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'notification-form',
    ]); ?>

    <?= $form->field($model, 'text')->input('text') ?>
    <?= $form->field($model, 'type')->dropDownList($array, ['multiple'=>true])->label('Сначала перечислены пользователи, потом Бронь, потом Все') ?>

    <div class="col-md-offset-3 col-md-6 text-center">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
