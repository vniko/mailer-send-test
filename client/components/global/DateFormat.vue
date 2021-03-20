<template>
  <span>{{ formatDate(value) }}</span>
</template>

<script>

import moment from 'moment';

export default {
  name: "DateFormat",
  props: {
    value: {
      type: String | Date,
      required: true
    },
    format: {
      type: String,
      required: false,
      default: "DD/MM/YY HH:mm:ss"
    },
  },

  methods: {
    formatDate(value) {
      if (Number.isInteger(value)) {
        return moment.utc(value, 'X').format(this.format);
      } else {
        return moment.utc(value).format(this.format);
      }
    }
  }
}
</script>

<style scoped>

</style>
