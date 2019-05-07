<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var string $subject
 * @var \amnah\yii2\user\models\User $user
 * @var \amnah\yii2\user\models\UserToken $userToken
 */

$url = Url::toRoute(["/user/reset", "token" => $userToken->token], true);
?>

<h3><?= $subject ?></h3>

<p>Пожалуйста, используйте эту ссылку для изменения пароля:</p>

<p><?= Html::a($url, $url) ?></p>
