<template>
  <span :class="['badge', statusClass]">{{status}}</span>
</template>

<script>
export default {
  props: ['status'],
  name: 'StatusLabel',
  computed: {
    statusClass() {
      switch (this.status) {
        case 'posted':
          return 'badge-primary';

        case 'sent':
          return 'badge-success';

        case 'failed':
          return 'badge-danger';
      }
    },
  }
}
</script>

<style scoped>

</style>
