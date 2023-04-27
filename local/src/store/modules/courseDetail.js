const state = () => ({
    scheduleId: false
})
const mutations = {
    setStore(state, {property, value}) {
        state[property] = value
    }
}
const actions = {
    setShowModal({commit}, id) {
        commit('setStore', {property: 'scheduleId', value: id})
    }
}
const getters = {}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}