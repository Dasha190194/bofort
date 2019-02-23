<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 17.01.19
 * Time: 6:22
 */

?>

<div class="admin-container">
    <ul class="list-group">
        <a href="/admin/orders">
            <li class="list-group-item">
                Заказы
            </li>
        </a>
        <a href="/admin/actions">
            <li class="list-group-item">
                Акции
            </li>
        </a>
        <a href="/admin/promo">
            <li class="list-group-item">
                Промокоды
            </li>
        </a>
        <a href="/admin/category/index">
            <li class="list-group-item">
                Категории
            </li>
        </a>
        <li class="list-group-item">
            <a href="/boats/index">Катера</a>
            <ul>
                <li>
                    <a href="/admin/boats/create">Создать катер</a>
                </li>
            </ul>
        </li>
        <li class="list-group-item">
            <a href="/admin/services">Дополнительные услуги</a>
        </li>
        <a href="/admin/users">
            <li class="list-group-item">
               Пользователи
            </li>
        </a>
        <?php if(Yii::$app->user->identity->isShipowner()): ?>
            <a href="/admin/my-boats">
                <li class="list-group-item">
                    Мои лодки
                </li>
            </a>
        <?php endif; ?>
    </ul>
</div>
