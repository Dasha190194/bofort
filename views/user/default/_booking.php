<div class="profile-container booking-container hidden">

    <h2>Текущее бронирование</h2>
    <?php foreach ($orders as $order): ?>
        <?php if($order->is_book): ?>
            <div class="panel panel-default">
                <div class="panel-title">
                    <img class="card-img-top" src="/index.png" width="748px" height="340px">
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <span><?= $order->datetime_create ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="pull-right"> <?= $order->price ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-6 col-md-6">
                            <span class="pull-right">Карта VISA</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-default btn-block">Отменить бронирование</a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-primary btn-block">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <h2>История аренды</h2>
        <?php foreach ($orders as $order): ?>
            <?php if($order->is_paid): ?>
                <div class="panel panel-default">
                    <div class="panel-title">
                        <img class="card-img-top" src="/index.png" width="748px" height="340px">
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <span><?= $order->datetime_create ?></span>
                            </div>
                            <div class="col-md-6">
                                <span class="pull-right"> <?= $order->price ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-6 col-md-6">
                                <span class="pull-right">Карта VISA</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-primary btn-block">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
</div>
