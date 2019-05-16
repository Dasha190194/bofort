<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 24.03.19
 * Time: 15:31
 */

use app\helpers\Utils;

$this->title = 'Стоимость аренды катера'
?>

<div class="row">
    <div class="col-md-12">
        <h1><?= $this->title ?></h1>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12 tarif">
        <div class="nav-arrows">
            <a href="#" class="round-arrow left"><i class="glyphicon glyphicon-chevron-left"></i></a>
            <a href="#" class="round-arrow right"><i class="glyphicon glyphicon-chevron-right"></i></a>
        </div>
        <table class="table" data-visible-column="1">
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
                <td colspan="4">
                    <h4>Будние дни</h4>
                    с 7:00 до 20:00
                </td>
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
                <td colspan="4">
                    <h4 class="red">Выходные и праздничные дни</h4>
                    с 7:00 до 20:00
                </td>
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
                <td colspan="4">
                    <h4>Дополнительные услуги</h4>
                </td>
            </tr>
            <tr>
                <th class="width-20">Услуга "Мой капитан"</th>
                <?php foreach ($boats as $boat): ?>
                    <td class="text-center"><?= isset($boat->services[0])?Utils::boatMinPrice($boat->services[0]->price):'-' ?></td>
                <?php endforeach; ?>
            </tr>
        </table>
        <script>
            $(document).ready(function() {
                var table = $('.tarif .table');
                function next() {
                    var currColl = +table.attr('data-visible-column');
                    currColl--;
                    if (currColl < 1) {
                        currColl = 3;
                    }
                    table.attr('data-visible-column', currColl);
                }
                function prev() {
                    var currColl = +table.attr('data-visible-column');
                    currColl++;
                    if (currColl > 3) {
                        currColl = 1;
                    }
                    table.attr('data-visible-column', currColl);
                }
                $('.round-arrow.right').click(function(e) {
                    e.preventDefault();
                    next();
                })
                $('.round-arrow.left').click(function(e) {
                    e.preventDefault();
                    prev();
                })
                $(document).width();
                var touchFrom = 0;
                var touchTo = 0;
                $(table).on({
                    'touchstart': function(e) {
                        touchFrom = e.touches[0].pageX;
                    },
                    'touchmove': function(e) {
                        touchTo = e.touches[0].pageX;
                    },
                    'touchend': function(e) {
                        var length = Math.abs(touchFrom - touchTo)
                        if (length < $(document).width()*0.5) {
                            return
                        }
                        if (touchFrom > touchTo) {
                            prev();
                        } else {
                            next();
                        }
                    }
                })
            })
        </script>
    </div>
</div>

