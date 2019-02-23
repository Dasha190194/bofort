<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 22.02.19
 * Time: 19:42
 */

/** @var \app\models\BoatsModel $boat */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>


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