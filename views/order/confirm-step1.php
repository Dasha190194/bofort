<?php
/** @var \app\models\OrdersModel $order */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//$this->registerCssFile('/css/calendar.css');
//$this->registerJsFile('/js/order.js');

$file = '/js/order.js';
$asset = new \yii\web\AssetBundle([
    'js' => [ltrim($file, '/')],
    'basePath' => '@webroot',
    'baseUrl' => '/'
]);
$this->getAssetManager()->bundles[$file] = $asset;
$this->registerAssetBundle($file);
//$file = '/css/calendar.css';
//$asset = new \yii\web\AssetBundle([
//    'css' => [ltrim($file, '/')],
//    'basePath' => '@webroot',
//    'baseUrl' => '/'
//]);
//$this->getAssetManager()->bundles[$file] = $asset;
//$this->registerAssetBundle($file);
?>

<link href="/css/calendar.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.8/dist/vue.min.js"></script>

<script>
    var boat_id = "<?= $order->boat->id ?>";
    var minimal_rent = "<?= $order->boat->tariff->minimal_rent ?>";
</script>

<div class="container confirm-order">
    <h1>Аренда катера</h1>

    <hr>
    <div class="row">
        <div class="boat-pic">
            <a href="/boats/show?id=<?= $order->boat->id?>" class="boat-back round-arrow ml-5">
                <i class="glyphicon glyphicon-chevron-left"></i>
            </a>
            <img src="<?= (isset($order->boat->image))?Yii::$app->params['uploadsUrl'].'250X150/'.$order->boat->image->path:'/index.png' ?>">
            <div>
                <h4><?= $order->boat->name ?></h4>
                <p>От <?= $order->boat->spaciousness ?> человек, мощность <?= $order->boat->engine_power ?>, <?= $order->boat->location_name ?></p>
            </div>
        </div>
    </div>


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
                                'selected': day.selected || day.choosen,
                                'today': day.today,
                                'past-date': day.pastDate,
                                'holyday': (index % 7) > 4
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
                    Минимальное время аренды {{ minimal_rent }} часа
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


        <form id="order-confirm-form" ref="orderForm" action="/order/confirm-step1?id=<?=$order->id ?>" method="post">
        <?= Html :: hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->getCsrfToken(), []); ?>
            <input type="hidden" name="OrderConfirmForm[boat_id]" :value="boat_id">
            <input type="hidden" name="OrderConfirmForm[datetime_from]" :value="choosenTimeFromValue">
            <input type="hidden" name="OrderConfirmForm[datetime_to]" :value="choosenTimeToValue">
            <input type="hidden" name="OrderConfirmForm[coast]" :value="price">
        <div v-if="choosenTimeFrom" class="row mb20 order-form">


            <div class="col-sm-offset-2 col-sm-3 order-time">
                <div>{{ dateFromTo }}</div>
                <div class="big-blue">{{ timeFromTo }}</div>
            </div>
            <div class="col-sm-3 order-price">
                <div class="text-right">Стоимость аренды составит</div>
                <div class="text-right big-blue">{{ price }} руб.</div>
            </div>
            <div class="col-sm-2 order-button">
                <span class="d-inline-block" data-toggle="popover" data-placement="top" data-content="Disabled popover">
                    <!--  -->
                    <button
                            id="orderButton"
                            type="submit"
                            @click.prevent="checkOrder"
                            :class="{disabled: notMinimalOrder}"
                            class="btn btn-yellow"
                            data-container="body"
                            data-toggle="popover"
                            data-placement="top"
                            :data-content="'Минимальное время аренды ' + minimal_rent + ' часа'"
                    >Далее</button>
                </span>
            </div>
        </div>
        </form>
    </div>

</div>