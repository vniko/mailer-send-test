import axios from 'axios'

// state
export const state = () => ({
  list: []
})

// mutations
export const mutations = {
  setList (state, data) {
    state.list = data;
  },
  updateStatus (state, e) {
    let row = state.list.find(r =>  r.id === e.messageId);
    if (row) {
      row.status = e.status;
    }
  }
}

// actions
export const actions = {
  async load ({ commit }) {
    const { data } = await axios.get('/mail_messages');
    commit('setList', data.data);
  },
  async create ({ commit }, formData) {
    let {data} = await axios.post('/mail_messages', formData);
    return data.data;
  },

}
