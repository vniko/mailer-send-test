<template>
  <div class="row">
    <div class="col-md-2">
      <card title="Mail" class="settings-card">
        <ul class="nav flex-column nav-pills">
          <li v-for="tab in tabs" :key="tab.route" class="nav-item">
            <router-link :to="{ name: tab.route }" class="nav-link" active-class="active">
              <fa :icon="tab.icon" fixed-width />
              {{ tab.name }}
            </router-link>
          </li>
        </ul>
      </card>
    </div>

    <div class="col-md-10">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
export default {

  computed: {
    tabs () {
      return [
        {
          icon: 'edit',
          name: 'Compose',
          route: 'mail.compose'
        },
        {
          icon: 'list',
          name: 'Activity',
          route: 'mail.list'
        }
      ]
    }
  },
  mounted () {
    this.$store.dispatch('sender/load');
    this.$store.dispatch('recipient/load');
  }
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
