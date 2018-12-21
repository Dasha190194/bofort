<div class="profile-container booking-container">
<!--    <h2>Текущее бронирование</h2>-->



    <h2>История аренды</h2>
        <?php foreach ($orders as $order): ?>
            <div class="card">
                <img class="card-img-top" src="/index.png" width="760px" height="340px">
                <div class="card-body">
                    <h5 class="card-title"> <?= $order->boat->name ?></h5>
                    <p class="card-text"> <?= $order->boat->description ?></p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        <?php endforeach; ?>
</div>
