<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 22.02.19
 * Time: 19:42
 */

/** @var \app\models\BoatsModel $boat */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$file = '/js/order.js';
$asset = new \yii\web\AssetBundle([
    'js' => [ltrim($file, '/')],
    'basePath' => '@webroot',
    'baseUrl' => '/'
]);
$this->getAssetManager()->bundles[$file] = $asset;
$this->registerAssetBundle($file);

?>
<link href="/css/calendar.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.8/dist/vue.min.js"></script>

<style>
    /* Календарь */

    /*#times .fc-widget-header {*/
    /*width: 23%;*/
    /*height: 100px;*/
    /*}*/

    /*#times {*/
    /*height: 420px;*/
    /*}*/

    #times .fc-head {
        display: none;
    }

    /*#times .fc-chrono {*/
    /*display: flex;*/
    /*flex-wrap: wrap;*/
    /*align-content: stretch;*/
    /*height: 100%;*/
    /*width: 1041px;*/
    /*}*/

    #times .fc-slats tr {
        display: flex;
        flex-wrap: wrap;
        align-content: stretch;
        height: 100%;
        width: 790px;
    }

    #times .fc-slats tr .fc-widget-content {
        width: 19%;
        height: 50px;
        border: 1px solid #eee;
        margin: 10px 24px;
    }

    .fc-time-area {
        border: none !important;
    }

    .fc-scroller {
        overflow: hidden !important;
    }

    .select-time, .busy-time {
        background-color: #ccc;
    }
</style>


<link rel='stylesheet' href='/js/fullcalendar/fullcalendar.css' />
<link rel='stylesheet' href='/css/calendar.css' />
<script src='/js/fullcalendar/lib/moment.min.js'></script>
<script src='/js/fullcalendar/fullcalendar.js'></script>
<script src='/js/fullcalendar/locale-all.js'></script>
<link rel='stylesheet' href="/js/fullcalendar/scheduler/scheduler.css" />
<script src='/js/fullcalendar/scheduler/scheduler.js'></script>

<div class="shipowner-boat">
    <div class="row">
        <h3>Выберите дату и время блокировки аренды</h3>

        <div class="col-md-offset-3 col-md-6">
            <div id="calendar" style="margin-bottom: 20px;"></div>
            <div id="times" style="display: none;"></div>
        </div>
    </div>

    <hr>


    <?php $form = ActiveForm::begin([
        'id' => 'block-form',
    ]); ?>

        <?= $form->field($model, 'datetime_from')->hiddenInput(['value' => ''])->label(false)?>
        <?= $form->field($model, 'datetime_to')->hiddenInput(['value' => ''])->label(false)?>
        <?= $form->field($model, 'boat_id')->hiddenInput(['value' => $boat->id])->label(false)?>

        <div class="row">
            <div class="col-md-offset-10 col-md-2">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
</div>


<script>
    $(function() {

        var boat_id = "<?= $boat->id ?>";

        $('#calendar').fullCalendar({
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            locale: 'ru',
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            validRange: function(nowDate){
                return {start: nowDate}
            },
            dayClick: function(date, jsEvent, view) {

                daySelect($(this));

                var times = $('#times');
                times.fullCalendar('gotoDate', date.format());
                times.show();
                times.fullCalendar('render');

                getTimes();
            }
        });

        var start, end;

        $('#times').fullCalendar({
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            defaultView: 'timeline',
            locale: 'ru',
            height: 500,
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            columnHeader: false,
            slotLabelFormat: [
                'HH:mm'
            ],
            minTime: '06:00',
            maxTime: '23:00',
            slotDuration: '01:00:00',
            dayRender(date, cell) {
                cell.append('<div class="time" data-number="'+date.format("H")+'">' + moment(date).format("HH") +':00 - ' + moment(date).add(1, 'hour').format("HH") + ':00</div>');
            },
            viewRender(view, element) {
                start = view.start;
                end = view.end;
            }
        });

        $('#times .fc-left').click(function(){
            if (start.format('YYYY-MM') < end.format('YYYY-MM')) $('#calendar').fullCalendar('prev');
            daySelect($('#calendar table').find('[data-date="'+start.format('YYYY-MM-DD')+'"]'));
            getTimes();
        });

        $('#times .fc-right').click(function(){
            if (start.subtract(1, 'day').format('YYYY-MM') < end.subtract(1, 'day').format('YYYY-MM')) $('#calendar').fullCalendar('next');
            daySelect($('#calendar table').find('[data-date="'+start.add(1, 'day').format('YYYY-MM-DD')+'"]'));
            getTimes();
        });

        var datetimeArray = [];
        var numberArray = [];

        function selectNumber(number, timeBlock) {
            numberArray.push(number);
            timeBlock.css('background-color', '#ccc');
            timeBlock.addClass('select-time');

            fixValue();
        }

        function deselectNumber(number, timeBlock) {
            numberArray.splice(numberArray.indexOf(number), 1);
            timeBlock.css('background-color', 'white');
            timeBlock.removeClass('select-time');

            fixValue();
        }

        function fixValue() {

            let min = Math.min.apply(Math, numberArray);
            let minBlock = $('div[data-number="'+min+'"]').parent('.fc-major');
            let minDate = minBlock.data('date');

            $('#blockform-datetime_from').val(moment(minDate).format("YYYY-MM-DD HH:00"));

            let max = Math.max.apply(Math, numberArray);
            let maxBlock = $('div[data-number="'+max+'"]').parent('.fc-major');
            let maxDate = maxBlock.data('date');

            $('#blockform-datetime_to').val(moment(maxDate).add(1, 'hour').format("YYYY-MM-DD HH:00"));
        }

        function daySelect(day) {
            $('.fc-day').removeClass('select-time');
            day.addClass('select-time');
        }

        function getTimes() {
            $.ajax({
                url: '/order/get-times',
                type: 'GET',
                data: {
                    'date': start.format('YYYY-MM'),
                    'boat_id': boat_id
                },
                success: function (data) {
                    for (i=0; i<data.calendar.length; i++) {
                        $('[data-date="'+data.calendar[i]+'"]').addClass('busy-time');
                    }
                    for (i=0; i<data.actions.length; i++) {
                        $('[data-date="'+data.actions[i]+'"]').append('<span>Акция!</span>');
                    }
                }
            });
        }

        $(document).on('click', '.fc-major', function(){
            var timeBlock = $(this);

            if (!timeBlock.hasClass('busy-time')) {
                var datetime = timeBlock.data('date');
                var number = timeBlock.find('.time').data('number');

                if (timeBlock.hasClass('select-time')) {
                    deselectNumber(number, timeBlock);
                } else {
                    if (numberArray.length === 0) {
                        selectNumber(number, timeBlock);
                    } else {
                        let max = Math.max.apply(Math, numberArray);
                        if (number === max+1) {
                            selectNumber(number, timeBlock);
                        } else {
                            alert('error');
                        }
                    }
                }
            }
        });
    });

</script>


<div id="order" style="display: none;">
    <div class="row">
        <div class="col-offset-1 col-10">
            <hr class="line">
        </div>
    </div>
    <div class="row width-70">
        <h3 class="text-center">Выберите дату и время начала аренды</h3>
    </div>
    <div class="row month-year-wrapper width-70">
        <div class="col-sm-offset-2 col-sm-1 nav-button">
            <a href @click.prevent="prevMonth" class="round-arrow ml-5" :class="{disabled: isFirstMonth}">
                <i class="glyphicon glyphicon-chevron-left"></i>
            </a>
        </div>
        <div class="col-sm-6 month-year nav-title">
            {{ monthAndYear }}
        </div>
        <div class="col-sm-1 text-right nav-button">
            <a href @click.prevent="nextMonth" class="round-arrow mr-5">
                <i class="glyphicon glyphicon-chevron-right"></i>
            </a>
        </div>
    </div>
    <div class="row width-70">
        <div class="col-sm-offset-2 col-sm-8">
            <hr class="week-days-line">
            <div class="week-days">
                <div
                        class="calendar-col week-day"
                        v-for="(day, index) in weekDays"
                        :key="day+'title'"
                        :class="{holyday: index > 4}"
                >{{ day }}</div>
            </div>
            <div class="month-days">
                <div
                        class="calendar-col"
                        v-for="(day, index) in monthDays"
                        :key="day.date.getTime()"
                >
                    <div
                            class="month-day"
                            :class="{
                                'other-month': day.otherMonth,
                                'selected': day.selected || day.choosen,
                                'today': day.today,
                                'past-date': day.pastDate,
                                'holyday': (index % 7) > 4 || day.holyday
                            }"
                            @click="select(day)"
                    >
                        {{ day.day }}
                        <template v-if="!day.otherMonth && !day.pastDate">
                            <div v-if="day.action" class="discount">%</div>
                            <div v-if="day.hasOwnProperty('busy')" class="availability">
                                <div
                                        :class="{
                                            'green': day.busy < 50,
                                            'yellow': day.busy >= 50 && day.busy < 90,
                                            'red': day.busy >= 90,
                                        }"
                                        :style="{width: day.busy + '%'}"
                                ></div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="selectedDate" class="row width-70">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="m20 text-center">
                    <span class="round-arrow vertical">
                        <i class="glyphicon glyphicon-chevron-down"></i>
                    </span>
            </div>
        </div>
    </div>
    <div v-if="selectedDate" class="row width-70">
        <div class="col-sm-offset-2 col-sm-2 nav-button">
            <a href @click.prevent="prevDay" class="day-nav" :class="{disabled: isFirstDay}">
                <i class="glyphicon glyphicon-chevron-left"></i> {{ prevDate }}
            </a>
        </div>
        <div class="col-sm-4 text-center nav-title">
            <h4 class="mb-0">Выберите время аренды</h4>
        </div>
        <div class="col-sm-2 text-right nav-button">
            <a href @click.prevent="nextDay" class="day-nav">
                {{ nextDate }} <i class="glyphicon glyphicon-chevron-right"></i>
            </a>
        </div>
    </div>
    <div v-if="selectedDate" class="row width-70">
        <div class="col-sm-offset-2 col-sm-1 nav-button-min">
        </div>
        <div class="col-sm-6 text-center nav-title-min">
                <span v-if="minimal_rent > 1" class="minimal-rent">
                    Минимальное время аренды {{ minimalRentTitle }}
                </span>
        </div>
        <div class="col-sm-1 text-right nav-button-min">
            <a
                    v-show="choosenTimeFrom"
                    href
                    class="cancel"
                    title="Отменить выбор"
                    @click.prevent="cancel">
                <i class="glyphicon glyphicon-remove"></i>
            </a>
        </div>
    </div>

    <div v-if="selectedDate" class="row width-70">
        <div class="col-sm-offset-2 col-sm-8">
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


<!--    <form id="order-confirm-form" ref="orderForm" action="/order/confirm-step1?id=--><?//=$order->id ?><!--" method="post">-->
<!--        --><?//= Html::hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->getCsrfToken(), []); ?>
<!--        <input type="hidden" name="OrderConfirmForm[boat_id]" :value="boat_id">-->
<!--        <input type="hidden" name="OrderConfirmForm[datetime_from]" :value="choosenTimeFromValue">-->
<!--        <input type="hidden" name="OrderConfirmForm[datetime_to]" :value="choosenTimeToValue">-->
<!--        <input type="hidden" name="OrderConfirmForm[coast]" :value="price">-->
<!--        <div v-if="choosenTimeFrom" class="row mb20 order-form">-->
<!---->
<!---->
<!--            <div class="col-sm-offset-2 col-sm-3 order-time">-->
<!--                <div>{{ dateFromTo }}</div>-->
<!--                <div class="big-blue">{{ timeFromTo }}</div>-->
<!--            </div>-->
<!--            <div class="col-sm-3 order-price">-->
<!--                <div class="text-right">Стоимость аренды составит</div>-->
<!--                <div class="text-right big-blue">{{ price }} руб.</div>-->
<!--            </div>-->
<!--            <div class="col-sm-2 order-button">-->
<!--                <span class="d-inline-block" data-toggle="popover" data-placement="top" data-content="Disabled popover">-->
<!--                    <!--  -->-->
<!--                    <button-->
<!--                            id="orderButton"-->
<!--                            type="submit"-->
<!--                            @click.prevent="checkOrder"-->
<!--                            :class="{disabled: notMinimalOrder}"-->
<!--                            class="btn btn-yellow"-->
<!--                            data-container="body"-->
<!--                            data-toggle="popover"-->
<!--                            data-placement="top"-->
<!--                            :data-content="'Минимальное время аренды ' + minimalRentTitle"-->
<!--                    >Далее</button>-->
<!--                </span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </form>-->
</div>