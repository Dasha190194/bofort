<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 08.03.19
 * Time: 17:26
 */

use kartik\grid\GridView;
use yii\helpers\Html; ?>


<div class="admin-orders-container">
    <h2>Уведомления</h2>
    <div class="row">
        <div class="col-md-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'text',
                    'is_open',
                    'user_id',
                ],
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Создать', ['notifications/create'], ['class' => 'btn btn-primary'])?>
        </div>
    </div>
</div>
