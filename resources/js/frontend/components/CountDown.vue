<template>
  <ul>
    <li>
      <span id="days">{{ days }}</span>ngày
    </li>
    <li>
      <span id="hours">{{ hours }}</span>giờ
    </li>
    <li>
      <span id="minutes">{{ minutes }}</span>phút
    </li>
  </ul>
</template>

<script>
Vue.filter("two_digits", (value) => {
  if (value < 0) {
    return "00";
  }
  if (value.toString().length <= 1) {
    return `0${value}`;
  }
  return value;
});

export default {
  props: {
    date: [String, Number],
  },
  data() {
    return {
      now: Math.trunc(new Date().getTime() / 1000),
    };
  },
  mounted() {
    window.setInterval(() => {
      this.now = Math.trunc(new Date().getTime() / 1000);
    }, 1000);
  },
  computed: {
    dateInMilliseconds() {
      return parseInt(this.date);
      //return Math.trunc(Date.parse(this.date) / 1000);
    },
    seconds() {
      return (this.dateInMilliseconds - this.now) % 60;
    },
    minutes() {
      return Math.trunc((this.dateInMilliseconds - this.now) / 60) % 60;
    },
    hours() {
      return Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60) % 24;
    },
    days() {
      return Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60 / 24);
    },
  },
};
</script>
