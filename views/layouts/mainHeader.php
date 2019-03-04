<!-- Newer -->

<div class="row">
    <div class="col-sm-12">

        <nav id="w0" class="navbar navbar-default header-vertical-collapse">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="w0-collapse" aria-expanded="false">
                <span class="sr-only">Навигация</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?= Yii::$app->homeUrl?>"><img src="/img/web-logo.svg" alt="Бофорт"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="w0-collapse">
              <ul id="w1" class="nav navbar-nav navbar-right mt-16 mb-16">

                <?php if (Yii::$app->user->can("admin")): ?>
                    <li><a class="btn btn-default" href="/admin">Админка</a></li>
                <?php endif; ?>

                <li>
                    <?php  if (Yii::$app->user->isGuest and YII_ENV != 'landing'): ?>
                        <a id="login" class="btn btn-default" onclick="return false;">Войти</a>
                    <?php else: ?>
                        <a class="btn btn-default" href="/user/profile"><?= Yii::$app->user->identity->username?></a>
                    <?php endif; ?>
                </li>

                <li><a class="btn btn-primary" href="/boats/index">Забронировать катер</a></li>

              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

    </div>
</div>

