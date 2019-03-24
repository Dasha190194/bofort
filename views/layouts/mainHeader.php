<nav id="w0" class="navbar navbar-default header-vertical-collapse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button
                    type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#w0-collapse"
                    aria-expanded="false"
            >
                <span class="sr-only">Навигация</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= Yii::$app->homeUrl?>"><img src="/img/web-logo.svg" alt="Бофорт"/></a>
        </div>

        <div class="collapse navbar-collapse" id="w0-collapse">
            <ul id="w1" class="nav navbar-nav navbar-right mt-16 mb-16">

                <?php if (Yii::$app->user->can("admin")): ?>
                    <li><a class="btn btn-default" href="/admin">Админка</a></li>
                <?php endif; ?>

                <li>
                    <?php  if (Yii::$app->user->isGuest): ?>
                        <a id="login" class="btn btn-default" onclick="return false;">Войти</a>
                    <?php else: ?>
                        <a class="btn btn-default" href="/user/profile"><?= Yii::$app->user->identity->username?></a>
                    <?php endif; ?>
                </li>

                <li>
                    <a class="btn btn-warning" href="/boats/index">Забронировать катер</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

