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

    <div class="row">
        <div class="col-md-3">
            <img src="/index.png" width="250px" height="100px">
        </div>
        <div class="col-md-9">
            <h4><?= $order->boat->name ?></h4>
            <p>От <?= $order->boat->spaciousness ?> человек, мощность <?= $order->boat->engine_power ?>, <?= $order->boat->location ?></p>
        </div>
    </div>

    <hr>

    <div class="row">
        <h3 class="text-center">Выберите дату и время начала аренды</h3>

        <div class="col-md-offset-1 col-md-10">
            <div id="calendar"></div>
            <div id="times"></div>
        </div>
    </div>

    <hr>

    <div class="row">
        <?php $form = ActiveForm::begin([
            'id' => 'order-confirm-form',
            'action' => '/order/confirm-step2?id='.$order->id,
        ]); ?>

        <div class="col-md-2">
            X
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'datetime_from')->textInput(['value' => ''])->label(false)?>
            <?= $form->field($model, 'datetime_to')->textInput(['value' => ''])->label(false)?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'boat_id')->hiddenInput(['value' => $order->boat->id])->label(false)?>
            <?= $form->field($model, 'coast')->textInput(['value' => 20000])->label(false)?>
        </div>
        <div class="col-md-2">
            <?= Html::submitButton('Далее', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>

    $(function() {
        // $('#calendar').fullCalendar({
        //     locale: 'ru',
        //     header: {
        //         left: 'prev',
        //         center: 'title',
        //         right: 'next'
        //     },
        //     dayClick: function(date, jsEvent, view) {
        //
        //         console.log('Clicked on: ' + date.format());
        //         console.log('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
        //         console.log('Current view: ' + view.name);
        //
        //         $.ajax({
        //             url: '/order/get-times',
        //             type: 'GET',
        //             data: { 'date': date.format()},
        //             success: function (data) {
        //                 $(this).css('background-color', 'grey');
        //
        //             }
        //         });
        //     }
        // });


        $('#times').fullCalendar({
            defaultView: 'timeline',
            locale: 'ru',
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
                cell.append('<div class="time" data-number="'+date.format("H")+'">' + moment(date).format("HH:MM") +' - ' + moment(date).add(1, 'hour').format("HH:MM") + '</div>');
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

             let max = Math.max.apply(Math, numberArray);
             let maxBlock = $('div[data-number="'+max+'"]').parent('.fc-major');
             let maxDate = maxBlock.data('date');

             $('#orderconfirmform-datetime_to').val(maxDate);
         }

        $(document).on('click', '.fc-major', function(){
            var timeBlock = $(this);
            var datetime = timeBlock.data('date');
            var number = timeBlock.find('.time').data('number');

            if (numberArray.length === 0) {
                selectNumber(number, timeBlock);
            } else {
                let max = Math.max.apply(Math, numberArray);
                console.log(max);
                console.log(number);
                if (number === max+1) {
                    selectNumber(number, timeBlock)
                } else {
                    alert('error');
                }
            }

            console.log(numberArray);
        });
    });

</script>