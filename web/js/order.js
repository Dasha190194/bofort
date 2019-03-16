var today = new Date();
today.setHours(0, 0, 0, 0)

var app = new Vue({
  el: '#order',
  data: {
    boat_id: 30,
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
      for (var i = 6; i < 22; i++) {
        var date = new Date(this.selectedDate.getFullYear(), this.selectedDate.getMonth(), this.selectedDate.getDate(), i);
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
        return ''
      }
      var prevDay = new Date(this.selectedDate.getFullYear(), this.selectedDate.getMonth(), this.selectedDate.getDate() - 1);
      return prevDay.getDate() + ' ' + this.months1[prevDay.getMonth()];
    },
    nextDate() {
      if (!this.selectedDate) {
        return ''
      }
      var nextDay = new Date(this.selectedDate.getFullYear(), this.selectedDate.getMonth(), this.selectedDate.getDate() + 1);
      return nextDay.getDate() + ' ' + this.months1[nextDay.getMonth()];
    },
    isFirstMonth() {
      return this.currentMonth === today.getMonth();
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
            pastDate: this.isPastDate(date)
          })
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
          pastDate: this.isPastDate(date)
        })
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
            pastDate: false
          })
        }
      }

      //if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {}

      return days;
    },
    choosenTimeFromValue() {
      if (!this.choosenTimeFrom) {
        return ''
      }
      return ( 
        this.choosenTimeFrom.getFullYear() + '-' + 
        this.choosenTimeFrom.getMonth() + '-' +
        this.choosenTimeFrom.getDate() + ' ' +
        this.choosenTimeFrom.getHours() + ':00'
      )
    },
    choosenTimeToValue() {
      if (!this.choosenTimeFrom) {
        return ''
      }
      if (!this.choosenTimeTo) {
        var timeTo = new Date(
          this.choosenTimeFrom.getFullYear(),
          this.choosenTimeFrom.getMonth(),
          this.choosenTimeFrom.getDate(),
          this.choosenTimeFrom.getHours() + 1
        );

        return ( 
          timeTo.getFullYear() + '-' + 
          timeTo.getMonth() + '-' +
          timeTo.getDate() + ' ' +
          timeTo.getHours() + ':00'
        )
      }
      return ( 
        this.choosenTimeTo.getFullYear() + '-' + 
        this.choosenTimeTo.getMonth() + '-' +
        this.choosenTimeTo.getDate() + ' ' +
        this.choosenTimeTo.getHours() + ':00'
      )
    },
    dateFromTo() {
      if (!this.choosenTimeFrom) {
        return ''
      }
      var from = this.choosenTimeFrom.getDate() + ' ' + this.months1[this.choosenTimeFrom.getMonth()] + ' ' + this.choosenTimeFrom.getFullYear()
      if (!this.choosenTimeTo) {
        return from
      }
      var to = this.choosenTimeTo.getDate() + ' ' + this.months1[this.choosenTimeTo.getMonth()] + ' ' + this.choosenTimeTo.getFullYear()
      return from === to ? from : from + ' - ' + to
    },
    timeFromTo() {
      if (!this.choosenTimeFrom) {
        return ''
      }
      var from = this.choosenTimeFrom.getHours() + ':00'
      var to = ''
      if (!this.choosenTimeTo) {
        to = (this.choosenTimeFrom.getHours() + 1) + ':00'
      } else {
        to = this.choosenTimeTo.getHours() + ':00'
      }
      return from + ' - ' + to
    }
  },
  methods: {
    isBusyTime(date) {
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
        return false
      }
      if (!this.choosenTimeTo) {
        return this.choosenTimeFrom.getTime() === date.getTime()
      }
      if (this.choosenTimeFrom <= date && date <= this.choosenTimeTo) {
        return true;
      }
      return false;
    },
    isPastDate(date) {
      return date < today;
    },
    isCurrentDate(date) {
      return date.getTime() === today.getTime()
    },
    isSelected(date) {
      if (!this.selectedDate) {
        return false
      }
      return date.getTime() === this.selectedDate.getTime()
    },
    daysInMonth(year, month) {
      return 32 - new Date(year, month, 32).getDate();
    },
    getPrevMonth(year, month) {
      if (month === 0) {
        return { year: year - 1, month: 11 }
      } else {
        return { year: year, month: month - 1 }
      }
    },
    getNextMonth(year, month) {
      if (month === 11) {
        return { year: year + 1, month: 0 }
      } else {
        return { year: year, month: month + 1 }
      }
    },
    prevDay() {
      if (!this.selectedDate) {
        return;
      }
      this.selectedDate = new Date(this.currentYear, this.currentMonth, this.selectedDate.getDate() - 1);
      this.currentMonth = this.selectedDate.getMonth();
    },
    nextDay() {
      if (!this.selectedDate) {
        return;
      }
      this.selectedDate = new Date(this.currentYear, this.currentMonth, this.selectedDate.getDate() + 1);
      this.currentMonth = this.selectedDate.getMonth();
    },

    daysInlastMonth(year, month) {
      if (month === 0) {
        return this.daysInMonth(--year, 11)
      } else {
        return this.daysInMonth(year, --month)
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
      this.getTimes();
    },
    canChooseTime(from, to) {
      for (var i = 0; i < this.dateTimes.calendar.length; i++) {
        if (!to && this.dateTimes.calendar[i].getTime() === from.getTime()) {
          return false
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
    getTimes() {
      var _this = this;
      var success = function(data) {
        _this.dateTimes.calendar = data.calendar.map(function(date) {
          return new Date(date);
        })
        _this.dateTimes.actions = data.actions.map(function(date) {
          return new Date(date);
        })
      };

      $.ajax({
        url: 'https://bofort.su/order/get-times',
        type: 'GET',
        data: {
            'date': start.format('YYYY-MM'),
            'boat_id': this.boat_id
        },
        success: success
      });
    },
    getPrice() {
      var _this = this;
      $.ajax({
        url: 'https://bofort.su/order/price',
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
    }
  },
  mounted() {
  }
})