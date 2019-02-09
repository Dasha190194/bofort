<?php
use app\models\TransactionsModel;

/** @var \app\models\CardsModel $cards */
/** @var TransactionsModel $transactions */
?>

<div class="profile-container cards-container hidden">
    <div>
        <h2>Сохраненный карты</h2>
        <?php foreach($cards as $card): ?>
            <div class="row">
                <div class="col-md-2">
                    <?php if($card->type == 'VISA'): ?>
                        <img width="80px" src="/visa.png">
                    <?php else: ?>
                        <img width="80px" src="/mastercard.png">
                    <?php endif; ?>
                </div>
                <div class="col-md-4" style="padding-top: 14px;">
                    <div>
                        <?= $card->type?> ****<?= $card->last_four?>
                    </div>
                    <div>
                        <?php if($card->state == 1): ?>
                            <i class="glyphicon glyphicon-ok"></i> Основная карта
                        <?php else: ?>
                            <a href="/user/change-card-state?id=<?=$card->id?>&state=1">Сделать основной</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-offset-3 col-md-3">
                    <?php if($card->state == 1): ?>
                        Карту нельзя удалить
                    <?php else: ?>
                        <a>Удалить карту</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
<!--        <a class="btn btn-default">Добавить новую карту</a>-->
    </div>
    <?php if(!empty($transactions)): ?>
        <div>
            <h2>История списаний</h2>
            <hr>
            <?php foreach($transactions as $transaction): ?>
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <?= $transaction->datetime_create ?>
                        </div>
                        <div>
                            <?= $transaction->card->type ?>
                            <?= $transaction->card->last_four ?>
                        </div>
                    </div>
                    <div class="col-md-offset-3 col-md-3">
                        <div>
                            <?= $transaction->order->price ?>
                        </div>
                        <div>
                            <?= TransactionsModel::$transactionsState[$transaction->state] ?>
                        </div>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
