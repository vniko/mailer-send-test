<template>
  <div>
    <div class="row"  v-if="!isAdding">
      <div class="col-12">
        <div class="input-group">
          <select :name="name" class="form-control" v-model="currentSelectValue" @input="handleInput" :required="required" >
            <option :value="null">-- Choose</option>
            <option v-for="m in options" :value="m[idColumn]">
              {{ m[nameColumn] }}
            </option>
          </select>
          <div class="input-group-append ml-2">
            <button class="btn btn-success" @click.prevent="toggleAddNew"><fa icon="plus" /> Add new</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row" v-if="isAdding">
      <div class="col-12">
        <form ref="newValueForm">
          <div class="input-group">
            <input v-on:keyup.enter="saveNew" :type="inputType" required class="form-control" v-model="newValue" placeholder="Add New Value" ref="add_new_input">
            <div class="input-group-append ml-2">
              <button class="btn btn-primary" @click.prevent="saveNew"><i class="fa fa-save"></i> Save</button>
              <button class="btn btn-secondary" @click.prevent="isAdding = !isAdding; newValue = null;">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SelectAddNew',
  props: {
    options: {
      type: Array
    },
    value: {
      required: false,
    },
    onAdd: {
      type: String | Function,
      required: true,
    },
    required: {
      type: Boolean,
      default: false
    },
    idColumn: {
      type: String,
      default: 'id'
    },
    nameColumn: {
      type: String,
      default: 'name'
    },
    name: {
      required: false,
      type: String,
      default: ''
    },
    inputType: {
      type: String,
      default: 'text'
    }
  },
  data() {
    return {
      isAdding: false,
      newValue: null,
      currentSelectValue: null,
    }
  },

  methods: {
    async saveNew() {
      if (this.$refs.newValueForm.reportValidity()) {
        if (typeof this.onAdd === 'function') {
          this.onAdd(this.newValue);
        } else {
          let data = {}
          data[this.nameColumn] = this.newValue;
          const newItem = await this.$store.dispatch(this.onAdd, data);
          this.currentSelectValue = newItem[this.idColumn];
          this.$emit('input', newItem[this.idColumn]);
        }
        this.isAdding = false;
        this.newValue = null;
      }
    },

    handleInput(event) {
      this.$emit('input', event.target.value);
    },

    toggleAddNew() {
      this.isAdding = true;
      this.$emit('input', null);
      this.$nextTick(() => {
        this.$refs.add_new_input.focus();
      });
    }
  },

  mounted() {
    if (this.value) {
      this.currentSelectValue = this.value.toString();
    }
  }

}
</script>

<style scoped>

</style>
