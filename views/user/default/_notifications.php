<?php
/** @var \app\models\NotificationsModel $notifications */
?>

<div class="profile-container notifications-container">
    <?php if (count($notifications) > 0): ?>
        <h2>Уведомления - <?= count($notifications)?></h2> <span id="clear-notifications">Очистить всё</span>

        <?php foreach ($notifications as $notification): ?>
            <div class="row">
                <div data-id="<?= $notification->id ?>" class="notification-panel panel panel-default <?php if ($notification->is_open == 0) echo 'noOpen';?>">
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
