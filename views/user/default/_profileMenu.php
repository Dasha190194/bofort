<ul class="list-group">
    <li class="list-group-item active" data-container="notifications">Уведомления
        <?php if($new_notifications > 0): ?>
            <span class="badge"><?= $new_notifications?></span>
        <?php endif; ?>
    <li class="list-group-item" data-container="booking">История бронирования</li>
    <li class="list-group-item" data-container="account">Персональные данные</li>
    <li class="list-group-item" data-container="cards">Оплата и привязанные карты</li>
    <li class="list-group-item" data-container="security">Пароль и безопасность</li>
</ul>