<?php
use app\models\TransactionsModel;

/** @var \app\models\CardsModel $cards */
/** @var TransactionsModel $transactions */
?>

<script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>

<div class="profile-container cards-container">
    <h2>Сохраненные карты</h2>

    <?php foreach($cards as $card): ?>

        <div class="row">
            <div class="col-xs-8">
                <?php if($card->type == 'VISA'): ?>
                    <img class="card-image" src="/visa.png">
                <?php else: ?>
                    <img class="card-image" src="/mastercard.png">
                <?php endif; ?>
                <h4 class="card-title">
                    <?= $card->type?> ****<?= $card->last_four?>
                </h4>
                <?php if($card->state == 1): ?>
                    <div class="main-card">
                        <i class="glyphicon glyphicon-ok"></i> Основная карта
                    </div>
                <?php else: ?>
                    <div class="make-main mainCard" data-id="<?= $card->id ?>">
                        <span>Сделать основной</span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-xs-4 text-right card-remove">
                <?php if($card->state == 1): ?>
                    Карту нельзя удалить
                <?php else: ?>
                    <span class="red removeCard" data-id="<?= $card->id ?>">
                        <i class="glyphicon glyphicon-remove"></i> Удалить карту
                    </span>
                <?php endif; ?>
            </div>
        </div>

    <?php endforeach; ?>

    <div class="row">
        <div class="col-md-6">
            <span class="btn btn-primary" data-toggle="modal" data-target="#add-new-card-modal" id="addNewCard">Добавить новую карту</span>
        </div>
    </div>

    <?php if(!empty($transactions)): ?>

        <h3 class="history">История списаний</h3>

        <?php foreach($transactions as $transaction): ?>

            <hr class="one">
            <div class="row">
                <div class="col-md-6">
                    <div class="date-price">
                        <?= $transaction->datetime_create ?>
                    </div>
                    <div class="gray">
                        <?= $transaction->card->type ?>
                        <?= $transaction->card->last_four ?>
                    </div>
                </div>
                <div class="col-md-offset-3 col-md-3 text-right">
                    <div class="date-price">
                        <?= \app\helpers\Utils::userPrice($transaction->total_price) ?>
                    </div>
                    <div class="gray">
                        <?= TransactionsModel::$transactionsState[$transaction->state] ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <hr class="one">

    <?php endif; ?>

    <div class="modal fade" id="add-new-card-modal" role="dialog" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4>Добавить новую карту</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">При добавлении новой карты мы спишем с нее 1 рубль. После авторизации деньгу будут возвращены на ваш счет</p>
                    <div class="row">
                        <div class="col-md-6">
                            <button data-dismiss="modal" class="btn btn-default">Отмена</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary" id="confirm-add-new-card">Списать</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const cloud_id = "<?= Yii::$app->params['cloud_id'] ?>";
    var user_id = "<?= Yii::$app->user->getId() ?>";
</script>
