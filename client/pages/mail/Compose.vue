<template>
  <card title="Compose New Mail">
    <form @submit.prevent="submitForm" ref="form" enctype="multipart/form-data">
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">From (Email)</label>
        <div class="col-md-7">
          <select-add-new :required="true" name="sender_id" nameColumn="email" :options="senders" input-type="email" onAdd="sender/create" ></select-add-new>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">To (Email)</label>
        <div class="col-md-7">
          <select-add-new :required="true" name="recipient_id"  nameColumn="email" :options="recipients" input-type="email" onAdd="recipient/create" ></select-add-new>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Subject</label>
        <div class="col-md-7">
          <input type="text" class="form-control" name="subject" required />
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">HTML Content</label>
        <div class="col-md-7">
          <vue-editor  ref="editor" name="html_content" id="html_content"  v-model="htmlContent" @text-change="updatePlainText"> </vue-editor>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Plain Text Content</label>
        <div class="col-md-7">
          <textarea required @change="textContentModified = true" class="form-control" rows="5" name="plain_content" v-model="plainTextContent"></textarea>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Attachments</label>
        <div class="col-md-7">
          <template v-for="i in filesCount">
            <input type="file" name="attachments[]" class="mb-1" />
            <button v-if="filesCount >1 &&  i === filesCount" class="btn btn-sm btn-danger" @click.prevent="filesCount --"><fa icon="trash" /></button>
            <br>
          </template>
          <button class="btn btn-sm btn-primary" @click.prevent="filesCount ++"><fa icon="plus" /> Add attachment</button>
        </div>
      </div>
      <hr />
      <div class="form-group row">
        <div class="col-md-7 offset-3">
          <button class="btn btn-lg btn-success"  :disabled="submitting"><fa icon="paper-plane" /> Send</button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import { mapState } from 'vuex';
import SelectAddNew from '~/components/global/SelectAddNew';
import { VueEditor } from "vue2-editor";
import Swal from 'sweetalert2'

export default {
  components: { SelectAddNew, VueEditor },

  data: () => ({
    filesCount: 1,
    htmlContent: '',
    plainTextContent: '',
    textContentModified: false,
    submitting: false
  }),

  head () {
    return { title: 'Compose Mail' }
  },

  computed: {
    ...mapState('sender', ['senders']),
    ...mapState('recipient', ['recipients']),
  },

  methods: {
    updatePlainText() {
      // mirrow html content ro plain text unless it was modified manually
      if (!this.textContentModified) {
        this.$set(this, 'plainTextContent', this.$refs.editor.quill.getText())
      }
    },

    async submitForm(event) {
      this.$nuxt.$loading.start();
      this.submitting = true;
      const formData = new FormData(event.target);
      formData.append('html_content', this.htmlContent);
      await this.$store.dispatch('mail/create', formData);
      Swal.fire(
        'Yay!',
        'Message Added to Queue',
        'success'
      );
      this.$nuxt.$loading.finish();
      this.submitting = false;
      window.setTimeout(() => this.$router.push({name: 'mail.list'}), 1000);
    }
  }
}
</script>
