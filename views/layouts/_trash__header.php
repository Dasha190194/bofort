<nav id="w0" class="navbar-default navbar-fixed-top navbar">

    <div class="container">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?= Yii::$app->homeUrl?>"><?= Yii::$app->name?>
                <!-- logo -->
            </a>

        </div>

        <div id="w0--collapse" class="collapse navbar-collapse">

            <ul id="w1" class="navbar-nav navbar-right nav">

                <?php if (Yii::$app->user->can("admin")): ?>

                    <li><button class="btn btn-default" href="/admin">Админка</button></li>

                <?php endif; ?>

                <li>
                    <?php  if (Yii::$app->user->isGuest): ?>

                        <button id="login" class="btn btn-default" onclick="return false;">Войти</button>

                    <?php else: ?>

                        <button class="btn btn-default" href="/user/profile"><?= Yii::$app->user->identity->username?></button>

                    <?php endif; ?>
                </li>

                <li>
                    <button class="btn btn-primary" href="/boats/index">Забронировать катер</button>
                </li>

            </ul>

        </div>

    </div>

</nav>