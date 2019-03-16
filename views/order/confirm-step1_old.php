<?php /** @var \app\models\OrdersModel $order */

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<link rel='stylesheet' href='/js/fullcalendar/fullcalendar.css' />
<link rel='stylesheet' href='/css/calendar.css' />
<script src='/js/fullcalendar/lib/moment.min.js'></script>
<script src='/js/fullcalendar/fullcalendar.js'></script>
<script src='/js/fullcalendar/locale-all.js'></script>
<link rel='stylesheet' href="/js/fullcalendar/scheduler/scheduler.css" />
<script src='/js/fullcalendar/scheduler/scheduler.js'></script>

<div class="confirm-order">
    <h1>Бронирование катера</h1>

    <hr>

    <a href="/boats/show?id=<?= $order->boat->id?>" style="display: block;width: 30px;height: 30px;background-color: #777777;color: white;"><i class="glyphicon glyphicon-chevron-left"></i></a>

    <div class="row">
        <div class="col-md-3">
            <img src="<?= (isset($order->boat->image))?Yii::$app->params['uploadsUrl'].'250X150/'.$order->boat->image->path:'/index.png' ?>">
        </div>
        <div class="col-md-9">
            <h4><?= $order->boat->name ?></h4>
            <p>От <?= $order->boat->spaciousness ?> человек, мощность <?= $order->boat->engine_power ?>, <?= $order->boat->location_name ?></p>
        </div>
    </div>

    <hr>

    <div class="row">
        <h3 class="text-center">Выберите дату и время начала аренды</h3>

        <div class="col-md-offset-3 col-md-6">
            <div id="calendar" style="margin-bottom: 20px;"></div>
            <div id="times" style="display: none;"></div>
        </div>
    </div>

    <hr>

    <div id="order-confirm" class="row" style="display: none;">
        <?php $form = ActiveForm::begin([
            'id' => 'order-confirm-form',
            'action' => '/order/confirm-step1?id='.$order->id,
        ]); ?>

        <div class="col-md-1">
            <span id="close">X</span>
        </div>
        <div class="col-md-5">
            <div class="row">
                <label>Время</label>
            </div>
            <div class="row">
                <strong id="datetime_from"></strong> - <strong id="datetime_to"></strong>
            </div>
            <?= $form->field($model, 'datetime_from')->hiddenInput(['value' => ''])->label(false)?>
            <?= $form->field($model, 'datetime_to')->hiddenInput(['value' => ''])->label(false)?>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <div class="row text-right">
                <label>Стоимость аренды составит</label>
            </div>
            <div class="row text-right">
                <strong id="coast"></strong>
            </div>
            <?= $form->field($model, 'boat_id')->hiddenInput(['value' => $order->boat->id])->label(false)?>
            <?= $form->field($model, 'coast')->hiddenInput(['value' => ''])->label(false)?>
        </div>
        <div class="col-md-2">
            <?= Html::submitButton('Далее', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
    $(function() {

        var boat_id = "<?= $order->boat->id ?>";
        var minimal_rent = "<?= $order->boat->tariff->minimal_rent ?>";

        $.ajax( {
            url: '/order/get-dates',
            type: 'GET',
            data: {
                boat_id: boat_id,
                date: moment().format("YYYY-MM-01")
            },
            success: function (data) {

            }
        });

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
            dayClick: function(date1, jsEvent, view) {

                daySelect($(this));

                var times = $('#times');
                times.fullCalendar('gotoDate', date1.format());
                times.show();
                times.fullCalendar('render');

                getTimes();

                numberArray[date] = [];
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
            if (!numberArray[date]) numberArray[date] = [];
        });

        $('#times .fc-right').click(function(){
            if (start.subtract(1, 'day').format('YYYY-MM') < end.subtract(1, 'day').format('YYYY-MM')) $('#calendar').fullCalendar('next');
            daySelect($('#calendar table').find('[data-date="'+start.add(1, 'day').format('YYYY-MM-DD')+'"]'));
            getTimes();
            if (!numberArray[date]) numberArray[date] = [];
        });

        var date;
        var numberArray = [];

        function selectNumber(number, timeBlock) {
            numberArray[date].push(number);
            timeBlock.css('background-color', '#ccc');
            timeBlock.addClass('select-time');

            fixValue();
        }

        function deselectNumber(number, timeBlock) {
            numberArray[date].splice(numberArray[date].indexOf(number), 1);
            timeBlock.css('background-color', 'white');
            timeBlock.removeClass('select-time');

            fixValue();
        }

        function fixValue() {

            let min = Math.min.apply(Math, numberArray[date]);
            let minBlock = $('div[data-number="'+min+'"]').parent('.fc-major');
            let minDate = minBlock.data('date');

            $('#orderconfirmform-datetime_from').val(moment(minDate).format("YYYY-MM-DD HH:00"));
            $('#datetime_from').text(moment(minDate).format("YYYY-MM-DD HH:00"));

            let max = Math.max.apply(Math, numberArray[date]);
            let maxBlock = $('div[data-number="'+max+'"]').parent('.fc-major');
            let maxDate = maxBlock.data('date');

            $('#orderconfirmform-datetime_to').val(moment(maxDate).add(1, 'hour').format("YYYY-MM-DD HH:00"));
            $('#datetime_to').text(moment(maxDate).add(1, 'hour').format("YYYY-MM-DD HH:00"));

            calculateCoast(moment(minDate).format("YYYY-MM-DD HH:00"), moment(maxDate).add(1, 'hour').format("YYYY-MM-DD HH:00"));
        }

        function calculateCoast(minDate, maxDate) {

            var price = 0;

            $.ajax({
                url: '/order/price',
                type: 'GET',
                data: {
                    boat_id: boat_id,
                    datetime_from: minDate,
                    datetime_to: maxDate
                },
                success: function (data) {
                    if (data.success === true) {
                        price = data.result;
                        $('#order-confirm').show();
                        $('#orderconfirmform-coast').val(price);
                        $('#coast').text(price + ' руб.');
                    }
                }
            });
        }

        function daySelect(day) {
            $('.fc-day').removeClass('select-time');
            day.addClass('select-time');
            date = day.attr('data-date');
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
                    if (numberArray[date]) {
                        console.log(numberArray[date])
                        for (i=0; i<numberArray[date].length; i++){
                            $('[data-number="'+numberArray[date][i]+'"]').parent('.fc-major').addClass('select-time');
                        }
                    }
                }
            });
        }

        $(document).on('click', '.fc-major', function(){
            var timeBlock = $(this);

            if (!timeBlock.hasClass('busy-time')) {

                var datetime = timeBlock.data('date');
                var number = timeBlock.find('.time').data('number');
                var minimal_rent_counter = minimal_rent;

                var timesArray = $('.time');
                var numberArray2 = [];
                Object.values(timesArray).forEach(function (el) {
                    if (!$(el).parent('.fc-major').hasClass('busy-time')) {
                        numberArray2.push(Number($(el).attr('data-number')));
                    }
                });

                while (minimal_rent_counter) {
                    if (numberArray2.indexOf(number) === -1) alert('error1');
                    minimal_rent_counter --;
                }

                for (i=0; i < minimal_rent; i++) {

                    timeBlock = $('div[data-number="'+number+'"]').parent('.fc-major');

                    if (timeBlock.hasClass('select-time')) {
                        deselectNumber(number, timeBlock);
                    } else {
                        console.log(numberArray)
                        if (Object.keys(numberArray).length <= 1) {
                            if (numberArray[date].length === 0) {
                                selectNumber(number, timeBlock);
                            } else {
                                let max = Math.max.apply(Math, numberArray[date]);
                                console.log(Object.keys(numberArray).length)
                                if (number === max+1) {
                                    selectNumber(number, timeBlock);
                                } else if(numberArray2.indexOf(number) !== -1) {
                                    alert('error2');
                                }
                            }
                        } else {
                            alert('error3');
                        }
                    }
                    number++;
                }
            }
        });

        $(document).on('click', '#close', function(){
            location.reload();
        });
    });

</script>
