<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 12.02.19
 * Time: 20:41
 */


use kartik\grid\GridView;
use yii\helpers\Html;

?>

<div class="admin-orders-container">
    <h2>Заказы</h2>
    <div class="row">
        <div class="col-md-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'boat.name',
                    [
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::a(
                                $data->user->username,
                                '/user/admin/view?id='.$data->user->id,
                                [
                                    'target' => '_blank'
                                ]
                            );
                        }
                    ],
                    'price',
                    'discount',
                    'promo.word',
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'datetime_from',
                        'pageSummary' => true,
                        'readonly' => false,
                        'value' => function($model){ return $model->datetime_from; },
                        'editableOptions' => [
                            'inputType' => kartik\editable\Editable::INPUT_DATETIME,
                            'options' => [
                                'pluginOptions' => [

                                ]
                            ]
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\EditableColumn',
                        'attribute' =>  'datetime_to',
                        'pageSummary' => true,
                        'readonly' => false,
                        'value' => function($model){ return $model->datetime_to; },
                        'editableOptions' => [
                            'inputType' => kartik\editable\Editable::INPUT_DATETIME,
                            'options' => [
                                'pluginOptions' => [

                                ]
                            ]
                        ],
                    ],
                    'datetime_create',
                    [
                        'label' => 'Ссылка',
                        'format' => 'raw',
                        'value' => function($data){
                                    return Html::a('Отменить заказ и вернуть деньги',
                                        '/order/refund?id='.$data->id,
                                        ['class' => 'order-refund', 'data-id' => $data->id, 'onClick' => 'return false;']);
                                  }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
