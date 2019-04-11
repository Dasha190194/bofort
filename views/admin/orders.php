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
                      'label' => 'Сервисы',
                      'value' => function($data) {
                            $services = null;
                            foreach ($data->services as &$service) {
                                $services = $services . ' '. $service->name;
                            }
                            return $services;
                      }
                    ],
                    'services.name',
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
                        'label' => '',
                        'format' => 'raw',
                        'value' => function($data){
                                    return Html::button('Отменить заказ и вернуть деньги',
                                        ['class' => 'order-refund', 'data-id' => $data->id]);
                                  }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
