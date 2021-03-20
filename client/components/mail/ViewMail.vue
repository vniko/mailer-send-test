<template>
  <modal name="viewMail" :resizable="true" :draggable="true" width="50%" height="500px">
    <div class="p-4" v-if="message" style="height:490px; overflow-y: auto">
      <b>Date created: </b><date-format :value="message.created_at"/><br />
      <hr>
      <b>Status: </b><status-label :status="message.status" /><br />
      <b>From:</b> {{message.sender.email}}<br />
      <b>To:</b> {{message.recipient.email}}<br />
      <b>Subject:</b> {{message.recipient.email}}<hr />

      <b>HTML content:</b>
      <div v-html="message.html_content" />
      <hr />
      <b>Text content:</b><br>
      <code>
        {{message.plain_content}}
      </code>
    </div>
  </modal>
</template>

<script>
import DateFormat from '~/components/global/DateFormat'

export default {
  components: { DateFormat },
  props: ['message'],
  name: 'ViewMail',

}
</script>

<style scoped>

</style>
