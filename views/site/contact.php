<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
    	<div class="col-sm-12">
    		
    		<p>ООО «БОФОРТ»</p>
    		<p>ИНН: 7714436758,</p>
    		<p>ОГРН: 5187746033052,</p>
    		<p>Адрес: Москва, Петровско-Разумовский проезд, 15, офис 14</p>

				<p>Служба поддержки 24/7 готова всегда ответить на ваши вопросы по телефону ... или по электронной почте - <a href="mailto:info@bofort.ru">info@bofort.ru</a>.</p>

				<p>По вопросам сотрудничествам и предложениям обращайтесь по электронной почте - <a href="mailto:feedback@bofort.ru">feedback@bofort.ru</a></p>

    	</div>
    </div>


</div>
