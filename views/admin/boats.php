<?php

use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\Html;

?>

<div class="admin-boats-container">
    <h2>Лодки</h2>
    <div class="row">
        <div class="col-md-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'name',
                    [
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::a(
                                'Редактировать',
                                '/boats/update?id='.$data->id
                            );
                        }
                    ],
                    [
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::a(
                                'Заблокировать',
                                '/admin/my-boat?id='.$data->id
                            );
                        }
                    ],
                    [
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::a(
                                'Разблокировать',
                                '/admin/unlock?id='.$data->id
                            );
                        }
                    ],
                    [
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::a(
                                'Удалить',
                                '/boats/delete?id='.$data->id,
                                [
                                    'onclick' => 'return confirm(\'Вы уверены, что хотите удалить лодку?\');'
                                ]
                            );
                        }
                    ],
                ]
            ]); ?>
        </div>
    </div>
</div>
