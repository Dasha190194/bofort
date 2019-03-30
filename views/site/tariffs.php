<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 24.03.19
 * Time: 15:31
 */

use app\helpers\Utils;

?>

<div class="row">
    <div class="col-md-12">
        <h1>Тарифы и услуги</h1>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <h2>Тарифная сетка</h2>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12 tarif">
        <table class="table">
            <tr class="no-border">
                <td></td>

                <?php foreach ($boats as $boat): ?>

                    <td class="text-center">
                        <h4><?= $boat->name ?></h4>
                        <div class="boat-photo">
                            <img src="<?= (isset($boat->image))?Yii::$app->params['uploadsUrl'].'250X150/'. $boat->image->path:'/index.png'?>">
                        </div>
                        <span>Минимальная аренда <?= $boat->tariff->minimal_rent ?> часа</span>
                    </td>

                <?php endforeach; ?>

            </tr>


            <tr class="no-border">
                <td class="width-20">
                    <h4>Будние дни</h4>
                    с 7:00 до 20:00
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr class="no-border">
                <th class="width-20">От 1 до 3х часов</th>
                <?php foreach ($boats as $boat): ?>
                    <td class="text-center"><?= Utils::boatMinPrice($boat->tariff->weekday)?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th class="width-20">От 3х часов</th>
                <?php foreach ($boats as $boat): ?>
                    <td class="text-center green"><?= Utils::boatMinPrice($boat->tariff->four_hours_weekday)?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th class="width-20">Сутки</th>
                <?php foreach ($boats as $boat): ?>
                    <td class="text-center"><?= $boat->tariff->one_day*24 ?> руб./сутки</td>
                <?php endforeach; ?>
            </tr>

            <tr class="no-border">
                <td class="width-20">
                    <h4 class="red">Выходные и праздничные дни</h4>
                    с 7:00 до 20:00
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="no-border">
                <th class="width-20">От 1 до 3х часов</th>
                <?php foreach ($boats as $boat): ?>
                    <td class="text-center"><?= Utils::boatMinPrice($boat->tariff->holiday)?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th class="width-20">От 3х часов</th>
                <?php foreach ($boats as $boat): ?>
                    <td class="text-center"><?= Utils::boatMinPrice($boat->tariff->four_hours_holiday)?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th class="width-20">Сутки</th>
                <?php foreach ($boats as $boat): ?>
                    <td class="text-center"><?= $boat->tariff->one_day*24 ?> руб./сутки</td>
                <?php endforeach; ?>
            </tr>

            <tr class="no-border">
                <td class="width-20">
                    <h4>Дополнительные услуги</h4>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class="width-20">Услуга "Мой капитан"</th>
                <?php foreach ($boats as $boat): ?>
                    <td class="text-center"><?= isset($boat->services[0])?Utils::boatMinPrice($boat->services[0]->price):'-' ?></td>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>
</div>

