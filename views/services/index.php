<?php
/** @var \app\models\ServicesModel $services */

use yii\helpers\Html;

?>

<div class="service-container">
    <h2>Дополнительные услуги</h2>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <td>Название</td>
                    <td>Цена</td>
                </tr>
                <?php foreach ($services as &$service): ?>
                    <tr>
                        <td><?= $service->name ?></td>
                        <td><?= $service->price ?></td>
                        <td>
                            <?= Html::a('Редактировать', ['services/update', 'id' => $service->id], ['style' => 'cursor:pointer;'])?>
                        </td>
                        <td>
                            <?= Html::a('Удалить', ['services/delete', 'id' => $service->id], ['style' => 'cursor:pointer;'])?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Создать', ['services/create'], ['class' => 'btn btn-primary'])?>
        </div>
    </div>
</div>