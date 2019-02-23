<?php
/** @var \app\models\CategoryModel $categories */

use yii\helpers\Html;

?>

<div class="category-container">
    <h3>Категории</h3>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <td>Название</td>
                    <td>Описание</td>
                </tr>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category->name ?></td>
                        <td><?= $category->description ?></td>
                        <td>
                            <?= Html::a('Редактировать', ['/admin/category/update', 'id' => $category->id], ['style' => 'cursor:pointer;'])?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Создать', ['/admin/category/create'], ['class' => 'btn btn-primary'])?>
        </div>
    </div>
</div>