const state = {
    errors: {},
}
// getters
const getters = {
    getErrors: (state, getters) => {
        return state.errors
    }
}

const actions = {
    setErrors({commit, state}, errors) {
        commit('setErrors', {errors})
    },
    clear({commit, state}) {
        commit('setErrors', {errors: {}})
    },
}

// mutations
const mutations = {
    setErrors(state, {errors}) {
        state.errors = errors
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}