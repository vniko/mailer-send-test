<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
      <router-link to="/" class="navbar-brand">
        {{ appName }}
      </router-link>

      <button  class="navbar-toggler" type="button"
              data-toggle="collapse" data-target="#navbarToggler"
              aria-controls="navbarToggler" aria-expanded="false"
      >
        <span class="navbar-toggler-icon" />
      </button>

      <div id="navbarToggler" class="collapse navbar-collapse">

        <ul class="navbar-nav ml-auto">
          <!-- Authenticated -->
          <li  class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            >
              <img src="https://i.pravatar.cc/100" class="rounded-circle profile-photo mr-1">
              MiniSend User
            </a>
            <div class="dropdown-menu">
              <router-link :to="{ name: 'mail.compose' }" class="dropdown-item pl-3">
                <fa icon="edit" fixed-width />
                Compose
              </router-link>
              <div class="dropdown-divider" />
              <router-link :to="{ name: 'mail.list' }" class="dropdown-item pl-3">
                <fa icon="list" fixed-width />
                Activity
              </router-link>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    appName: process.env.appName
  }),

  methods: {
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
