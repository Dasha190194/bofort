<?php
/** @var \app\models\PromoModel $promos */

use yii\helpers\Html;

?>

<div class="promos_container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <td>Слово</td>
                    <td>Цена</td>
                    <td>Тип</td>
                    <td>Количество</td>
                    <td>Активно</td>
                </tr>
                <?php foreach ($promos as $promo): ?>
                    <tr>
                        <td><?= $promo->word ?></td>
                        <td><?= $promo->count ?></td>
                        <td><?= $promo->type ?></td>
                        <td><?= $promo->count_to_use ?></td>
                        <td><?= $promo->is_active ?></td>
                        <td>
                            <?= Html::a('Редактировать', ['promo/update', 'id' => $promo->id], ['style' => 'cursor:pointer;'])?>
                        </td>
                        <td>
                            <?php $name = ($promo->is_active)?'Скрыть':'Показать';
                               echo Html::a($name, ['promo/change-active', 'id' => $promo->id], ['style' => 'cursor:pointer;', 'id' => 'change-active']);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Создать', ['promo/create'], ['class' => 'btn btn-primary'])?>
        </div>
    </div>
</div>