<template>
  <card title="Activity History">

    <table class="table table-striped">
      <thead>
         <tr>
           <th width="250">Sender</th>
           <th width="250">Recipient</th>
           <th width="550">Subject</th>
           <th>Status</th>
           <th>Date Created</th>
           <th></th>
         </tr>
         <tr class="bg-info">
           <td>
             <v-select
              placeholder="Filter by sender"
              v-model="filters.sender"
              :options="senders"
              label="email" />
           </td>
           <td>
             <v-select
               placeholder="Filter by recipient"
               v-model="filters.recipient"
               :options="recipients"
               label="email" />

           </td>
           <td colspan="4">
             <input placeholder="Search by  sender, recipient, subject" type="text" class="form-control" v-model="filters.search" />
           </td>
         </tr>
      </thead>
      <tbody>
        <tr v-for="row in resultFiltered">
          <td>{{row.sender.email}}</td>
          <td>{{row.recipient.email}}</td>
          <td>{{row.subject}}</td>
          <td><status-label :status="row.status" /></td>
          <td><date-format :value="row.created_at" /></td>
          <td>
            <button @click.prevent="showOneMesage(row)" class="btn btn-primary"><fa icon="search-plus" /></button>
          </td>
        </tr>
      </tbody>
    </table>
    <view-mail :message="currentMessage"></view-mail>
  </card>
</template>

<script>
import { mapState } from 'vuex';
import ViewMail from '~/components/mail/ViewMail'

export default {
  components: { ViewMail },
  scrollToTop: false,

  data: () => ({
    filters: {
      sender: null,
      recipient: null,
      search: null
    },
    currentMessage: null
  }),

  head () {
    return { title: 'Mail Activity' }
  },

  computed: {
    ...mapState('sender', ['senders']),
    ...mapState('recipient', ['recipients']),
    ...mapState('mail', ['list']),

    resultFiltered() {
      if (this.list) {
        return this.list.filter(row => {
          let match = true;
          if (this.filters.sender) {
            match = row.sender_id === this.filters.sender.id;
          }
          if (this.filters.recipient) {
            match = match && row.recipient_id === this.filters.recipient.id;
          }

          if (this.filters.search) {
            const search = new RegExp(this.filters.search, 'g');
            match = match && (row.subject.search(search) >= 0 || row.sender.email.search(search) >= 0 || row.recipient.email.search(search) >= 0);
          }

          return match;
        });
      }
      return [];
    }
  },

  methods: {
    getList () {
      this.$store.dispatch('mail/load')
    },

    showOneMesage(message) {
      this.currentMessage = message;
      this.$modal.show('viewMail');
    }
  },

  mounted() {
    this.getList();

    window.Echo.channel('mail-queue').listen('MessageHandled', (e) => {
      this.$store.commit('mail/updateStatus', e);
    });

  }
}
</script>
