<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 */

$this->title = $user->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('user', 'Update'), ['update', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('user', 'Delete'), ['delete', 'id' => $user->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('user', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            'id',
            'role_id',
            'status',
            'email:email',
            'username',
            'profile.full_name',
            'password',
            'auth_key',
            'access_token',
            'logged_in_ip',
            'logged_in_at',
            'created_ip',
            'created_at',
            'updated_at',
            'banned_at',
            'banned_reason',
        ],
    ]) ?>

</div>

<div class="card-view">

    <?= DetailView::widget([
        'model' => $user->cards[0],
        'attributes' => [
            'id',
            'first_six',
            'last_four',
            'exp_date'
        ],
    ]) ?>

    <input type="text" class="form-control write-money-input">
    <button id="writeMoney" class="btn bnt-primary" onclick="confirm('Вы уверены что хотите списать деньги?')">Списать</button>
</div>


<script>
    $('#writeMoney').on('click', function () {
        var money = $('.write-money-text').val();

        $.ajax({
            'url': '/admin/write-money',
            'type': 'POST',
            'data': {
                'money': money,
                'card_id': <?= $user->card[0]->id ?>
            },
            success: function (result) {
                if (result.success == true) alert('Деньги успешно списаны!');
                else alert('Произошла ошибка! '+ result.message);
            }
        });
    });
</script>