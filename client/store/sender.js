import axios from 'axios'

// state
export const state = () => ({
  senders: []
})

// mutations
export const mutations = {
  setList (state, data) {
    state.senders = data;
  },
  addToList (state, data) {
    state.senders.push(data);
  }
}

// actions
export const actions = {
  async load ({ commit }) {
    const { data } = await axios.get('/senders');
    commit('setList', data.data);
  },
  async create ({ commit }, formData) {
    let {data} = await axios.post('/senders', formData);
    commit('addToList', data.data);
    return data.data;
  },

}
