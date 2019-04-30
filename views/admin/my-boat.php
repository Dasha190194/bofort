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

<script>
    var boat_id = "<?= $boat->id ?>";
    var minimal_rent = "<?= $boat->tariff->minimal_rent ?>";
</script>


<div id="order" style="display: none;">
    <div class="row">
        <div class="col-offset-1 col-10">
            <hr class="line">
        </div>
    </div>
    <div class="row width-70">
        <h3 class="text-center">Выберите дату и время блокировки катера</h3>
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

    <?php $form = ActiveForm::begin([
        'id' => 'block-form',
    ]); ?>

    <input type="hidden" name="BlockForm[datetime_from]" :value="choosenTimeFromValue">
    <input type="hidden" name="BlockForm[datetime_to]" :value="choosenTimeToValue">
    <?= $form->field($model, 'boat_id')->hiddenInput(['value' => $boat->id])->label(false)?>

    <div class="row">
        <div class="col-md-offset-10 col-md-2">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>