<?php
/** @var \app\models\NotificationsModel $notifications */
?>

<div class="profile-container notifications-container">
    <?php if (count($notifications) > 0): ?>
        <div class="row">
            <div class="col-md-6"><h3>Уведомления &bull;  <span id="count"><?= count($notifications)?></span></h3></div>
            <div class="col-md-6 text-right"><span id="clear-notifications" class="clear-all">Очистить всё</span></div>
        </div>

        <?php foreach ($notifications as $notification): ?>
            <div class="row">
                <div data-id="<?= $notification->id ?>" class="notification-panel panel panel-default <?php if ($notification->is_open == 0) echo 'noOpen';?>">
                    <div class="panel-title">
                        <span class="bull">&bull;</span>
                        Желающим арендовать судно мы предлагаем онлайн бронирование с оплатой
                    </div>
                    <div class="panel-body">
                        <?= $notification->text ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <strong>У вас нет новых уведомлений</strong>
    <?php endif; ?>
</div>
