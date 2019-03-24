<?php
use app\models\TransactionsModel;

/** @var \app\models\CardsModel $cards */
/** @var TransactionsModel $transactions */
?>

<script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>

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
                        <a href="/user/remove-card?id=<?=$card->id?>">Удалить карту</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <span class="btn btn-default" id="addNewCard">Добавить новую карту</span>
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
                            <?= $transaction->total_price ?>
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


    <div class="modal fade" id="add-new-card-modal" role="dialog">
        <div class="modal-dialog" style="width: 780px;">
            <div class="modal-content">
                <p>С Вашей карты спишется 1 руб.</p>
                <button class="btn btn-default" id="confirm-add-new-card">Списать</button>
                <button class="btn btn-default">Отмена</button>
            </div>
        </div>
    </div>


</div>




<script>

    $(document).ready(function () {

        const cloud_id = "<?= Yii::$app->params['cloud_id'] ?>";
        var user_id = "<?= Yii::$app->user->getId() ?>";

        $('#confirm-add-new-card').on('click', function(){

            var widget = new cp.CloudPayments();
            widget.charge({
                    publicId: cloud_id,
                    description: 'Привязка карты',
                    amount: 1,
                    currency: 'RUB',
                    invoiceId: 111111,
                    accountId: user_id,
                },
                function (options) {
                    location.reload();
                },
                function (reason, options) {
                    alert(reason);
                    location.reload();
                });
        });
    });

</script>
