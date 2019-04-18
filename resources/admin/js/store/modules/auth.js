import Ls from 'services/ls'

const state = {
    status: false,
    token: Ls.get('auth.token'),
    user: null
}

const getters = {
    user: state => state.user,
    isLoggedIn: state => !!state.token,
    authStatus: state => state.status,
    bearerString: state => `Bearer ${state.token}`,
}

const actions = {
    login({commit}, loginData) {
        return new Promise((resolve, reject) => {
            commit('auth_request')
            axios.post('/api/auth/login', loginData)
                .then(response => {
                    const token = response.data.access_token
                    const user = response.data.user
                    toastr['success']('Logged In!', 'Success')

                    Ls.set('auth.token', token)
                    axios.defaults.headers.common['Authorization'] = token

                    commit('auth_success', token, user)
                    resolve(response)
                })
                .catch(err => {
                    commit('auth_error', err)
                    Ls.remove('auth.token')

                    if (err.response.status === 401) {
                        toastr['error']('Invalid Credentials', 'Error')
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.error('Error', err.message)
                    }

                    reject(err)
                })
        })
    },

    logout({commit}) {
        return new Promise((resolve, reject) => {
            axios.post('/api/auth/logout').then(response => {
                Ls.remove('auth.token')
                commit('logout')
                delete axios.defaults.headers.common['Authorization']
                resolve()
            })
        })
    },

    check({commit}) {
        return new Promise((resolve, reject) => {
            axios.get('/api/auth/me').then(response => {

                commit('setUser', response.data)
                !!response.data.id ? resolve() : reject()

            }).catch(err => {

                if (err.response.status === 401) {
                    commit('auth_error', err)
                    Ls.remove('auth.token')
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.error('Error', err.message)
                }

                reject(err)
            })
        })
    }
}

// mutations
const mutations = {
    auth_request(state) {
        state.status = 'loading'
    },
    auth_success(state, token, user) {
        state.status = 'success'
        state.token = token
        state.user = user
    },
    auth_error(state) {
        state.status = 'error'
        state.user = null
    },
    logout(state) {
        state.status = ''
        state.token = ''
        state.user = null
    },
    setUser(state, user) {
        state.user = user
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}