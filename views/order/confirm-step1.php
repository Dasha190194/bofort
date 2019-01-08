<?php /** @var \app\models\OrdersModel $order */

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<link rel='stylesheet' href='/js/fullcalendar/fullcalendar.css' />
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
            <img src="/index.png" width="250px" height="100px">
        </div>
        <div class="col-md-9">
            <h4><?= $order->boat->name ?></h4>
            <p>От <?= $order->boat->spaciousness ?> человек, мощность <?= $order->boat->engine_power ?>, <?= $order->boat->location ?></p>
            <div id="boat_price" style="display: none;"><?= $order->boat->price ?></div>
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
            'action' => '/order/confirm-step2?id='.$order->id,
        ]); ?>

        <div class="col-md-1">
            X
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
        $('#calendar').fullCalendar({
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            locale: 'ru',
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            height: 300,
            dayClick: function(date, jsEvent, view) {

                console.log('Clicked on: ' + date.format());
                console.log('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                console.log('Current view: ' + view.name);

                $(this).css('background-color', '#ccc');

                var times = $('#times');
                times.fullCalendar('gotoDate', date.format());
                times.show();
                times.fullCalendar('render');
                $('#order-confirm').show();

                // $.ajax({
                //     url: '/order/get-times',
                //     type: 'GET',
                //     data: { 'date': date.format()},
                //     success: function (data) {
                //         $(this).css('background-color', 'grey');
                //
                //     }
                // });
            }
        });

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
            // selectable: true,
            // selectHelper: true,
            // dayClick: function(date, jsEvent, view) {
            //     $(this).css('background-color', '#777');
            //
            // },
            // select: function( start, end, jsEvent, view ){
            //     console.log(start);
            //     console.log(end);
            //     // if(window.confirm("Create this event?")){
            //     //     $("#calendar").fullCalendar( "removeEvents", "chunked-helper");
            //     //     $("#calendar").fullCalendar( "addEventSource",chunk({start:start,end:end},"event"));
            //     // }else{
            //     //     $("#calendar").fullCalendar( "removeEvents", "chunked-helper");
            //     // }
            // },
            dayRender(date, cell) {
                cell.append('<div class="time" data-number="'+date.format("H")+'">' + moment(date).format("HH") +':00 - ' + moment(date).add(1, 'hour').format("HH") + ':00</div>');
            }
        });

        var datetimeArray = [];
        var numberArray = [];

         function selectNumber(number, timeBlock) {
             numberArray.push(number);
             timeBlock.css('background-color', '#ccc');

             let min = Math.min.apply(Math, numberArray);
             let minBlock = $('div[data-number="'+min+'"]').parent('.fc-major');
             let minDate = minBlock.data('date');

             $('#orderconfirmform-datetime_from').val(minDate);
             $('#datetime_from').text(moment(minDate).format("YYYY-MM-DD HH:MM"));

             let max = Math.max.apply(Math, numberArray);
             let maxBlock = $('div[data-number="'+max+'"]').parent('.fc-major');
             let maxDate = maxBlock.data('date');

             $('#orderconfirmform-datetime_to').val(moment(maxDate).add(1, 'hour'));
             $('#datetime_to').text(moment(maxDate).add(1, 'hour').format("YYYY-MM-DD HH:MM"));

             calculateCoast();
         }

         function calculateCoast() {
             var price = $('#boat_price').text();
             $('#orderconfirmform-coast').val(numberArray.length * price);
             $('#coast').text(numberArray.length * price + ' руб.');
         }

        $(document).on('click', '.fc-major', function(){
            var timeBlock = $(this);
            var datetime = timeBlock.data('date');
            var number = timeBlock.find('.time').data('number');

            if (numberArray.length === 0) {
                selectNumber(number, timeBlock);
            } else {
                let max = Math.max.apply(Math, numberArray);
                if (number === max+1) {
                    selectNumber(number, timeBlock)
                } else {
                    alert('error');
                }
            }

        });
    });

</script>