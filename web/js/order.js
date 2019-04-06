var today = new Date();
today.setHours(0, 0, 0, 0)
var now = new Date();
// minutes
var timeToRouteToBoat = 30;

var app = new Vue({
  el: '#order',
  data: {
    boat_id: 0,
    minimal_rent_in_day: 1,
    showTimes: true,

    currentMonth: today.getMonth(),
    currentYear: today.getFullYear(),

    selectedDate: null,
    dateTimes: {
      calendar: [],
      actions: []
    },
    choosenTimeFrom: null,
    choosenTimeTo: null,
    price: 0
  },
  computed: {
    months() {
      return ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
    },
    months1() {
      return ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря"];
    },
    weekDays() {
      return ["ПН", "ВТ", "СР", "ЧТ", "ПТ", "СБ", "ВС"];
    },
    times() {
      if (!this.selectedDate) {
        return [];
      }
      let times = [];
      for (var i = 7; i < 20; i++) {
        var date = new Date(this.selectedDate.getFullYear(), this.selectedDate.getMonth(), this.selectedDate.getDate(), i, 0, 0, 0);
        times.push({
          from: i + ':00',
          to: (i + 1) + ':00',
          date: date,
          busy: this.isBusyTime(date),
          action: this.isActionTime(date),
          selected: this.isSelectTime(date)
        })
      }
      return times;
    },

    monthAndYear() {
      return this.months[this.currentMonth] + ' ' + this.currentYear;
    },
    prevDate() {
      if (!this.selectedDate) {
        return '';
      }
      var prevDay = new Date(this.selectedDate.getFullYear(), this.selectedDate.getMonth(), this.selectedDate.getDate() - 1);
      return prevDay.getDate() + ' ' + this.months1[prevDay.getMonth()];
    },
    nextDate() {
      if (!this.selectedDate) {
        return '';
      }
      var nextDay = new Date(this.selectedDate.getFullYear(), this.selectedDate.getMonth(), this.selectedDate.getDate() + 1);
      return nextDay.getDate() + ' ' + this.months1[nextDay.getMonth()];
    },
    isFirstMonth() {
      return this.currentMonth === today.getMonth() && this.currentYear == today.getFullYear();
    },
    isFirstDay() {
      return this.selectedDate && this.isCurrentDate(this.selectedDate);
    },
    monthDays() {
      var days = [];

      var firstDay = (new Date(this.currentYear, this.currentMonth)).getDay();

      // if month not starts in monday
      if (firstDay !== 1) {
        var prev = this.getPrevMonth(this.currentYear, this.currentMonth);
        var daysInlastMonth = this.daysInMonth(prev.year, prev.month);
        for (var i = 2; i <= firstDay; i++) {
          var day = daysInlastMonth - firstDay + i;
          var date = new Date(prev.year, prev.month, day)
          days.push({
            day: day,
            date: date,
            otherMonth: true,
            selected: this.isSelected(date),
            today: this.isCurrentDate(date),
            pastDate: this.isPastDate(date),
            choosen: this.isChoosenDate(date),
            holyday: false
          });
        }
      }

      // add current month days
      var daysInMonth = this.daysInMonth(this.currentYear, this.currentMonth);
      for (var i = 1; i <= daysInMonth; i++) {
        var date = new Date(this.currentYear, this.currentMonth, i);
        days.push({
          day: i,
          date: date,
          otherMonth: false,
          selected: this.isSelected(date),
          today: this.isCurrentDate(date),
          pastDate: this.isPastDate(date),
          action: this.isActionDate(date),
          choosen: this.isChoosenDate(date),
          busy: this.busyDate(date),
          holyday: this.isHolyday(date)
        });
      }

      // add next month days
      if (days.length % 7 !== 0) {
        var next = this.getNextMonth(this.currentYear, this.currentMonth);
        var nextMonthDays = Math.ceil(days.length / 7) * 7 - days.length;
        for (var i = 1; i <= nextMonthDays; i++) {
          var date = new Date(next.year, next.month, i);
          days.push({
            day: i,
            date: date,
            otherMonth: true,
            selected: this.isSelected(date),
            today: this.isCurrentDate(date),
            pastDate: false,
            action: this.isActionDate(date),
            choosen: this.isChoosenDate(date),
            holyday: this.isHolyday(date)
          });
        }
      }

      return days;
    },
    choosenTimeFromValue() {
      if (!this.choosenTimeFrom) {
        return '';
      }
      return this.formatDate(this.choosenTimeFrom);
    },
    choosenTimeToValue() {
      if (!this.choosenTimeFrom) {
        return '';
      }
      var timeTo = ''
      if (!this.choosenTimeTo) {
        timeTo = new Date(
            this.choosenTimeFrom.getFullYear(),
            this.choosenTimeFrom.getMonth(),
            this.choosenTimeFrom.getDate(),
            this.choosenTimeFrom.getHours() + 1
        );

        return this.formatDate(timeTo);
      }

      timeTo = new Date(
          this.choosenTimeTo.getFullYear(),
          this.choosenTimeTo.getMonth(),
          this.choosenTimeTo.getDate(),
          this.choosenTimeTo.getHours() + 1
      );

      return this.formatDate(timeTo);
    },
    dateFromTo() {
      if (!this.choosenTimeFrom) {
        return '';
      }
      var from = this.choosenTimeFrom.getDate() + ' ' + this.months1[this.choosenTimeFrom.getMonth()] + ' ' + this.choosenTimeFrom.getFullYear();
      if (!this.choosenTimeTo) {
        return from;
      }
      var to = this.choosenTimeTo.getDate() + ' ' + this.months1[this.choosenTimeTo.getMonth()] + ' ' + this.choosenTimeTo.getFullYear();
      return from === to ? from : from + ' - ' + to;
    },
    timeFromTo() {
      if (!this.choosenTimeFrom) {
        return '';
      }
      var from = this.choosenTimeFrom.getHours() + ':00';
      var to = '';
      if (!this.choosenTimeTo) {
        to = (this.choosenTimeFrom.getHours() + 1) + ':00';
      } else {
        to = (this.choosenTimeTo.getHours() + 1) + ':00';
      }
      return from + ' - ' + to;
    },
    nightInOrder() {
      return (
          this.choosenTimeFrom &&
          this.choosenTimeTo &&
          this.choosenTimeFrom.getDate() !== this.choosenTimeTo.getDate() &&
          Math.round((this.choosenTimeTo.getTime() - this.choosenTimeFrom.getTime()) / (3600000 * 24)) * 24
      )
    },
    minimal_rent() {
      return this.nightInOrder || this.minimal_rent_in_day
    },
    minimalRentTitle() {
      if (this.nightInOrder) {
        var rentDays = Math.round(this.minimal_rent / 24);
        return (rentDays === 1 ? '' : rentDays) + ' ' + this.declOfNum(rentDays, ['сутки', 'суток', 'суток'])
      }
      return this.minimal_rent + ' ' + this.declOfNum(this.minimal_rent, ['час', 'часа', 'часов'])
    },
    notMinimalOrder() {
      var choosenHours = 0;
      if (this.choosenTimeFrom && !this.choosenTimeTo) {
        choosenHours = 1;
      }
      if (this.choosenTimeFrom && this.choosenTimeTo) {
        choosenHours = (this.choosenTimeTo.getTime() - this.choosenTimeFrom.getTime()) / 3600000 + 1;
      }
      return choosenHours < this.minimal_rent;
    }
  },
  methods: {
    formatMonth(month) {
      month++;
      return month < 10 ? '0' + month : month;
    },
    formatDate(date) {
      return (
          date.getFullYear() + '-' +
          this.formatMonth(date.getMonth()) + '-' +
          date.getDate() + ' ' +
          date.getHours() + ':00'
      )
    },
    declOfNum(number, titles)
    {
      cases = [2, 0, 1, 1, 1, 2];
      return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];
    },
    isHolyday(date) {
      var may1 = new Date(now.getFullYear(), 4, 1);
      var may3 = new Date(now.getFullYear(), 4, 3);
      if (may1.getTime() <= date.getTime() && date.getTime() <= may3.getTime()) {
        return true;
      }

      var may9 = new Date(now.getFullYear(), 4, 9);
      var may10 = new Date(now.getFullYear(), 4, 10);
      if (may9.getTime() <= date.getTime() && date.getTime() <= may10.getTime()) {
        return true;
      }

      var june12 = new Date(now.getFullYear(), 5, 12);
      if (june12.getTime() === date.getTime()) {
        return true;
      }

      return false;
    },
    isBusyTime(date) {
      var nextHour = new Date(now.getTime());
      nextHour.setMinutes(nextHour.getMinutes() + timeToRouteToBoat)
      if (date < nextHour) {
        return true;
      }
      for (var i = 0; i < this.dateTimes.calendar.length; i++) {
        if (this.dateTimes.calendar[i].getTime() === date.getTime()) {
          return true;
        }
      }
      return false;
    },
    isActionTime(date) {
      for (var i = 0; i < this.dateTimes.actions.length; i++) {
        if (this.dateTimes.actions[i].getTime() === date.getTime()) {
          return true;
        }
      }
      return false;
    },
    isSelectTime(date) {
      if (!this.choosenTimeFrom) {
        return false;
      }
      if (!this.choosenTimeTo) {
        return this.choosenTimeFrom.getTime() === date.getTime()
      }
      if (this.choosenTimeFrom <= date && date <= this.choosenTimeTo) {
        return true;
      }
      return false;
    },
    isActionDate(date) {
      for (var i = 0; i < this.dateTimes.actions.length; i++) {
        if (
            this.dateTimes.actions[i].getFullYear() === date.getFullYear() &&
            this.dateTimes.actions[i].getMonth() === date.getMonth() &&
            this.dateTimes.actions[i].getDate() === date.getDate()
        ) {
          return true;
        }
      }
      return false;
    },
    isPastDate(date) {
      var may1 = new Date(now.getFullYear(), 4, 1);
      if (date < may1) {
        return true;
      }

      var september30 = new Date(now.getFullYear(), 8, 30);
      if (date > september30) {
        return true;
      }

      return date < today;
    },
    isCurrentDate(date) {
      return date.getTime() === today.getTime();
    },
    isSelected(date) {
      if (!this.selectedDate) {
        return false;
      }
      return date.getTime() === this.selectedDate.getTime();
    },
    isChoosenDate(date) {
      if (!this.choosenTimeFrom) {
        return false;
      }
      var from = new Date(this.choosenTimeFrom.getFullYear(), this.choosenTimeFrom.getMonth(), this.choosenTimeFrom.getDate())

      if (
          from.getFullYear() === date.getFullYear() &&
          from.getMonth() === date.getMonth() &&
          from.getDate() === date.getDate()
      ) {
        return true;
      }

      if (!this.choosenTimeTo) {
        return false;
      }
      var to = new Date(this.choosenTimeTo.getFullYear(), this.choosenTimeTo.getMonth(), this.choosenTimeTo.getDate())

      if (
          to.getFullYear() === date.getFullYear() &&
          to.getMonth() === date.getMonth() &&
          to.getDate() === date.getDate()
      ) {
        return true;
      }

      return from < date && date < to;
    },
    busyDate(date) {
      var busyHours = 0;
      for (var i = 0; i < this.dateTimes.calendar.length; i++) {
        if (
            this.dateTimes.calendar[i].getFullYear() === date.getFullYear() &&
            this.dateTimes.calendar[i].getMonth() === date.getMonth() &&
            this.dateTimes.calendar[i].getDate() === date.getDate()
        ) {
          busyHours++;
        }
      }
      return busyHours * (100 / 13);
    },
    daysInMonth(year, month) {
      return 32 - new Date(year, month, 32).getDate();
    },
    getPrevMonth(year, month) {
      if (month === 0) {
        return { year: year - 1, month: 11 };
      } else {
        return { year: year, month: month - 1 };
      }
    },
    getNextMonth(year, month) {
      if (month === 11) {
        return { year: year + 1, month: 0 };
      } else {
        return { year: year, month: month + 1 };
      }
    },
    prevDay() {
      if (!this.selectedDate) {
        return;
      }
      if (this.isPastDate(this.selectedDate) || this.isCurrentDate(this.selectedDate)) {
        return;
      }
      this.selectedDate = new Date(this.currentYear, this.currentMonth, this.selectedDate.getDate() - 1);
      this.currentMonth = this.selectedDate.getMonth();
    },
    nextDay() {
      if (!this.selectedDate) {
        return;
      }
      var nextSelectedDate = new Date(this.currentYear, this.currentMonth, this.selectedDate.getDate() + 1);
      if (this.isPastDate(nextSelectedDate)) {
        return;
      }
      this.selectedDate = nextSelectedDate;
      this.currentMonth = this.selectedDate.getMonth();
    },

    daysInlastMonth(year, month) {
      if (month === 0) {
        return this.daysInMonth(--year, 11);
      } else {
        return this.daysInMonth(year, --month);
      }
    },
    prevMonth() {
      if (this.isFirstMonth) {
        return;
      }
      var prev = this.getPrevMonth(this.currentYear, this.currentMonth);
      this.currentYear = prev.year;
      this.currentMonth = prev.month;
    },
    nextMonth() {
      var next = this.getNextMonth(this.currentYear, this.currentMonth);
      this.currentYear = next.year;
      this.currentMonth = next.month;
    },
    select(day) {
      if (this.isPastDate(day.date)) {
        return;
      }

      this.selectedDate = day.date;
      this.getTimes(this.selectedDate.getFullYear(), this.selectedDate.getMonth());
    },
    canChooseTime(from, to) {
      for (var i = 0; i < this.dateTimes.calendar.length; i++) {
        if (!to && this.dateTimes.calendar[i].getTime() === from.getTime()) {
          return false;
        }

        if (
            to &&
            this.dateTimes.calendar[i].getTime() > from.getTime() &&
            this.dateTimes.calendar[i].getTime() < to.getTime()
        ) {
          return false;
        }
      }
      return true;
    },
    chooseTime(time) {
      if (!this.choosenTimeFrom) {
        if (this.canChooseTime(time.date, this.choosenTimeTo)) {
          this.choosenTimeFrom = time.date;
          this.getPrice();
        }
        return;
      }
      if (time.date < this.choosenTimeFrom) {
        if (this.canChooseTime(time.date, this.choosenTimeTo)) {
          this.choosenTimeFrom = time.date;
          this.getPrice();
        }
        return;
      }
      if (this.canChooseTime(this.choosenTimeFrom, time.date)) {
        this.choosenTimeTo = time.date;
        this.getPrice();
      }
    },
    cancel() {
      this.choosenTimeFrom = null;
      this.choosenTimeTo = null;
    },
    addToCalendar(date) {
      var inCalendar = false;
      this.dateTimes.calendar.forEach(function(item) {
        if (item.getTime() === date.getTime()) {
          inCalendar = true;
        }
      });

      if (!inCalendar) {
        this.dateTimes.calendar.push(date);
      }
    },
    addToActions(date) {
      var inActions = false;
      this.dateTimes.actions.forEach(function(item) {
        if (item.getTime() === date.getTime()) {
          inActions = true;
        }
      });

      if (!inActions) {
        this.dateTimes.actions.push(date);
      }
    },
    getTimes(year, month) {
      var _this = this;
      var success = function(data) {
        var timezone = '+0' + (-today.getTimezoneOffset()/60) + ':00';
        data.calendar.forEach(function(date) {
          var newDate = new Date(date+timezone);
          _this.addToCalendar(newDate);
          // add date after
          var nextDate = new Date(date+timezone);
          nextDate.setHours(nextDate.getHours() + 1);
          _this.addToCalendar(nextDate);
          // add date before
          var prevDate = new Date(date+timezone);
          prevDate.setHours(prevDate.getHours() - 1);
          _this.addToCalendar(prevDate);
        })
        data.actions.forEach(function(date) {
          var newDate = new Date(date+timezone);
          _this.addToActions(newDate);
        })
      };

      var yearMonth = year + '-' + this.formatMonth(month)
      $.ajax({
        url: '/order/get-times',
        type: 'GET',
        data: {
          'date': yearMonth,
          'boat_id': this.boat_id
        },
        success: success
      });
    },
    getPrice() {
      var _this = this;
      $.ajax({
        url: '/order/price',
        type: 'GET',
        data: {
          boat_id: this.boat_id,
          datetime_from: this.choosenTimeFromValue,
          datetime_to: this.choosenTimeToValue
        },
        success: function (data) {
          if (data.success === true) {
            _this.price = data.result;
          }
        }
      });
    },
    checkOrder() {
      if (this.notMinimalOrder) {
        $('#orderButton').popover('show');
        setTimeout(function() {
          $('#orderButton').popover('hide');
        }, 5000);
        return false;
      } else {
        this.$refs['orderForm'].submit();
      }
    }
  },
  mounted() {
    this.boat_id = window.boat_id;
    this.minimal_rent_in_day = window.minimal_rent;
    this.getTimes(this.currentYear, this.currentMonth);
    this.$el.style.display = 'block';
  }
})