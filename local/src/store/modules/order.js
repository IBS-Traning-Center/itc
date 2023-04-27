const state = () => ({
    id: 1
})
const mutations = {
    setStore(state, {property, value}) {
        state[property] = value
    }
}
const actions = {
    add({ commit }, { id }) {
        commit('setStore', {property: 'id', value: id})
    }
}
const getters = {

}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}