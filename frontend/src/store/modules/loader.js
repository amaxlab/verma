const state = {
    visible: false,
};

const getters = {};

const actions = {
    show({ commit }) {
        commit('show');
    },
    hide({ commit}) {
        commit('hide');
    }
};

const mutations = {
    show(state) {
        state.visible = true;
    },
    hide(state) {
        state.visible = false;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
