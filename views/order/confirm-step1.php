<?php
/** @var \app\models\OrdersModel $order */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile('/css/calendar.css');
$this->registerJsFile('/js/order.js');
?>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.8/dist/vue.min.js"></script>

<div class="confirm-order">
    <h1>Бронирование катера</h1>

    <hr>

    <a href="/boats/show?=<?= $order->boat->id?>" style="display: block;width: 30px;height: 30px;background-color: #777777;color: white;"><i class="glyphicon glyphicon-chevron-left"></i></a>

    <div class="row">
        <div class="col-md-3">
            <img src="<?= (isset($order->boat->image))?Yii::$app->params['uploadsUrl'].'250X150/'.$order->boat->image->path:'/index.png' ?>">
        </div>
        <div class="col-md-9">
            <h4><?= $order->boat->name ?></h4>
            <p>От <?= $order->boat->spaciousness ?> человек, мощность <?= $order->boat->engine_power ?>, <?= $order->boat->location_name ?></p>
        </div>
    </div>

    <div id="order">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <hr class="line">
            </div>
        </div>
        <div class="row">
            <h3 class="text-center">Выберите дату и время начала аренды</h3>
        </div>
        <div class="row month-year-wrapper">
            <div class="col-md-offset-2 col-md-1">
                <a href @click.prevent="prevMonth" class="round-arrow ml-5" :class="{disabled: isFirstMonth}">
                    <i class="glyphicon glyphicon-chevron-left"></i>
                </a>
            </div>
            <div class="col-md-6 month-year">
                {{ monthAndYear }}
            </div>
            <div class="col-md-1 text-right">
                <a href @click.prevent="nextMonth" class="round-arrow mr-5">
                    <i class="glyphicon glyphicon-chevron-right"></i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <hr class="week-days-line">
                <div class="week-days">
                    <div
                            class="calendar-col week-day"
                            v-for="(day, index) in weekDays"
                            :key="day"
                            :class="{holyday: index > 4}"
                    >{{ day }}</div>
                </div>
                <div class="month-days">
                    <div
                            class="calendar-col"
                            v-for="(day, index) in monthDays"
                            :key="day"
                    >
                        <div
                                class="month-day"
                                :class="{
                                'other-month': day.otherMonth,
                                'selected': day.selected,
                                'today': day.today,
                                'past-date': day.pastDate
                            }"
                                @click="select(day)"
                        >
                            {{ day.day }}
                            <template v-if="!day.otherMonth && !day.pastDate">
                                <div class="discount">%</div>
                                <div class="availability">
                                    <div class="green"></div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="selectedDate" class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="m20 text-center">
                    <span class="round-arrow vertical">
                        <i class="glyphicon glyphicon-chevron-down"></i>
                    </span>
                </div>
            </div>
        </div>
        <div v-if="selectedDate" class="row">
            <div class="col-md-offset-2 col-md-2">
                <a href @click.prevent="prevDay" class="day-nav" :class="{disabled: isFirstDay}">
                    <i class="glyphicon glyphicon-chevron-left"></i> {{ prevDate }}
                </a>
            </div>
            <div class="col-md-4 month-year">
                <h4>Выберите время начала аренды</h4>
            </div>
            <div class="col-md-2 text-right">
                <a href @click.prevent="nextDay" class="day-nav">
                    {{ nextDate }} <i class="glyphicon glyphicon-chevron-right"></i>
                </a>
            </div>
        </div>

        <div v-if="selectedDate" class="row">
            <div class="col-md-offset-2 col-md-8">
                <hr class="week-days-line">
                <div class="day-times">
                    <div
                            class="time-col"
                            v-for="(time, index) in times"
                            :class="{
                            'busy': time.busy,
                            'selected': time.selected
                        }"
                            @click="chooseTime(time)"
                    >
                        <i v-if="time.selected" class="glyphicon glyphicon-ok"></i>
                        <i v-else class="glyphicon glyphicon-time"></i>
                        <span>{{ time.from + ' - ' + time.to }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <hr class="line">
            </div>
        </div>
        <div v-if="choosenTimeFrom || 1" class="row">
            <?php $form = ActiveForm::begin([
                'id' => 'order-confirm-form',
                'action' => '/order/confirm-step1?id='.$order->id,
            ]); ?>
                <input type="hidden" name="OrderConfirmForm[boat_id]" :value="boat_id">
                <input type="hidden" name="OrderConfirmForm[datetime_from]" :value="choosenTimeFromValue">
                <input type="hidden" name="OrderConfirmForm[datetime_to]" :value="choosenTimeToValue">

                <div class="col-md-offset-2 col-md-3">
                    <div class="row">
                        <div class="col-md-3">
                            <a href class="cancel" @click.prevent="cancel">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        </div>
                        <div class="col-md-9">
                            <div class="row">{{ dateFromTo }}</div>
                            <div class="row big-blue">{{ timeFromTo }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row text-right">Стоимость аренды составит</div>
                    <div class="row text-right big-blue">{{ price }} руб.</div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-yellow">Далее</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>

