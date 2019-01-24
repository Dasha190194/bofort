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
                <tr>
                    <?php foreach ($promos as $promo): ?>
                        <td><?= $promo->word ?></td>
                        <td><?= $promo->count ?></td>
                        <td><?= $promo->type ?></td>
                        <td><?= $promo->count_to_use ?></td>
                        <td><?= $promo->is_active ?></td>
                        <td>
                            <?= Html::a('Редактировать', ['promo/update', 'id' => $promo->id])?>
                        </td>
                        <td>
                            <a>Скрыть</a>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <a class="btn btn-primary">Создать</a>
        </div>
    </div>
</div>