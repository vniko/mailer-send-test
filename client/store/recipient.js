import axios from 'axios'

// state
export const state = () => ({
  recipients: []
})

// mutations
export const mutations = {
  setList (state, data) {
    state.recipients = data;
  },
  addToList (state, data) {
    state.recipients.push(data);
  }
}

// actions
export const actions = {
  async load ({ commit }) {
    const { data } = await axios.get('/recipients');
    commit('setList', data.data);
  },
  async create ({ commit }, formData) {
    let {data} = await axios.post('/recipients', formData);
    commit('addToList', data.data);
    return data.data;
  },

}
