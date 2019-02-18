<nav id="w0" class="navbar-default navbar-fixed-top navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= Yii::$app->homeUrl?>"><?= Yii::$app->name?></a>
        </div>
        <div id="w0-collapse" class="collapse navbar-collapse">
            <ul id="w1" class="navbar-nav navbar-right nav">
                <?php if (Yii::$app->user->can("admin")): ?>
                    <li>
                        <a class="btn btn-default" href="/admin">Админка</a>
                    </li>
                <?php endif; ?>
                <li>
                    <?php  if (Yii::$app->user->isGuest): ?>
                        <a id="login" class="btn btn-default" onclick="return false;"><i class="glyphicon glyphicon-user" style="padding-right: 15px"></i>Войти</a>
                    <?php else: ?>
                        <a class="btn btn-default" href="/user/profile">
                            <i class="glyphicon glyphicon-user" style="padding-right: 15px"></i><?= Yii::$app->user->identity->username?>
                        </a>
                    <?php endif; ?>
                </li>
                <li><a class="btn btn-default" href="/boats/index">Забронировать катер</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


