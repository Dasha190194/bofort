<?php
/** @var \app\models\ActionsModel $actions */

use yii\helpers\Html;

?>

<div class="actions_container">
    <h2>Акции</h2>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <td>Название</td>
                    <td>Цена</td>
                    <td>Время начала</td>
                    <td>Время окончания</td>
                </tr>
                <?php foreach ($actions as $action): ?>
                    <tr>
                        <td><?= $action->name ?></td>
                        <td><?= $action->price ?></td>
                        <td><?= $action->datetime_from ?></td>
                        <td><?= $action->datetime_to ?></td>
                        <td>
                            <?= Html::a('Редактировать', ['actions/update', 'id' => $action->id], ['style' => 'cursor:pointer;'])?>
                        </td>
                        <td>
                            <?= Html::a('Удалить', ['actions/delete', 'id' => $action->id], ['style' => 'cursor:pointer;'])?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Создать', ['actions/create'], ['class' => 'btn btn-primary'])?>
        </div>
    </div>
</div>